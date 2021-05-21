<?php

namespace App\Airwire;

use Airwire\Attributes\Wired;
use Airwire\Component;
use App\Models\User;
use Exception;

class CreateUser extends Component
{
    public bool $strictValidation = false;

    #[Wired]
    public string $name = '';

    #[Wired]
    public string $email = '';

    #[Wired]
    public string $password = '';

    #[Wired]
    public string $password_confirmation = '';

    public function rules()
    {
        return [
            'name' => ['required', 'min:5', 'max:25', 'unique:users'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ];
    }

    #[Wired]
    public function create(): User
    {
        $user = User::create($this->validated());

        $this->meta('notification', __('users.created', ['id' => $user->id, 'name' => $user->name]));

        $this->reset();

        return $user;
    }
}
