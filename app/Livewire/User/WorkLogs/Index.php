<?php

namespace App\Livewire\User\WorkLogs;

use Livewire\Component;
use App\Models\WorkLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $month;
    public $year;

    public $hours;
    public $comment;

    public $editId = null;
    public $editHours;
    public $editComment;
    public $editDate;

    public $confirmDeleteId = null;

    protected $updatesQueryString = [];

    public function mount()
    {
        $now = now();
        $this->month = $now->month;
        $this->year = $now->year;
    }

    public function edit($id)
    {
        $log = WorkLog::where('user_id', Auth::id())->findOrFail($id);

        $this->editId = $id;
        $this->editHours = $log->hours;
        $this->editComment = $log->comment;
        $this->editDate = $log->date->format('Y-m-d');
    }

    public function cancelEdit()
    {
        $this->editId = null;
        $this->editHours = null;
        $this->editComment = null;
        $this->editDate = null;
    }

    public function updateRecord($id)
    {
        $this->validate([
            'editHours' => 'required|numeric|min:0|max:24',
            'editComment' => 'nullable|string|max:2000',
            'editDate' => 'required|date',
        ]);

        $log = WorkLog::where('user_id', Auth::id())->findOrFail($id);

        $log->update([
            'hours' => $this->editHours,
            'comment' => $this->editComment,
            'date' => $this->editDate,
        ]);

        $this->cancelEdit();

        session()->flash('success', 'Запись обновлена!');
    }

    public function addRecord()
    {
        $this->validate([
            'hours' => 'required|numeric|min:0|max:24',
            'comment' => 'nullable|string|max:2000',
        ]);

        WorkLog::create([
            'user_id' => Auth::id(),
            'date' => now()->format('Y-m-d'),
            'hours' => $this->hours,
            'comment' => $this->comment,
        ]);

        $this->reset(['hours', 'comment']);

        session()->flash('success', 'Запись добавлена!');
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
    }

    public function deleteRecord($id)
    {
        $log = WorkLog::where('user_id', Auth::id())->findOrFail($id);
        $log->delete();

        $this->confirmDeleteId = null;

        session()->flash('success', 'Запись успешно удалена!');
    }

    public function previousMonth()
    {
        $date = Carbon::create($this->year, $this->month, 1)->subMonth();
        $this->month = $date->month;
        $this->year = $date->year;
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->year, $this->month, 1)->addMonth();
        $this->month = $date->month;
        $this->year = $date->year;
    }

    public function render()
    {
        $logs = WorkLog::where('user_id', Auth::id())
            ->whereMonth('date', $this->month)
            ->whereYear('date', $this->year)
            ->orderBy('date')
            ->get();

        $totalHours = $logs->sum('hours');

        return view('livewire.user.work-logs.index', compact('logs', 'totalHours'))
            ->layout('user.layouts.app', ['title' => 'Ваш отчет за месяц']);
    }
}
