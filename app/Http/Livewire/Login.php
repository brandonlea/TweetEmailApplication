<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Login extends Component
{

    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email|unique:users',
        'password' => 'required|password:'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function login()
    {
        $credentials = $this->validate();

        $credentials['email'] = $this->email;
        $credentials['password'] = $this->email;

        if(\Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
    }

    public function render()
    {


        return view('livewire.login');
    }
}
