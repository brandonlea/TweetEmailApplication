<?php

namespace App\Http\Controllers;

use App\Models\Emails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mailgun\Mailgun;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $input = $request->all();

        $sign = $input['signature'];
        $key = config('app.mailgun_sign');

        $verify = Mailgun::create($key)->webhooks()->verifyWebhookSignature($sign['timestamp'], $sign['token'], $sign['signature']);

        if($verify) {
            $event = $input['event-data'];



            Emails::query()->where('message_id', '=', $event['message']['headers']['message-id'])->update([
                'status' => $event['event'] == 'delivered' ? 'sent' : $event['event'],
            ]);

        }

    }
}
