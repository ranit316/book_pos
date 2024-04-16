<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\District;
use App\Events\CustomerCreate;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomerbridgeStore;
use Yajra\DataTables\DataTables;

class RetailController extends Controller
{
     public $page= 'customer';
    public function index(Request $request)
    {
        $page = $this->page;
        if ($request->ajax()) {
            $id = auth()->user()->id;
            // $data = Customer::with('address')->where('created_by', $id)->get();
            $data = CustomerbridgeStore::with('customer.cus_address')->where('store_id', auth()->user()->store_id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function($model){
                    if($model->status=='active'){
                        $formatData ='<button class="btn btn-sm btn-warning">Active</button>';
                    }
                    else if($model->status=='inactive'){
                        $formatData ='<button class="btn btn-sm btn-danger">Inactive</button>';
                    }
                    else{
                        $formatData ='<button class="btn btn-sm btn-danger">'.ucfirst($model->status).'</button>';
                    }
                   
                    return $formatData;
                })
              ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.customer.buttons', ['item' => $row, 'route'=> 'retail.customer','page' => $this->page]);
                     return $actionBtn;
               })
                ->rawColumns(['action','status'])
                 ->make(true);
         }
        // $id = auth()->user()->id;
        // $customers = Customer::with('address')->where('created_by', $id)->get();
        return view('admin.v1.customer.customerindex');
    }

    public function create()
    {
        $districts = District::where('deleted_at', null)->where('state', 'West Bengal')->get();
        $countries = District::where('deleted_at', null)->where('country', 'India')->get();
        $states = District::where('deleted_at', null)->where('country', 'India')->select('state')->distinct()->get();
        return view('admin.v1.customer.add', compact('districts','countries','states'));
    }
    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',           
            //'phone' => 'required|numeric|digits:10|unique:customers,phone',
            'gender' => 'required',
            
            // 'address' => 'required',
            //'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'district_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->WithErrors($validator)->WithInput();
        } else {
            //$id = auth()->user()->id;

            $cus_details = Customer::where('phone',$request->phone)->where('status' , 'active')->first();
            if($cus_details != null){
                $cus_bridge = new CustomerbridgeStore();
                $cus_bridge->store_id = auth()->user()->store_id;
                $cus_bridge->customer_id = $cus_details->id;
                $cus_bridge->status = "active";
                $cus_bridge->save();
                return redirect()->route('central.customer')->with('success','Added to your Store successfully');
            }else{
                $customer =  new Customer();
            $customer->name = $request->first_name.' '.$request->last_name;
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
            if($customer->save()){
                $customer_id = $customer->id;
                $data = new Address();
                $data->customer_id = $customer_id;
                $data->city = $request->city ?? '';
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
            }
            event(new CustomerCreate($request->phone));

            }
            return redirect()->route('retail.customer')->with('success', 'Added successfully');
        }
    }

    public function edit($id)
    {
        $customer = Customer::where('id', $id)->first();
        return view('admin.v1.customer.edit', compact('customer'));
    }
    
    public function update(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(),[
            'name' => 'required',          
            'phone' => 'required|numeric|digits:10|unique:customers,phone,'.$id,
            'gender' => 'required',
            'dob'  => 'required'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->WithErrors($validator)->WithInput();
        }else {
            Customer::where('id',$id)->update([
                'name'=> $request->name,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'gender'=> $request->gender,
                'dob'  =>   $request->dob,
            ]);
            return redirect()->route('retail.customer')->with('update', 'update successfully');
        }

        
    }
    public function status($id)
    {
        $status = Customer::find($id);
        if ($status->status == "active") {
            Customer::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            Customer::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }
}
