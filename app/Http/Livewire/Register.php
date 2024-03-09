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

    protected $listeners = ['WebAuthnError','IsFingerprintCaptured'];
    public $WebAuthnErrorMessage = '';

    public $FingerprintIsCaptured = false;



    public function WebAuthnError ($message) {
        $this->WebAuthnErrorMessage = $message;
    }

    public function IsFingerPrintCaptured ($bool){
        $this->FingerprintIsCaptured = $bool;
    }

    protected $rules = [
        'username' => 'required|min:3|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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
