<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Login extends Component
{
    public $email,$password,$credential_id;
    public $backend_credentialId="yes";
    public $biometrics_message;
    protected $listeners = ['FingerprintListeners'];

    public $login_mode="password";

    public function FingerprintListeners($data)
    {

        // return redirect()->to('/');
        $this->backend_credentialId = $data;
        if($this->backend_credentialId == $this->credential_id){
            // return redirect()->to('/');
        }
    }
    public function submit(Request $request)
    {
        if($this->login_mode == "password"){
                    // Retrieve the user by email
            if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                return redirect()->to('/');
            }
            // Authentication failed...
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        } else {
            $userdata = User::where('email', $this->email)->first();
            $this->credential_id = $userdata->credential_id;
            $data = [
                'credential'=>$this->credential_id
            ];

            $this->emit('LoginWithFingerprint',$data);

        }

    }


    public function VerifyAuthentication ($id1,$id2) {

    }
    public function get_credential() {

        // $this->credential_id = $user->credential_id;
        // dd($this->credential_id);
    }

    public function switchMode ()
    {
        if($this->login_mode == "password")
        {
            $this->login_mode = "fingerprint";
        } elseif($this->login_mode == "fingerprint"){
            $this->login_mode = "password";
        }

    }
    public function render()
    {
        return view('livewire.login');
    }
}
