<div class="container">

    <div class="card shadow mb-4 p-4">

        <h3>Создание нового пользователя</h3>
        <hr>

        <form wire:submit.prevent="save">

            <div class="form-group mb-3">
                <label>Имя</label>
                <input type="text" class="form-control" wire:model="name">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" class="form-control" wire:model="email">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mb-3">
                <label>Пароль</label>
                <input type="password" class="form-control" wire:model="password">
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mb-3">
                <label>Роль пользователя</label>
                <select class="form-control" wire:model="role">
                    <option value="user">Обычный пользователь</option>
                    <option value="admin">Админ</option>
                </select>
                @error('role') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button class="btn btn-primary">
                Создать
            </button>

        </form>

    </div>

</div>
