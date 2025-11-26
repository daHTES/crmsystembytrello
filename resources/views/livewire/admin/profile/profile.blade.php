<div class="container">

    <div class="card shadow p-4">

        <h3>Профиль администратора</h3>
        <hr>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
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
                <label>Новый пароль (не обязательно)</label>
                <input type="password" class="form-control" wire:model="password">
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button class="btn btn-primary">Сохранить</button>

        </form>

    </div>

</div>
