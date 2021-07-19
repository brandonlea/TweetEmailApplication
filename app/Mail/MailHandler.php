<?php

namespace App\Mail;

use App\Models\Emails;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailHandler extends Mailable
{
    use Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new message instance.
     *
     * @param $detials
     */
    public function __construct($detials)
    {
        $this->details = $detials;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->withSwiftMessage(function ($swiftMessage) {

            Emails::query()->updateOrInsert([
                'recipient' => $this->details['email'],
                'message' => $this->details['message'],
                'from' => config('app.email_from'),
                'timestamp' => Carbon::now('utc')->getTimestamp(),
                'message_id' => $swiftMessage->getId(),
                'user_id' => $this->details['id'],
                'status' => 'queued'
            ]);
        });

        return $this->from(config('app.email_from'))
            ->subject(config('app.email_subject'))
            ->view('emails.email')
            ->with('data', $this->details);
    }
}
