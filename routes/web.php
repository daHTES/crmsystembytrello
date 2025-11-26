<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::view('/403', 'errors.403')->name('403');

Route::middleware('auth')->group(function () {

    Route::middleware(['auth', 'role.user'])->group(function () {
        Route::get('/user', App\Livewire\User\WorkLogs\Index::class)
            ->name('user.dashboard');
        Route::get('/user/profile', \App\Livewire\User\Profile\Index::class)
            ->name('user.profile');
    });


    Route::middleware('admin')->group(function () {
        Route::get('/admin', \App\Livewire\Admin\Dashboard\Dashboard::class)
            ->name('admin.dashboard');

        //Профиль Админа
        Route::get('/admin/profile', \App\Livewire\Admin\Profile\Profile::class)
            ->name('admin.profile');
        //Создание юзера
        Route::get('/admin/users/create', \App\Livewire\Admin\Users\UserCreate::class)
            ->name('admin.users.create');

        //Лист юзеров
        Route::get('/admin/users', \App\Livewire\Admin\Users\UserTable::class)
            ->name('admin.users.index');

        //Просмотр юзера
        Route::get('/admin/users/{userId}', \App\Livewire\Admin\Users\UserDetail::class)
            ->name('admin.users.show');
    });

    Route::post('/logout', function (){
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login');
    })->name('logout');

/*    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');*/
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

require __DIR__.'/auth.php';
