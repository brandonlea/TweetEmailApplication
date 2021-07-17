<?php

namespace App\Jobs;

use App\Models\Emails;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
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
     */
    public function handle()
    {
        Redis::throttle($this->details['email'])->allow(1)->every(15)->then(function () {

            \Mail::to($this->details['email'])->send();

            $client = Mailgun::create(config('app.mailgun_key'));

            foreach ($client->events()->get(config('app.mailgun_domain'))->getItems() as $event)
            {
                $this->status = $event->getEvent();
                $this->from = $event->getMessage()['headers']['from'];
                $this->timestamp = $event->getTimestamp();
            }

            Emails::query()->insert([
               'recipient' => $this->details['email'],
                'message' => $this->details['message'],
                'from' => $this->timestamp,
                'status' => $this->status
            ]);

        }, function () {
            $this->release(15);
        });
    }
}
