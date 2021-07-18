<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rules;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;


    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required|min:8'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function register()
    {
        $credentials = $this->validate();

        $credentials['name'] = $this->name;
        $credentials['email'] = $this->email;
        $credentials['password'] = $this->password;
        $credentials['password_confirmation'] = $this->password_confirmation;


        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }


    public function render()
    {
        return view('livewire.register');
    }
}
