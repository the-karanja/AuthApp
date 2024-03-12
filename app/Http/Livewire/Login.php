<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Livewire\Component;

class Login extends Component
{
    public $email,$password,$credential_id;

    public function submit(Request $request)
    {

        // Retrieve the user by email
        $user = User::where('email', $this->email)->first();

        // Check if user exists and if the provided password is correct
        if ($user && Hash::check($this->password, $user->password)) {
            // Authentication passed...
            Auth::login($user); // Manually log in the user
            return redirect()->to('/'); // Redirect to the intended page after successful authentication
        }

        // Authentication failed...
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function get_credential() {
        $user = User::where('email', $this->email)->first();
        dd($user->credential_id);
    }
    public function render()
    {
        return view('livewire.login');
    }
}
