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

    public $verification = false;

    protected $listeners = ['FingerprintListeners','Verifying'];

    public $login_mode="password";
    protected $rules = [
        'email' => 'required|email|exist:users',
        'password' => 'required',
    ];

    public function Verifying($data)
    {
        $this->verification = true;
    }

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
            session()->flash('LoginError','The credentials you provided do not match');
            return back();
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
