<?php

namespace App\Http\Controllers\Admin\v1;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Store;
use App\Models\Setting;
use App\Models\District;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page = 'Publishers';
    public function index(Request $request)
    {
        $page = $this->page;
        if ($request->ajax()) {
            //  $data = Publisher::with('district')->where('deleted_at', null)->where('created_by', auth()->user()->id)->get();
            if (auth()->user()->type == "admin") {
                $data = Publisher::with('district')->with('user')->where('deleted_at', null)->latest()->get();
            } else {
                $data = Publisher::with('district')->with('user')->where('deleted_at', null)->where('created_by', auth()->user()->id)->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.publisher.buttons', ['item' => $row, "route" => 'publisher', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $districts = District::where('deleted_at', null)->where('state', 'West Bengal')->get();
        return view('admin.v1.publisher.index', compact('page', 'districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function status($id)
    {
        $status = Publisher::find($id);
        if ($status->status == "active") {
            Publisher::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            Publisher::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'store_name' => 'required|string|unique:publishers,store_name',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required|string|digits:10',
            'password' => ['required', Password::defaults(), 'confirmed'],
            //'billing_header' => 'required'

        ]);
        $password = $request->password;

        if ($validate->fails()) {
            return $validate->errors();
        } else {
            try {
                if (empty(get_admin_role($request->type))) {
                    return response()->json(['error' => "First you have to create the role for " . $request->type]);
                }
                //return $request->all();
                $request->request->add(['created_by' => auth()->user()->id]);

                $data =  Publisher::create($request->except('_token', 'type', 'phone', 'name'));
                if ($request->hasFile('logo_image')) {
                    if (!is_dir(public_path("upload/publisher"))) {
                        mkdir(public_path("upload/publisher"));
                    }
                    //return $request->file('image');
                    Publisher::where('id', $data->id)->update(['logo_image' => $this->insert_image($request->file('logo_image'), 'publisher')]);
                }

                if ($request->hasFile('signature')) {
                    if (!is_dir(public_path("upload/publisher"))) {
                        mkdir(public_path("upload/publisher"));
                    }
                    //return $request->file('image');
                    Publisher::where('id', $data->id)->update(['signature' => $this->insert_image($request->file('signature'), 'publisher')]);
                }
                $request->merge(
                    [
                        'publisher_id' => $data->id,
                        'parent_id' => auth()->user()->id,
                        'role_id' => get_admin_role($request->type),
                        'password' => Hash::make($request->password),
                        'created_by' => auth()->user()->id

                    ]
                );
                $user =  User::create($request->except('_token'));
                $notification = Notification::create([
                    'publisher_id' => $data->id,
                    'message' => "Store Added Successfully",
                    'date_time' => Carbon::now(),
                    'is_read' => "unread",
                    'user_id' =>  $user->id,
                    'type' => "publisher",
                ]);

                if ($user->email) {
                    $this->publisheraddmail($user->email,$user->id,$password);
                }

                if (empty($user)) {
                    Publisher::delete($data->id);
                }

                return response()->json(['success' => $this->page . " SuccessFully Added "]);
            } catch (Exception $e) {
                // return response()->json(['error' => $this->page . " showing somthing wrong "]);
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Publisher::find($id);
        $page = $this->page;
        $user = User::where('publisher_id',$id)->first();
        $districts = District::where('deleted_at', null)->where('state', 'West Bengal')->get();


        return view('admin.v1.publisher.edit', compact('data', 'page', 'districts','user'));
    }

    public function view($id)
    {
        $data = Publisher::find($id);
        $user = User::where('publisher_id',$id)->first();
        $page = $this->page;
        $districts = District::where('deleted_at', null)->where('state', 'West Bengal')->get();
        return view('admin.v1.publisher.view', compact('data', 'page', 'districts','user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */




    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'store_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {

           // return response()->json(['error' => $request->all()]);

            $publisher = Publisher::find($request->id);
            // dd($publisher);

            if ($publisher) {
               
                
                $publisher->update([
                    'store_name' => $request->store_name,
                    'district_id' => $request->district_id,
                    'status' => $request->status,
                    'address' => $request->address,
                    'description' => $request->description,
                    'pin_code' => $request->pin_code,
                    'bank_name'=> $request->bank_name,
                    'acc_holder_name'=> $request->acc_holder_name,
                    'acc_no'=> $request->acc_no,
                    'ifsc_code'=> $request->ifsc_code,
                    'gst_no'=> $request->gst_no,
                    'map_url'=> $request->map_url,
                    
                ]);

                if ($request->hasFile('logo_image')) {
                    if (!is_dir(public_path("upload/publisher"))) {
                        mkdir(public_path("upload/publisher"));
                    }
                    //return $request->file('image');
                    Publisher::where('id', $request->id)->update(['logo_image' => $this->insert_image($request->file('logo_image'), 'publisher')]);
                }

                if ($request->hasFile('signature')) {
                    if (!is_dir(public_path("upload/publisher"))) {
                        mkdir(public_path("upload/publisher"));
                    }
                    //return $request->file('image');
                    Publisher::where('id', $request->id)->update(['signature' => $this->insert_image($request->file('signature'), 'publisher')]);
                }

                $user = User::where('publisher_id',$request->id)->first();
                $user->update([
                    'name' => $request->name
                ]);

                return response()->json(['success' => $this->page . "Successfully updated"]);
            } else {
                return response()->json(['error' => 'Publisher not found'], 404);
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Publisher::where('id', $id)->update(['deleted_at' => date('Y-m-d h:i:s'), 'deleted_by' => auth()->user()->id]);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page . "Can't Be Delete this May having some child"]);
        }
    }

    public function publisheraddmail($email,$id,$password)
    {
        $data = User::where('id',$id)->first();
        try {
            $maildata = [
                'title' => "Publisher Added Successfully",
                'name' => $data->name,
                'email' => $data->email, 
                'password' => $password,
                'admin_id' => "admin@ica.book.store.com",
            ];
            $ccEmails = ['admin@ica.book.store.com'];
            $bccEmails = ['arnabr.timd@gmail.com'];
            Mail::to($email)
            ->cc($ccEmails)
            ->bcc($bccEmails)
            ->send(new NotificationMail($maildata));
        } catch (Throwable $t) {
            Log::error('Mail sending failed: ' . $t->getMessage());
            //throw $t;
        }
    }
}
