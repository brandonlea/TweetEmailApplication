<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $email;
    public $password;


    public function login()
    {
        $validatedDate = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if(Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            redirect()->intended('dashboard');
        } else {
            session()->flash('error', 'email and password are wrong!');
        }
    }

    public function render()
    {


        return view('livewire.login');
    }
}
