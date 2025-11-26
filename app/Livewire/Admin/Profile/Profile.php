<?php

namespace App\Livewire\Admin\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    public $name;
    public $email;
    public $password;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;

    }

    public function save()
    {

        $user = Auth::user();


        $this->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
        ]);

        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->password){
            $user->password = Hash::make($this->password);
        }

        $user->save();
        session()->flash('success', 'Профиль обновлен успешно!');

    }


    public function render()
    {
        return view('livewire.admin.profile.profile')
            ->layout('admin.layouts.app', [
                'title' => 'Профиль администратора'
            ]);
    }
}
