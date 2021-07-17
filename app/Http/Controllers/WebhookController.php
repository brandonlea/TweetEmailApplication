<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $input = $request->all();

        $sign = $input['signature'];
        $key = config('app.mailgun_sign');

        $verify = Mailgun::create($key)->webhooks()->verifyWebhookSignature($sign['token'], $sign['timestamp'], $sign['signature']);

        if($verify) {
            $event = $input['event-data'];

            Emails::query()->where('message_id', '=', $event['id'])->update([
                'status' => $event['event']
            ]);
        }
    }
}
