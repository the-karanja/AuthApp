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

    protected $listener = ['WebAuthnError'];
    public $WebAuthnErrorMessage = '';
    public function captureWebAuthnError ($message) {
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
