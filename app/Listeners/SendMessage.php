<?php

namespace App\Listeners;

use App\Events\SendSmsEvent;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMessage
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
    public function handle(SendSmsEvent $event)
    {
        //
        $send_msg = $event->send_msg;
        $data = Sale::with('store')->where('id', $send_msg['sale_id'])->first();
        $store = $data->store->store_name;
        $store = substr($store, 0, 10);
        $customer = Customer::where('id', $data->customer_id)->first();
        $publisher = User::where('id', $data->publisher_id)->where('type', 'publisher')->first();

        if ($send_msg['message'] == 'success') {
            $body = "Your payment of $data->total for Order ID: $data->invoice_no. at I&CA Book Store - $store is successful. Thank you! - I&CA Dept, Govt of West Bengal";
            $pub_body = "Your payment for the order at I&CA Book Store - $store has been successful. Order ID: $data->invoice_no. Thank you for your purchase, Visit Again!
- I&CA Dept, Govt of West Bengal";
            //$pub_no = $publisher->phone;
        } else if ($send_msg['message'] == 'failed') {
            $body = "We regret to inform you that your payment for the order at I&CA Book Store - $store has failed. Order ID: $data->invoice_no. Please try again or contact support for assistance.
            - I&CA Dept, Govt of West Bengal";
        }

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
            CURLOPT_POSTFIELDS => array('userid' => 'icagov', 'mobile' => $customer->phone, 'senderid' => 'ICBOOK', 'dltEntityId' => '1101623140000076111', 'msg' => $body, 'sendMethod' => 'quick', 'msgType' => 'text', 'output' => 'json', 'duplicatecheck' => 'true'),
            CURLOPT_HTTPHEADER => array(
                'apikey: 1e9633f6d456bf34e6089ce40e06be613f18fc7e'
            ),
        ));

        $response = curl_exec($curl);

        if ($send_msg['message'] == 'success') {
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://unify.smsgateway.center/SMSApi/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('userid' => 'icagov', 'mobile' => $publisher->phone, 'senderid' => 'ICBOOK', 'dltEntityId' => '1101623140000076111', 'msg' => $pub_body, 'sendMethod' => 'quick', 'msgType' => 'text', 'output' => 'json', 'duplicatecheck' => 'true'),
                CURLOPT_HTTPHEADER => array(
                    'apikey: 1e9633f6d456bf34e6089ce40e06be613f18fc7e'
                ),
            ));
            $res = curl_exec($curl);
        }

        curl_close($curl);
        // $cus_data = json_decode($response);
        // $event->pub_data = json_decode($res,true);

        // return $event->pub_data;

        return back()->with('success', 'Notification send successfully.');
    }
}


// if ($send_msg['message'] == 'success') {
//     $body = "Your payment of $data->total for Order ID: $data->invoice_no. at I&CA Book Store - $store is successful. Thank you! - I&CA Dept, Govt of West Bengal";
//     $pub_body = "Great news! Your book has been successfully purchased at I&CA Book Store $store Order ID: $data->invoice_no. Thank you for your contribution to cultural literature.
//     - I&CA Dept, Govt of West Bengal";