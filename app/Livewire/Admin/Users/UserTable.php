<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Support\Str;

class UserTable extends Component
{
    public int $day;
    public int $month;
    public int $year;
    public Collection $users;

    //Обновление списков юзеров при апдейте
    protected $listeners = ['workLogUpdated' => 'loadUsers'];

    public $confirmingDeleteId = null;




    public function mount()
    {
        $now = Carbon::now();
        $this->day = now()->day;
        $this->month = $now->month;
        $this->year = $now->year;


        $this->loadUsers();
    }

    public function loadUsers()
    {

        //Все ююзеры с ролью
        $users = User::where('role', 'user')->get();


        //Для каждого юзера добав. суму часов за выбра. месяц
        $users->transform(function ($user) {
            $sum = $user->workLogs()
                ->whereYear('date', $this->year)
                ->whereMonth('date', $this->month)
                ->sum('hours');

            $user->sum_hours = (float) $sum;

            // Последний коммент юзера
            $lastWorkLogsUserComment = $user->workLogs()
                ->whereNotNull('comment')
                ->orderBy('created_at', 'desc')
                ->first();

            // 3. Текст и датa последнего комментария
            if ($lastWorkLogsUserComment) {
                // Огр. на вывод
                $user->last_comment_text = \Illuminate\Support\Str::limit($lastWorkLogsUserComment->comment, 50);
                $user->last_comment_date = $lastWorkLogsUserComment->created_at;
            } else {
                $user->last_comment_text = null;
                $user->last_comment_date = null;
            }


            return $user;
        });

        $this->users = $users;
    }

    public function prevMonth()
    {
        if ($this->month == 1){
            $this->month = 12;
            $this->year--;
        } else {
            $this->month--;
        }
        $this->loadUsers();
    }

    public function nextMonth()
    {
        if ($this->month == 12){
            $this->month = 1;
            $this->year++;
        } else {
            $this->month++;
        }
        $this->loadUsers();
    }

    public function deleteUser($id)
    {


        if ($this->confirmingDeleteId !== $id){
            $this->confirmingDeleteId = $id;
            return;
        }

        $user = User::findOrFail($id);

        //Запрет на удаление себя
        if ($user->id === auth()->id()){
            $this->dispatch('toast', message: 'Нельзя удалить самого себя!', type: 'error');
            return;
        }

        $user->delete();

        $this->confirmingDeleteId = null;
        $this->loadUsers();

        $this->dispatch('toast', message: 'Пользователь успешно удалён!');

    }

    public function render()
    {
        //$users = User::all();
        return view('livewire.admin.users.user-table', [
            'users' => $this->users,
        ])
            ->layout('admin.layouts.app', [
                'title' => 'Список пользователей'
            ]);
    }

}
