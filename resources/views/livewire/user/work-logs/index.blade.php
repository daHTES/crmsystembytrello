<div class="container mt-4">

    <h3 class="mb-3">
        Отчёт за {{ \Carbon\Carbon::create($year, $month)->translatedFormat('F Y') }}
    </h3>

    <div class="d-flex justify-content-between mb-3">
        <button wire:click="previousMonth" class="btn btn-outline-primary">&larr; Предыдущий</button>

        <strong>{{ \Carbon\Carbon::create($year, $month)->translatedFormat('F Y') }}</strong>

        <button wire:click="nextMonth" class="btn btn-outline-primary">Следующий &rarr;</button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Часы</th>
                    <th>Комментарий</th>
                    <th></th>
                </tr>
                </thead>

                <tbody wire:key="logs-table">
                @forelse($logs as $log)

                    @if($editId === $log->id)
                        <tr wire:key="edit-{{ $log->id }}">
                            <td>
                                <input type="date" wire:model="editDate" class="form-control">
                                @error('editDate')<span class="text-danger">{{ $message }}</span>@enderror
                            </td>

                            <td>
                                <input type="number" wire:model="editHours" class="form-control">
                            </td>

                            <td>
                                <input type="text" wire:model="editComment" class="form-control">
                            </td>

                            <td>
                                <button class="btn btn-success btn-sm" wire:click="updateRecord({{ $log->id }})">Сохранить</button>
                                <button class="btn btn-secondary btn-sm" wire:click="cancelEdit">Отмена</button>
                            </td>
                        </tr>
                    @else
                        <tr wire:key="row-{{ $log->id }}">
                            <td>{{ $log->date->format('d.m.Y') }}</td>
                            <td>{{ $log->hours }}</td>
                            <td>{{ $log->comment }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" wire:click="edit({{ $log->id }})">Редактировать</button>

                                @if($confirmDeleteId === $log->id)
                                    <button class="btn btn-danger btn-sm" wire:click="deleteRecord({{ $log->id }})">Подтверждаю</button>
                                    <button class="btn btn-secondary btn-sm" wire:click="$set('confirmDeleteId', null)">Отмена</button>
                                @else
                                    <button class="btn btn-outline-danger btn-sm" wire:click="confirmDelete({{ $log->id }})">Удалить</button>
                                @endif
                            </td>
                        </tr>
                    @endif

                @empty
                    <tr>
                        <td colspan="4" class="text-center">Нет записей</td>
                    </tr>
                @endforelse
                </tbody>

                @if(count($logs) > 0)
                    <tfoot wire:key="total-row">
                    <tr class="table-info">
                        <td><strong>Итого за месяц:</strong></td>
                        <td><strong>{{ number_format($totalHours, 2) }}</strong></td>
                        <td colspan="2"></td>
                    </tr>
                    </tfoot>
                @endif

            </table>

        </div>
    </div>

    <div class="card shadow">
        <div class="card-header">Добавить запись за сегодня</div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="mb-3">
                <label>Количество часов</label>
                <input type="number" step="0.25" min="0" max="24" wire:model="hours" class="form-control">
                @error('hours') <span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="mb-3">
                <label>Комментарий</label>
                <textarea wire:model="comment" class="form-control"></textarea>
                @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <button wire:click="addRecord" class="btn btn-primary">Отправить</button>

        </div>
    </div>
</div>
