<?php

namespace App\Listeners;

use App\Events\CustomerCreate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCustomerSms
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
    public function handle(CustomerCreate $event)
    {
        //
        $phone = $event->phone;
        $rand = rand(1111,9999);
        $body = "Welcome to I&CA Book Store!
        Your registration is successful. Your phone number $phone is now verified and can be used across all I&CA Book Stores. Thank You!
        - I&CA Dept, Govt of West Bengal. Ref No: $rand";

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

        return back()->with('success', 'Notification send successfully.');

    }
}
