<?php

use App\Http\Livewire\EmailForms;
use function Pest\Livewire\livewire;

it('can post', function () {
    livewire(EmailForms::class)
        ->call('submitMessage');
});

test('can load forgot-password page', function () {
   \Pest\Laravel\get('/forgot-password')->assertStatus(200);
});

it('cant post', function () {
   \Pest\Laravel\post('/webhook')->assertStatus(404);
});
