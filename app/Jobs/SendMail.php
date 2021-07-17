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
use Illuminate\Support\Facades\Redis;
use Mailgun\Mailgun;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    protected $status;
    protected $from;
    protected $timestamp;
    protected $messageid;

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
        Redis::throttle($this->details['email'])->allow(1)->every(15)->then(function () {

            \Mail::to($this->details['email'])->send(new MailHandler($this->details));

            $client = Mailgun::create(config('app.mailgun_key'));

            foreach ($client->events()->get(config('app.mailgun_domain'))->getItems() as $event)
            {
                $this->status = $event->getEvent();
                $this->from = $event->getMessage()['headers']['from'];
                $this->timestamp = $event->getTimestamp();
                $this->messageid = $event->getMessage()['headers']['message-id'];
            }

            Emails::query()->updateOrInsert([
               'recipient' => $this->details['email'],
                'message' => $this->details['message'],
                'from' => $this->from,
                'timestamp' => Carbon::now(+1)->timestamp,
                'message_id' => $this->messageid,
                'status' => $this->status
            ]);

        }, function () {
            return $this->release(15);
        });
    }
}
