<div class="container mt-4">

    <h3 class="mb-4"><i class="fas fa-user-circle"></i> Профиль пользователя</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">

        <!-- Левая колонка — информация -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong>Основные данные</strong>
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Имя</label>
                        <input type="text" wire:model="name" class="form-control">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" wire:model="email" class="form-control">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button class="btn btn-primary" wire:click="updateProfile">
                        Сохранить изменения
                    </button>

                </div>
            </div>
        </div>

        <!-- Правая колонка — смена пароля -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong>Изменить пароль</strong>
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Новый пароль</label>
                        <input type="password" wire:model="password" class="form-control">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Повторите пароль</label>
                        <input type="password" wire:model="password_confirmation" class="form-control">
                    </div>

                    <button class="btn btn-warning" wire:click="updatePassword">
                        Обновить пароль
                    </button>

                </div>
            </div>
        </div>

    </div>

</div>
