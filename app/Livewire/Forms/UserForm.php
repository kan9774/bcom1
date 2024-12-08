<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Illuminate\Validation\Rules;
use Livewire\Form;
use App\Models\User;

class UserForm extends Form
{
    public ?User $user;

    #[Validate('required|string|min:3|max:255')]
    public $name;
    #[Validate('required|string|email|lowercase|unique:'.User::class)]
    public $email;
    #[Validate('required|string|min:8')]
    public $password;
    #[Validate('string|required_with:password|same:password|')]
    public $password_confirmation;
    #[Validate('required')]
    public $role;

    public function store(): void
    {
        $this->validate();
        $user=User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
        $user->roles()->attach($this->role);
        $this->reset();
    }

    public function setUser(User $user): void
    {
        $this->name = $user->name;
        $this->email = $user->email;

    }
}
