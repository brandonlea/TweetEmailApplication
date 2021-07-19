<?php

namespace App\Http\Livewire;

use App\Jobs\SendMail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EmailForms extends Component
{
    public $email;
    public $message;

    public $success_message;

    protected $rules = [
        'email' => 'required|email',
        'message' => 'required|max:140'
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.email-forms');
    }


    public function submitMessage() {


        $data = [
            'email' => $this->email,
            'message' => $this->message,
            'key' => $this->throttleKey(),
            'id' => \Auth::id()
        ];


        $this->ensureIsNotRateLimited($data);




        $this->resetForm();

    }


    public function ensureIsNotRateLimited($data)
    {
        if(!RateLimiter::tooManyAttempts($this->throttleKey(), 1)) {
            dispatch(new SendMail($data));
            RateLimiter::clear($this->throttleKey());
            $this->success_message = 'You have sent an email please wait up to 15 seconds before sending another one thanks.';
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey());

        session()->flash('error', 'Please allow up to 15 seconds before sending a email you have ' . $seconds . ' Seconds Left');
        $this->success_message = '';
    }

    public function throttleKey()
    {
        return \Str::lower($this->email);
    }

    private function resetForm() {
        $this->email = '';
        $this->message = '';
    }
}
