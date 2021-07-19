<?php

namespace App\Http\Livewire;

use App\Models\Emails;
use Livewire\Component;

class StatusTable extends Component
{
    public function render()
    {

        return view('livewire.status-table', [
            'emails' => Emails::query()->select(['status', 'created_at', 'id'])->orderBy('created_at', 'desc')->get()
        ]);
    }
}
