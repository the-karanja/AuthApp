<?php

namespace App\Http\Livewire;

use Illuminate\Http\Client\Request;
use Livewire\Component;

class Register extends Component
{
    public $username;
    public $email;
    public $password;
    public function render()
    {
        return view('livewire.register');
    }

    public function submit(Request $req)
    {
        dd($req);
    }
}
