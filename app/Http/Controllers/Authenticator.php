<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Authenticator extends Controller
{
    // this method renders the login page
    public function LoginIndex(){ // Logins GET method handler
        return view('login');
    }


// this method renders the register page
    public function RegisterIndex() { // Register GET method handler
        return view('register');
    }

}
