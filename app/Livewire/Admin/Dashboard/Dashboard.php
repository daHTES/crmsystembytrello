<?php

namespace App\Livewire\Admin\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use App\Models\WorkLog;
use Carbon\Carbon;

class Dashboard extends Component
{

    public $today;
    public $usersCount;
    public $commentsCount;
    public $totalHours;
    public $lastUser;

    public $lastComment;

    public function mount(){


        // Дата сегодня
        $this->today = Carbon::now()->translatedFormat('d F Y');
        $this->usersCount = User::where('role', '!=', 'admin')
            ->count();

        $userIds = User::where('role', '!=', 'admin')->pluck('id');

        // Все коменты
        $this->commentsCount = WorkLog::whereIn('user_id', $userIds)
            ->whereNotNull('comment')
            ->count();

        // Последний коммент
        $this->lastComment = WorkLog::whereIn('user_id', $userIds)
            ->whereNotNull('comment')
            ->orderBy('created_at', 'desc')
            ->first();

        $userIds = User::where('role', '!=', 'admin')->pluck('id');

        $this->totalHours = WorkLog::whereIn('user_id', $userIds)->sum('hours');


        // Последний юзер
        $this->lastUser = User::where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->first();

    }


    public function render()
    {
        return view('livewire.admin.dashboard.dashboard')
            ->layout('admin.layouts.app', [
                'title' => 'Главная'
            ]);
    }
}
