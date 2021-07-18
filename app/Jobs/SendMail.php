<?php

namespace App\Jobs;

use App\Mail\MailHandler;
use App\Models\Emails;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Redis\LimiterTimeoutException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redis;
use Mailgun\Mailgun;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    protected $messageid;
    protected $from;
    protected $status;
    protected $timestamp;



    /**
     * Create a new job instance.
     *
     * @param $details
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws LimiterTimeoutException
     */
    public function handle()
    {


        Redis::throttle($this->details['email'])->block(0)->allow(1)->every(15)->then(function () {
            $client = Mailgun::create(config('app.mailgun_key'));

            $event = $client->messages()->send(config('app.mailgun_domain'), [
                'from' => config('app.email_from'),
                'to' => $this->details['email'],
                'subject' => config('app.email_subject'),
                'text' => $this->details['message']
            ]);

            Emails::query()->updateOrInsert([
                'recipient' => $this->details['email'],
                'message' => $this->details['message'],
                'from' => config('app.email_from'),
                'timestamp' => Carbon::now('utc')->getTimestamp(),
                'message_id' => preg_replace('~[\\\\/:*?"<>|]~', '', $event->getId()),
                'status' => 'queued'
            ]);


        }, function () {
            return $this->release(15);
        });

    }
}
