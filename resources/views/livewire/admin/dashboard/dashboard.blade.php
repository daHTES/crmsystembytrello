<div class="row">

    {{-- Верхний ряд  --}}
    <div class="col-md-3 mb-4">
        <div class="card border-left-primary shadow py-2 h-100">
            <div class="card-body">
                <h5 class="font-weight-bold text-primary">Сегодня</h5>
                <div class="h5 mb-0 text-gray-800">{{ $today }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card border-left-success shadow py-2 h-100">
            <div class="card-body">
                <h5 class="font-weight-bold text-success">Пользователей</h5>
                <div class="h3 mb-0 text-gray-800">{{ $usersCount }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card border-left-info shadow py-2 h-100">
            <div class="card-body">
                <h5 class="font-weight-bold text-info">Комментарии</h5>
                <div class="h3 mb-0 text-gray-800">{{ $commentsCount }}</div>
                <small class="text-muted">Общее количество</small>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card border-left-warning shadow py-2 h-100">
            <div class="card-body">
                <h5 class="font-weight-bold text-warning">Пользовательских часов</h5>
                <div class="h3 mb-0 text-gray-800">{{ $totalHours }}</div>
            </div>
        </div>
    </div>

    {{-- Нижний ряд 1 --}}
    <div class="col-md-12 mb-4">
        <div class="card shadow py-2">
            <div class="card-body">
                <h5 class="font-weight-bold">Последний зарегистрированный пользователь</h5>

                @if($lastUser)
                    <div class="mt-3">
                        <p><strong>Имя:</strong> {{ $lastUser->name }}</p>
                        <p><strong>Email:</strong> {{ $lastUser->email }}</p>
                        <p><strong>Дата регистрации:</strong>
                            {{ $lastUser->created_at->translatedFormat('d F Y H:i') }}
                        </p>
                    </div>
                @else
                    <p class="text-muted">Пока нет пользователей</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Нижний ряд 2 --}}
    <div class="col-md-12 mb-4">
        <div class="card shadow py-2">
            <div class="card-body">
                <h5 class="font-weight-bold">Последний комментарий пользователя</h5>

                @if($lastComment)
                    <div class="mt-3">
                        <p><strong>Комментарий:</strong></p>
                        <div class="p-3 bg-light rounded border mb-3">
                            {{ $lastComment->comment }}
                        </div>

                        <p><strong>Автор:</strong> {{ $lastComment->user->name }}</p>
                        <p><strong>Email:</strong> {{ $lastComment->user->email }}</p>

                        <p><strong>Дата:</strong>
                            {{ $lastComment->created_at->translatedFormat('d F Y H:i') }}
                        </p>
                    </div>
                @else
                    <p class="text-muted">Комментариев пока нет</p>
                @endif
            </div>
        </div>
    </div>

</div>
