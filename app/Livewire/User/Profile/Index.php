<?php

namespace App\Livewire\User\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Index extends Component
{

    public $name;
    public $email;
    public $password;
    public $password_confirmation;


    public function  mount()
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateProfile()
    {
        $user = Auth::user();

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users')->ignore($user->id)
            ]
        ]);

        $user->name  = $this->name;
        $user->email = $this->email;
        $user->save();

        session()->flash('success', 'Профиль успешно обновлен!');
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($this->password);
        $user->save();

        $this->password = $this->password_confirmation = '';

        session()->flash('success', 'Пароль успешно изменён!');
    }


    public function render()
    {
        return view('livewire.user.profile.index')
            ->layout('user.layouts.app', [
                'title' => 'Профиль пользователя'
            ]);
    }
}
