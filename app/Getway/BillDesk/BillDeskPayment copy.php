<?php

namespace App\Getway\BillDesk;

use App\Getway\BillDesk\Jwt;
use DateTime;
use DateTimeZone;

class BillDeskPayment
{

    private static $clientId = 'icadwbuatm';
    public static  $amount = "3000.00";
    public  static $CALLBACK_URL ;
    private const PAYMENT_URL = "https://pguat.billdesk.io/payments/ve1_2/orders/create";
    public static $checksumKey = "qkzlZsHs193J9x60sEP8ngv4zM6QAM9y";

  
  
    public static function  initPayment($amount, array $addinationInfo, array $splitPayemnt,)
    {
        self::$CALLBACK_URL = route('billdesk.payment.response');
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $formattedDateTime = $dateTime->format('Y-m-d\TH:i:sP');

        $order_date = $formattedDateTime;

        $curl_payload = [
            "mercid" => 'ICADWBUATM', // your merchantid given by billdesk
            "orderid" => (string)(rand(1111111, 9999999)), // must be unique for every request
            "amount" => $amount,
            "order_date" => $order_date,
            "currency" => "356", // for INR
            "ru" => self::$CALLBACK_URL, // your callback url where response willbe post
            "additional_info" => $addinationInfo,
            "itemcode" => "DIRECT",
            "split_payment" => $splitPayemnt,
            "device" => [
                "init_channel" => "internet",
                "ip" => $_SERVER['REMOTE_ADDR'], // your device ip address

                "accept_header" => "text/html",
                "user_agent" => "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0",

            ]
        ];
        $result = self::curlRequest($curl_payload);
        return self::getDecodedData($result);
    }


    public static function curlRequest($payload)
    {
        $headers = ["alg" => "HS256", "clientid" => self::$clientId]; // clientid given by billdesk
        $curl_payload = Jwt::encode($payload, self::$checksumKey, "HS256", $headers); // you should use Firebase/JWT library to encrypt the response
        $ch = curl_init(self::PAYMENT_URL);

        $tracid = rand(1111111111, 9999999999);
        $time = time();
        $ch_headers = array(
            "Content-Type: application/jose",
            "accept: application/jose",
            "BD-Traceid:" . $tracid,
            "BD-Timestamp: " . $time
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $ch_headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public static function getDecodedData($result)
    {
        try {
            $result_decoded = Jwt::decode($result, self::$checksumKey, 'HS256');


            if ($result_decoded->status == 'ACTIVE') {
                $bdorderid = $result_decoded->bdorderid;
                $autharray = $result_decoded->links[1];

                $headersArray = $autharray->headers;
                $authorization_token = $headersArray->authorization;

                $data['authorization_token'] = $authorization_token;
                $data['bdorderid'] = $bdorderid;

                return $data;
            } else { // Response error
                return $result_decoded;
            }
        } catch (\Exception $e) {
            echo $e;
        }
    }
}
