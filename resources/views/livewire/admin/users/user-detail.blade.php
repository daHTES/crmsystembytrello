<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">&laquo; Назад к списку</a>
        </div>
        <div>
            <strong>{{ $user->name }} ({{ $user->email }})</strong>
        </div>
    </div>

    <div class="mb-4">
        <div class="d-flex align-items-center">
            <button class="btn btn-sm btn-outline-secondary mr-2" wire:click="prevMonth">&laquo;</button>
            <h5 class="mb-0 mx-2">{{ \Carbon\Carbon::create($year, $month)->format('F Y') }}</h5>
            <button class="btn btn-sm btn-outline-secondary ml-2" wire:click="nextMonth">&raquo;</button>
        </div>
    </div>

    <!-- Таблица логов -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Дата</th>
            <th>Часы</th>
            <th>Комментарий</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse($logs as $log)
            <tr>
                <td>{{ $log->date->format('Y-m-d') }}</td>

                @if($editingId === $log->id)
                    <td style="width:120px;">
                        <input wire:model="editHours" type="number" step="0.25" class="form-control">
                    </td>
                    <td>
                        <input wire:model="editComment" type="text" class="form-control">
                    </td>
                    <td>
                        <button wire:click="updateRow({{ $log->id }})" class="btn btn-sm btn-success">Заменить</button>
                        <button wire:click="cancelEdit()" class="btn btn-sm btn-secondary">Отмена</button>
                    </td>
                @else
                    <td>{{ number_format($log->hours, 2) }}</td>
                    <td>{{ $log->comment }}</td>
                    <td>
                        <button wire:click="editRow({{ $log->id }})" class="btn btn-sm btn-primary">Редактировать</button>
                    </td>
                @endif
            </tr>
        @empty
            <tr><td colspan="4" class="text-center">Нет записей</td></tr>
        @endforelse
        </tbody>
    </table>

    <!-- Формы смены логина/пароля -->
    <div class="row mt-4">
        <!-- Смена логина -->
        <div class="col-md-6">
            <h5>Сменить логин</h5>
            <div class="mb-2">
                <label>Новый логин пользователя:</label>
                <input type="text" wire:model="newLogin" class="form-control" placeholder="Введите новый логин">
                @error('newLogin') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-2">
                <label>Пароль администратора (Ваш):</label>
                <input type="password" wire:model="adminPasswordForLogin" class="form-control" placeholder="Подтвердите права админа">
                @error('adminPasswordForLogin') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button wire:click="changeLogin" class="btn btn-sm btn-warning">Сменить логин</button>
        </div>

        <!-- Смена пароля -->
        <div class="col-md-6">
            <h5>Сменить пароль</h5>
            <div class="mb-2">
                <label>Новый пароль пользователя:</label>
                <input type="password" wire:model="newPassword" class="form-control" placeholder="Новый пароль">
                @error('newPassword') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

           {{--Поле апрув пароля--}}
            <div class="mb-2">
                <label>Повторите новый пароль:</label>
                <input type="password" wire:model="newPassword_confirmation" class="form-control" placeholder="Повторите пароль">
            </div>

            <div class="mb-2">
                <label>Пароль администратора (Ваш):</label>
                <input type="password" wire:model="adminPasswordForPassword" class="form-control" placeholder="Подтвердите права админа">
                @error('adminPasswordForPassword') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button wire:click="changePassword" class="btn btn-sm btn-warning">Сменить пароль</button>
        </div>
    </div>

    <div class="mt-4 border-top pt-3">
        <button wire:click="deleteUser" onclick="confirm('Вы уверены?') || event.stopImmediatePropagation()" class="btn btn-danger">Удалить пользователя</button>
    </div>

</div>
