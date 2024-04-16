<?php

namespace App\Listeners;

use App\Events\GeneralSms;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MessageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(GeneralSms $event)
    {
        $phone = $event->sms_array['phone'];
        $body = $event->sms_array['body'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://unify.smsgateway.center/SMSApi/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('userid' => 'icagov', 'mobile' => $phone, 'senderid' => 'ICBOOK', 'dltEntityId' => '1101623140000076111', 'msg' => $body, 'sendMethod' => 'quick', 'msgType' => 'text', 'output' => 'json', 'duplicatecheck' => 'true'),
            CURLOPT_HTTPHEADER => array(
                'apikey: 1e9633f6d456bf34e6089ce40e06be613f18fc7e'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $mes_data = json_decode($response, true);
        return $event->mes_data;

        //return back()->with('success', 'Notification send successfully.');
    }
}
