<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function Home (){
        // $requestData = $request->json()->all();
        // $email = $requestData['$email'];
       // $user = User::where('email', $email)->first();
        // $credentialId = $user->credential_id;
        return view('welcome');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login'); // Redirect to the desired page after logout
    }
}

