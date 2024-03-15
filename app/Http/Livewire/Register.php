<?php

namespace App\Http\Livewire;

use Illuminate\Http\Client\Request;
use Livewire\Component;
use App\Models\User;
class Register extends Component
{
    public $username;
    public $email;
    public $password;

    public $fingerprint_data;

    public $isValid = false;
    protected $listeners = ['WebAuthnSuccess','IsFingerPrintCaptured','FingerPrintData'];
    public $WebAuthnSuccessMessage = '';

    public $FingerprintIsCaptured = false;



    public function WebAuthnSuccess ($message) {
        $this->WebAuthnSuccessMessage = $message;
    }

    public function FingerPrintData ($data){
        $this->fingerprint_data = $data;
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
        $this->isValid = $this->isValid();
    }

    public function isValid()
    {
        // Check if all required fields are valid based on the validation rules


        // If validation passes, return true
        return $this->validate();
    }
    public function render()
    {
        return view('livewire.register');
    }

    public function submit()
    {

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->credential_id = $this->fingerprint_data;
        $user->save();
        session()->flash('WebAuthnSuccess','Your Account Has been Successfully created');
        // return
    }
}
