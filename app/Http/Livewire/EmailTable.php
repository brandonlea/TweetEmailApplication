<?php

namespace App\Http\Livewire;

use App\Models\Emails;
use Livewire\Component;

class EmailTable extends Component
{
    public function render()
    {
        return view('livewire.email-table', [
            'emails' => Emails::query()->orderBy('created_at', 'desc')->get()
        ]);
    }
}
