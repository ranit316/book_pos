<?php

namespace App\Http\Controllers\Getway;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Getway\BillDesk\BillDeskPayment;
use App\Getway\BillDesk\Jwt;
use App\Models\Publisher;
use App\Models\Publisher_Payout;
use App\Models\SaleDetails;
use App\Models\Sale;
use App\Models\MasterStockInventery;
use App\Events\SendSmsEvent;
use App\Models\SalePayament;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Notification;
use Illuminate\Support\Carbon;

class BillDeskController extends Controller
{

    private static $splitPayemnt;
    //[
    // [
    //     "mercid" => "ICADWBUAT1",
    //     "amount" => "1000.00"
    // ],
    // [
    //     "mercid" => "ICADWBUAT2",
    //     "amount" => "1000.00"
    // ],
    // [
    //     "mercid" => "ICADWBUAT3",
    //     "amount" => "1000.00"
    // ]
    // ];
    private static $addinationInfo;

    public function setupAdditionalInfo()
    {
        $inv = session('sale_id');
        $userid = session('user_id');
        //dd($inv);
        self::$addinationInfo = [
            "additional_info1" => (string)$inv,
            "additional_info2" => (string)$userid,
            //"additional_info3" =>  $additional_info3,
        ];
    }

    public static $amount;
    //public static $inv_no;

    //public static  $amount = null;


    // don't touch this method
    public function payment(Request $request)
    {
        self::$amount = Session::get('amount');
        $this->setupAdditionalInfo();

        self::modifySliptData($request);
        $response = (array) BillDeskPayment::initPayment(self::$amount, self::$addinationInfo, self::$splitPayemnt,);
        if (isset($response['bdorderid']) && isset($response['authorization_token'])) {
            return view('getway.billdesk', ['data' => $response, 'callbak_url' => BillDeskPayment::$CALLBACK_URL]);
        } else {
            dd($response);
        }
    }

    private static function modifySliptData(Request $request)
    {
        if (!isset(self::$splitPayemnt)) {
            self::$splitPayemnt = [];
        }

        $splitPayemnt = [
            "mercid" => Session::get('mercid'),
            "amount" => Session::get('amount')
        ];

        // Append the new split payment data to the existing array
        array_push(self::$splitPayemnt, $splitPayemnt);
        //here i have erase the array of splite payment getway
        //$publisers = Publisher::whereIn('id', $request->publisher_id)->get();

        /** here i have creating the data of array like this
         *  [
         *      [
         *          "mercid" => "ICADWBUAT1",
         *          "amount" => "1000.00"
         *      ],
         *      [
         *           "mercid" => "ICADWBUAT2",
         *           "amount" => "1000.00"
         *      ],
         *       [
         *            "mercid" => "ICADWBUAT3",
         *            "amount" => "1000.00"
         *      ]
         * ]
         * 
         * 
         * */
        // foreach ($publisers as  $publiser) {
        //     $arr = [
        //         "mercid" => $publiser->merchant_key,
        //         "amount" => $publiser->amount
        //     ];
        //     array_push(self::$splitPayemnt, $arr);
        // }
    }

    public function billDeskGetwayResponse(Request $request)
    {
        $result_decoded = Jwt::decode($request->transaction_response, BillDeskPayment::$checksumKey, 'HS256');

        // if return auth_status code is 3000 then transaction is successfull
        if (property_exists($result_decoded, 'auth_status')) {
            if ($result_decoded->auth_status == "0300") {
                //echo "<h1> Transaction  successful </h1>";
                $user_id = $result_decoded->additional_info->additional_info2;

                self::successResponse($result_decoded);
                session(['msg' => 'Transaction  successful', 'return_form' => 'PaymentSuccess', 'saleidreturn' => $result_decoded->additional_info->additional_info1]);
                Auth::loginUsingId($user_id, true);
                // $data = session('saleidreturn');
                // $send_msg = [
                //     'message' => 'success',
                //     'sale_id' => $data,

                // ];

                // event(new SendSmsEvent($send_msg));
                return redirect()->route('pos.index');
            } else {
                
                echo "<h1> Transaction not successful </h1>";

            
                session(['saleidreturn' => $result_decoded->additional_info->additional_info1]);
                $data = session('saleidreturn');
                $rand = mt_rand(1111, 9999);
                $amount = Sale::with('store')->where('id', $data['saleidreturn'])->first();
                $store = $amount->store->store_name;
                //$customer = Customer::where('id', $amount->customer_id)->first();
                $publisher = User::where('id', $amount->publisher_id)->where('type', 'publisher')->first();
                $notification = Notification::create([
                    'publisher_id' => $publisher->id,
                    'message' => "Payment of $amount->total for Order ID: $amount->invoice_no at I&CA Book Store - $store has failed. Please try again or contact support. - I&CA Dept, Govt of West Bengal",
                    'date_time' => Carbon::now(),
                    'is_read' => "unread",
                    'user_id' =>  auth()->user()->id,
                ]);
                $send_msg = [
                    'message' => 'failed',
                    'sale_id' => $data,

                ];

                event(new SendSmsEvent($send_msg));
                return redirect()->route('pos.retry.payment');
            }
        } else {
            // Handle case where auth_status property is not present in the decoded result
            echo "<h1>Authentication status not found in response</h1>";
            return redirect()->route('pos.retry.payment')->with('error', 'Authentication status not found');
        }


        // from here write the logic

    }

    private static function successResponse($result_decoded)
    {
        // write the logic 
        //dd($result_decoded);
        $additional_info1 = $result_decoded->additional_info->additional_info1;
        //dd($additional_info1);
        $sale_data = (int)$additional_info1;

        $data = Sale::where('id', $sale_data)->first();
        //dd($data);
        $sale_payment = SalePayament::create([
            'sale_id' => $data->id,
            'trancaction_no' => $result_decoded->transactionid,
            'orderid' => $result_decoded->orderid,
            'status' => $result_decoded->transaction_error_type,
            'payament_mode' => 'online',
            'payaments_type' => $result_decoded->payment_method_type,
            'amount' => $result_decoded->amount,
            'user_id' => $data->sale_by,
        ]);

        if ($sale_payment) {
            if ($sale_payment->status == 'success') {
                $sale = Sale::where('id', $data->id)->update(['status' => 'paid', 'trancaction_no' => $sale_payment->trancaction_no]);
            }
            $pub_id = User::where('id', $data->publisher_id)->first();
            $pub_payment = Publisher_Payout::create([
                'sale_id' => $data->id,
                'amount' => $sale_payment->amount,
                'publisher_id' => $pub_id->publisher_id,
                'status' => 'pending',
                'payament_mode' => 'online',
                'payaments_type' => $sale_payment->payaments_type,
                'user_id' => $data->sale_by,
            ]);

            if ($pub_payment) {
                $sale_details = SaleDetails::where('sale_id', $data->id)->get();
                foreach ($sale_details as $masterdata) {
                    $saledetails = [
                        'product_id' => $masterdata->product_id,
                        'store_id' => $data->store_id,
                        'qty' => $masterdata->qty,
                    ];
                    self::masterStockManage($saledetails);
                }
            }
            $amount = Sale::with('store')->where('id', $sale_data)->first();
            $store = $amount->store->store_name;
            //$customer = Customer::where('id', $amount->customer_id)->first();
            $publisher = User::where('id', $amount->publisher_id)->where('type', 'publisher')->first();


            $notification = Notification::create([
                'publisher_id' => $publisher->id,
                'message' => "Your payment of $amount->total for Order ID: $amount->invoice_no at I&CA Book Store - $store is successful. Thank you! - I&CA Dept, Govt of West Bengal",
                'date_time' => Carbon::now(),
                'is_read' => "unread",
                'user_id' =>  $sale_payment->user_id,
            ]);

            $send_msg = [
                'message' => 'success',
                'sale_id' => $data->id,

            ];

            event(new SendSmsEvent($send_msg));
        }
    }

    private static function masterStockManage($data)
    {
        $inventry_q = MasterStockInventery::where('store_id', $data['store_id'])
            ->where('product_id', $data['product_id'])
            //->where('storage_site_id', $data['storage_site_id'])
            ->where('qty', '>', 0);
        if ($inventry_q->get()->count() > 0) {
            $inventry = $inventry_q->first();
            $inv_q = $inventry->qty;
            $inventry->update([
                'qty' =>  $inv_q - $data['qty'],
            ]);
        }
    }
}
