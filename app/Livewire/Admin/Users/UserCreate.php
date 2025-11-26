<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserCreate extends Component
{

    public $name;
    public $email;
    public $password;
    public $role = 'user';

    public function rules (){

        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'role'  => 'required|in:admin,user',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        session()->flash('success', 'Пользователь успешно Создан!');

        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        return view('livewire.admin.users.user-create')
            ->layout('admin.layouts.app', [
                'title' => 'Создать пользователя'
            ]);
    }
}
