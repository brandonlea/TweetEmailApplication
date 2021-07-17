<?php

namespace App\Http\Livewire;

use App\Jobs\SendMail;
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
        $details = $this->validate();



        $details['email'] = $this->email;
        $details['message'] = $this->message;


        $this->success_message = 'You have sent an email please wait up to 15 seconds before sending another one thanks.';

        $data = [
            'email' => $this->email,
            'message' => $this->message
        ];



        dispatch(new SendMail($data));

        $this->resetForm();

    }

    private function resetForm() {
        $this->email = '';
        $this->message = '';
    }
}
