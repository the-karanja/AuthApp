<?php

namespace App\Http\Livewire;

use Illuminate\Http\Client\Request;
use Livewire\Component;

class Register extends Component
{
    public $username;
    public $email;
    public $password;

    public $fingerprint_data;

    protected $listeners = ['WebAuthnError'];
    public $WebAuthnErrorMessage = '';

    public
    public function WebAuthnError ($message) {
        $this->WebAuthnErrorMessage = $message;
    }
    public function render()
    {
        return view('livewire.register');
    }

    public function submit()
    {
        dd($this->username);
    }
}
