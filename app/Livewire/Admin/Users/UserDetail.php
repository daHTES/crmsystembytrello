<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Models\WorkLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserDetail extends Component
{
    public User $user;
    public int $month;
    public int $year;
    public $logs = [];
    public $editingId = null;
    public $editHours;
    public $editComment;

    // Переменные для смены логина
    public $newLogin = '';
    public $adminPasswordForLogin = '';

    // Переменные для смены пароля
    public $newPassword = '';
    public $newPassword_confirmation = ''; // Это поле обязательно для правила confirmed
    public $adminPasswordForPassword = '';

    protected $listeners = ['refreshLogs' => 'loadLogs'];

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);
        $now = Carbon::now();
        $this->month = $now->month;
        $this->year = $now->year;
        $this->loadLogs();
    }

    public function loadLogs()
    {
        $this->logs = $this->user->workLogs()
            ->whereYear('date', $this->year)
            ->whereMonth('date', $this->month)
            ->orderBy('date')
            ->get();
    }

    public function editRow($id)
    {
        $log = WorkLog::findOrFail($id);
        $this->editingId = $id;
        $this->editHours = $log->hours;
        $this->editComment = $log->comment;
    }

    public function cancelEdit()
    {
        $this->editingId = null;
        $this->editHours = null;
        $this->editComment = null;
    }

    public function updateRow($id)
    {
        $this->validate([
            'editHours' => 'required|numeric|min:0|max:24',
            'editComment' => 'nullable|string|max:1000',
        ]);

        $log = WorkLog::findOrFail($id);
        $log->update([
            'hours' => $this->editHours,
            'comment' => $this->editComment,
        ]);

        $this->editingId = null;
        $this->dispatch('workLogUpdated');
        $this->loadLogs();

        session()->flash('success', 'Запись успешно обновлена');
    }

    public function changeLogin()
    {
        $this->validate([
            'newLogin' => 'required|string|min:3|unique:users,name,' . $this->user->id,
            'adminPasswordForLogin' => 'required|string',
        ]);

        if (!Hash::check($this->adminPasswordForLogin, auth()->user()->password)) {
            $this->addError('adminPasswordForLogin', 'Неверный пароль администратора!');
            return;
        }

        $this->user->name = $this->newLogin;
        $this->user->save();

        $this->reset(['newLogin', 'adminPasswordForLogin']);

        session()->flash('success', 'Логин успешно изменен!');
    }

    public function changePassword()
    {
        $this->validate([
            'newPassword' => 'required|string|min:6|confirmed', // Ищет поле newPassword_confirmation
            'adminPasswordForPassword' => 'required|string',
        ]);

        // Проверка пароля текущего админа
        if (!Hash::check($this->adminPasswordForPassword, auth()->user()->password)){
            $this->addError('adminPasswordForPassword', 'Неверный пароль администратора!');
            return;
        }

        // Обновление пароля пользователя
        $this->user->password = Hash::make($this->newPassword);
        $this->user->save();

        // Очистка полей
        $this->reset(['newPassword', 'newPassword_confirmation', 'adminPasswordForPassword']);

        session()->flash('success', 'Пароль пользователя успешно изменен!');
    }

    public function deleteUser()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $this->user->workLogs()->delete();
        $this->user->delete();

        session()->flash('success', 'Пользователь удален!');
        return redirect()->route('admin.users.index');
    }

    public function prevMonth()
    {
        if ($this->month == 1){
            $this->month = 12;
            $this->year--;
        } else {
            $this->month--;
        }
        $this->loadLogs();
    }

    public function nextMonth()
    {
        if ($this->month == 12){
            $this->month = 1;
            $this->year++;
        } else {
            $this->month++;
        }
        $this->loadLogs();
    }

    public function render()
    {
        return view('livewire.admin.users.user-detail')
            ->layout('admin.layouts.app', [
                'title' => 'Профиль пользователя'
            ]);
    }
}
