<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-3">
            Дата: {{ \Carbon\Carbon::create($year, $month, $day)->translatedFormat('l, F j \число Y \года') }}
        </h3>
        <div>
            <button class="btn btn-sm btn-outline-secondary" wire:click="prevMonth">&laquo; Предыдущий</button>
            <span class="mx-2">{{ \Carbon\Carbon::create($year, $month)->format('F Y') }}</span>
            <button class="btn btn-sm btn-outline-secondary" wire:click="nextMonth">Следующий &raquo;</button>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Ник</th>
            <th>Email</th>
            <th>Сумма часов ({{ \Carbon\Carbon::create($year, $month)->format('M Y') }})</th>
            <th>Дата регистрации</th>
            <th>Последний комментарий</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $idx => $user)
            <tr>
                <td>{{ $idx+1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ number_format($user->sum_hours, 2) }}</td>
                <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                <td>
                    @if ($user->last_comment_text)
                        <p class="mb-0">{{ $user->last_comment_text }}</p>
                        <small class="text-muted">{{ $user->last_comment_date->format('d.m.Y') }}</small>
                        @else
                            Нет комментариев, значить не работает
                        @endif
                </td>
                <td>
                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-primary">Открыть</a>
                    @if($confirmingDeleteId === $user->id)
                        <button class="btn btn-warning btn-sm" wire:click="deleteUser({{ $user->id }})">
                            Точно удалить?
                        </button>
                    @else
                        <button class="btn btn-danger btn-sm" wire:click="deleteUser({{ $user->id }})">
                            Удалить
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
        @if($users->isEmpty())
            <tr><td colspan="7" class="text-center">Пользователей нет</td></tr>
        @endif
        </tbody>
    </table>

    <script>
        window.addEventListener('toast', event => {
            let message = event.detail.message;
            let type = event.detail.type ?? 'success';

            let alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.textContent = message;
            alert.style.position = 'fixed';
            alert.style.top = '20px';
            alert.style.right = '20px';
            alert.style.zIndex = '9999';

            document.body.appendChild(alert);

            setTimeout(() => alert.remove(), 3000);
        });
    </script>
</div>

