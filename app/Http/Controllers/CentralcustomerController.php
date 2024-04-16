<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Address;
use App\Models\CustomerbridgeStore;
use App\Events\CustomerCreate;
use App\Models\District;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomeraddMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class CentralcustomerController extends Controller
{
    public $page = 'Central';
    public function index(Request $request)
    {
        $page = $this->page;
        if ($request->ajax()) {
            $id = auth()->user()->id;
            //$data =  Customer::with('address')->where('created_by',$id)->get();
            $data = CustomerbridgeStore::with('customer.address')->where('store_id', auth()->user()->store_id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('updated_at', function ($model) {
                    $formatDate = $model->updated_at->diffForHumans();
                    return $formatDate;
                })
                ->editColumn('status', function ($model) {
                    if ($model->status == 'active') {
                        $formatData = '<button class="btn btn-sm btn-warning">Active</button>';
                    } else if ($model->status == 'inactive') {
                        $formatData = '<button class="btn btn-sm btn-danger">Inactive</button>';
                    } else {
                        $formatData = '<button class="btn btn-sm btn-danger">' . ucfirst($model->status) . '</button>';
                    }

                    return $formatData;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.centralstore.customer.buttons', ['item' => $row, "route" => 'central', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status']) // this column should not be escaped?? means
                ->make(true); // it is a response
        }

        // $centralcustomer = Customer::with('address')->where('created_by',$id)->get();
        return view('admin.v1.centralstore.customer.index');
    }
    public function create()
    {
        $districts = District::where('deleted_at', null)->where('state', 'West Bengal')->get();
        $countries = District::where('deleted_at', null)->where('country', 'India')->get();
        $states = District::where('deleted_at', null)->where('country', 'India')->select('state')->distinct()->get();
        return view('admin.v1.centralstore.customer.add', compact('districts', 'countries', 'states'));
    }
    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            //'phone' => 'required|numeric|digits:10|unique:customers,phone',
            //'gender' => 'required',

            // 'address' => 'required',
            // 'city' => 'required',
            // 'state' => 'required',
            // 'pincode' => 'required',
            // 'district_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->WithErrors($validator)->WithInput();
        } else {
            $cus_details = Customer::where('phone', $request->phone)->where('status', 'active')->first();
            if ($cus_details != null) {
                $cus_bridge = new CustomerbridgeStore();
                $cus_bridge->store_id = auth()->user()->store_id;
                $cus_bridge->customer_id = $cus_details->id;
                $cus_bridge->status = "active";
                $cus_bridge->save();
                return redirect()->route('central.customer')->with('success', 'Added to your Store successfully');
            } else {
                $customer =  new Customer();
                $customer->name = $request->first_name . ' ' . $request->last_name;
                $customer->first_name = $request->first_name;
                $customer->last_name = $request->last_name;
                $customer->company_name = $request->company_name;
                $customer->email = $request->email;
                $customer->phone = $request->phone;
                $customer->alternative_phone = $request->alternative_phone;
                $customer->gender = $request->gender;
                $customer->dob = $request->dob;
                $customer->created_by = auth()->user()->id;
                $customer->store_id = auth()->user()->store_id;
                $customer->save();
                if ($customer->save()) {
                    $customer_id = $customer->id;
                    $data = new Address();
                    $data->customer_id = $customer_id;
                    $data->city = $request->city ?? "";
                    $data->state = $request->state;
                    $data->country = $request->country;
                    $data->pincode = $request->pincode;
                    $data->address = $request->address ?? '';
                    $data->district = $request->district_id;
                    $data->created_by = auth()->user()->id;
                    $data->save();
                    if ($data->save()) {
                        $bridge = new CustomerbridgeStore();
                        $bridge->store_id = $customer->store_id;
                        $bridge->customer_id = $customer->id;
                        $bridge->status = "active";
                        $bridge->save();
                    }

                    $rand = mt_rand(1111, 9999);
                    $phone = $request->phone;
                    $notification = new Notification();
                    $notification->message = "Welcome to I&CA Book Store! Your registration is successful. Your phone number $phone is now verified. Thank You! - I&CA Dept, Govt of West Bengal. Ref No: $rand";
                    $notification->save();
                    if($customer->email){
                        $this->customer_add_mail($customer->email,$customer->id);
                    }
                  
                }
                event(new CustomerCreate($request->phone));

            }
            //$id = auth()->user()->id;
            
            return redirect()->route('central.customer')->with('success', 'Added successfully');
        }
    }
    public function edit($id)
    {
        $customer = Customer::where('id', $id)->first();
        return view('admin.v1.centralstore.customer.edit', compact('customer'));
    }
    public function update(Request $request)
    {
        $id = $request->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric|digits:10|unique:customers,phone,' . $id,
            'gender' => 'required',
            'dob'  => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->WithErrors($validator)->WithInput();
        } else {
            Customer::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'dob'  =>   $request->dob,
            ]);
            return redirect()->route('central.customer')->with('update', 'update successfully');
        }
    }
    public function status($id)
    {
        $status = CustomerbridgeStore::find($id);
        if ($status->status == "active") {
            Customer::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            Customer::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    public function customerphonedetails($phone)
    {


        $cus_details = Customer::where('phone', $phone)->first();

        if (!$cus_details) {
            $data =  "null";
        } else {
            $id = auth()->user()->store_id;
            $customer = CustomerbridgeStore::where('customer_id', $cus_details->id)->where('store_id', $id)->first();
            if ($customer) {
                $data = "true";
            } else {
                $data = Customer::with('address')->where('phone', $phone)->first();
            }
        }

        return $data;
    }

    public function customer_add_mail($email, $id,)
    {
        try {
        $data = Customer::where('id',$id)->first();
        $ref_code = (string) rand(100000000, 999999999);
        $app_name = optional(DB::table('app_infos')->first())->title;
        $maildata = [
            'title' => 'Customer Add',
            'name' => $data->name,
            'referance_code' => $ref_code,
            'phone' => $data->phone,
            'app_name' => $app_name,
        ];
        Mail::to($email)->send(new CustomeraddMail($maildata));
    }catch (Throwable $t) {
        Log::error('Mail sending failed: ' . $t->getMessage());
        throw $t;
    }
    }
}
