<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function GetCredentialId (Request $request){
        // $requestData = $request->json()->all();
        // $email = $requestData['$email'];
       // $user = User::where('email', $email)->first();
        // $credentialId = $user->credential_id;
        return response()->json(['request',$request->body]);
    }
}
