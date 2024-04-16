<?php

namespace App\Http\Controllers\Admin\v1;

use App\Models\Store;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Notification;
use App\Models\User;
use App\Models\Publisher;
use App\Models\Rack;
use App\Models\Setting;
use App\Models\StorageLocation;
use App\Models\StorageSite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Mail\Centrakmail;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $page = 'Store';
    public function index(Request $request, $type)
    {
        $this->page = $type;
        $page = $this->page;

        if ($type == 'central-store') {
            $pagename = 'Central Store';
        } else if ($type == 'retail-store') {
            $pagename = 'Retail Store';
        } else {
            $pagename = $type;
        }


        // if ($request->ajax()) { 
        //  $data = Store::with('district')->wthere('deleed_at', null)->where('created_by', auth()->user()->id)->get();
        if (auth()->user()->type == "admin") {
            if ($type == 'central-store') {
                $data = Store::with('district')->with('user')->whereNotNull('publisher_id')->where('deleted_by', null)->orderBy('id', 'DESC')->get();
            } else {
                $data = Store::with('district')->with('user')->whereNull('publisher_id')->where('deleted_by', null)->orderBy('id', 'DESC')->get();
            }
        } else {
            $user_publisher_data = User::with('publisher')->where('id', auth()->user()->id)->first();
            //return  $user_publisher_data->publisher->id;
            //$data = Store::with('district')->where('type', $type)->where('publisher_id', $user_publisher_data->publisher->id)->where('deleted_by', null)->orderBy('id', 'DESC')->get();
            $data = Store::with('district')
                ->with('user')
                ->where('type', $type)
                ->where('deleted_by', null)
                ->when($user_publisher_data->publisher, function ($query) use ($user_publisher_data) {
                    $query->where('publisher_id', $user_publisher_data->publisher->id);
                })
                ->orderBy('id', 'DESC')
                ->get();
            //logo_image
            //return $data;
            /*  $data = User::query()
                ->with(['store' => function ($query) {
                    $query->select(['']);
                }])->where('type', $type)->where('parent_id', auth()->user()->id)->where('deleted_by', null)->orderBy('id', 'DESC')->get();
                $r = $data[0]->store; */
        }
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('Type', function ($row) {
                    if ($row->is_substore == null && $row->type == 'retail-store') {
                        return "Retail Store";
                    } elseif ($row->is_substore == null) {
                        return "Master Central Store";
                    } elseif ($row->is_substore != null) {
                        return "Sub Central Store";
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.store.buttons', ['item' => $row, "route" => 'stores', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $districts = District::where('deleted_at', null)->where('state', 'West Bengal')->get();
        $publishers = Publisher::where('deleted_at', null)->where('status', 'active')->get();
        $store = Store::where('type', 'central-store')->where('is_substore', null)->where('publisher_id', auth()->user()->publisher_id)->get();
        $asset = asset('');
        return view('admin.v1.store.index', compact('page', 'districts', 'publishers', 'pagename', 'asset', 'store'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $type)
    {
        $page = str_replace("-", " ", $type);
    }

    public function status($id)
    {
        $status = Store::find($id);
        if ($status->status == "active") {
            Store::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            Store::where('id', $id)->update(['status' => 'active']);
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
        //return $request->all();
        $validate = Validator::make($request->all(), [
            'store_name' => 'required|string|unique:stores,store_name',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required|string|digits:10',
            'password' => ['required', Password::defaults(), 'confirmed'],
            'billing_header' => 'required'
            /* 'publisher_id' => 'required', */

        ]);
        $password = $request->password;
        if ($validate->fails()) {
            return $validate->errors();
        } else {
            try {
                // DB::enableQueryLog();

                if (empty(get_admin_role($request->type))) {
                    return response()->json(['error' => "First you have to create the role for " . $request->type]);
                }
                if (auth()->user()->type == "admin" && $request->type != 'retail-store') {

                    $publisher_user_data = Publisher::with('user')->where('id', $request->publisher_id)->first();
                    //return  $publisher_user_data->user->id;
                    $publisher_user_id = $publisher_user_data->user->id;
                } else {
                    $publisher_user_id = auth()->user()->id;
                    $request->request->add(['publisher_id' => auth()->user()->publisher_id]);
                }
                $request->request->add(['created_by' => auth()->user()->id]);
                if ($request->store_type == 'master') {
                    $data =  Store::create($request->except('_token'));
                } elseif ($request->store_type == 'substore') {
                    $request->request->add(['is_substore' => $request->master_store_id, 'type' => 'Sub-Central-Store
                    ']);
                    $data =  Store::create($request->except('_token'));
                } else {
                    $data =  Store::create($request->except('_token'));
                }

                if ($request->hasFile('logo_image')) {
                    if (!is_dir(public_path("upload/store"))) {
                        mkdir(public_path("upload/store"));
                    }
                    //return $request->file('image');
                    Store::where('id', $data->id)->update(['logo_image' => $this->insert_image($request->file('logo_image'), 'store')]);
                }

                if ($request->hasFile('signature')) {
                    if (!is_dir(public_path("upload/store"))) {
                        mkdir(public_path("upload/store"));
                    }
                    //return $request->file('image');
                    Store::where('id', $data->id)->update(['signature' => $this->insert_image($request->file('signature'), 'store')]);
                }


                //$publisher_user_id = $publisher_user_data[0]->user->id;
                $request->merge(
                    [
                        'store_id' => $data->id,
                        //'role_id' => get_admin_role($request->type),
                        'parent_id' => $publisher_user_id,
                        'password' => Hash::make($request->password),
                        'created_by' => auth()->user()->id,
                    ]
                );

                // return $request->all();
                if ($request->store_type == 'master') {
                    $request->merge(
                        [
                            'role_id' => get_admin_role($request->type),
                        ]
                    );
                    $user =  User::query()->create($request->except('_token', 'publisher_id'))->toSql();

                }elseif($request->store_type == 'substore'){
                    $request->merge(
                        [
                            'role_id' => 9,
                            'type' => 'Sub-Central-Store'
                        ]
                    );
                    $user =  User::query()->create($request->except('_token', 'publisher_id'))->toSql();
                }else{
                    $request->merge(
                        [
                            'role_id' => get_admin_role($request->type),
                        ]
                    );
                    $user =  User::query()->create($request->except('_token', 'publisher_id'))->toSql();
                }
                //$user =  User::query()->create($request->except('_token', 'publisher_id'))->toSql();
                $notic_user = User::where('store_id', $data->id)->first();

                // return (DB::getQueryLog());
                $settingData = [
                    'store_id' => $data->id,
                    'value' => $request->input('billing_header'),
                    'key' => "billing_header"

                ];
                $setting = Setting::create($settingData);

                if ($setting) {
                    $this->storage($data);
                }
                if ($data->type == "central-store") {
                    $data2 = [
                        'user_id' => $notic_user->id,
                        'message' => "Store Added Successfully",
                        'date_time' => Carbon::now(),
                        'is_read' => "unread",
                        'type' => "central",
                    ];
                } else {
                    $data2 = [
                        'user_id' => $notic_user->id,
                        'message' => "Store Added Successfully",
                        'date_time' => Carbon::now(),
                        'is_read' => "unread",
                        'type' => "Retail",
                    ];
                }

                $this->notification($data2);
                if ($notic_user->email) {
                    $this->centrastoremail($notic_user->email, $notic_user->id, $password);
                }
                if (empty($user)) {
                    Store::delete($data->id);
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
        $data = Store::find($id);
        $page = $this->page;
        $districts = District::where('deleted_at', null)->where('state', 'West Bengal')->get();
        $publishers = Publisher::where('deleted_at', null)->where('status', 'active')->get();
        $user = User::where('store_id', $id)->first();

        $setting = '';
        $settingData = [
            'store_id' => $id,
            'key' => "billing_header"

        ];
        $setting_qu = Setting::where($settingData);
        if ($setting_qu->get()->count() > 0) {
            $setting = $setting_qu->first();
        }

        // 'value' => $request->input('billing_header'),



        return view('admin.v1.store.edit', compact('data', 'page', 'districts', 'user', 'publishers', 'setting'));
    }

    public function view($id)
    {
        $data = Store::find($id);
        $page = $this->page;
        $districts = District::where('deleted_at', null)->where('state', 'West Bengal')->get();


        return view('admin.v1.store.view', compact('data', 'page', 'districts'));
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
        $validate = Validator::make($request->all(), [
            'store_name' => 'required|string|unique:stores,store_name,' . $id,
        ]);
        if ($validate->fails()) {
            return $validate->errors();
        }
        try {
            $request->request->add(['updated_by' => auth()->user()->id]);
            // Store::where('id', $id)->update($request->except(['_token', '_method']));
            // return response()->json(['success' => $this->page . " SuccessFully Updated "]);
            $store = Store::find($request->id);
            // dd($publisher);

            if ($store) {


                $store->update([
                    'store_name' => $request->store_name,
                    'district_id' => $request->district_id,
                    'status' => $request->status,
                    'address' => $request->address,
                    'description' => $request->description,
                    'pin_code' => $request->pin_code,
                    'bank_name' => $request->bank_name,
                    'acc_holder_name' => $request->acc_holder_name,
                    'acc_no' => $request->acc_no,
                    'ifsc_code' => $request->ifsc_code,
                    'gst_no' => $request->gst_no,
                    'map_url' => $request->map_url,
                ]);

                if ($request->hasFile('logo_image')) {
                    if (!is_dir(public_path("upload/store"))) {
                        mkdir(public_path("upload/store"));
                    }
                    //return $request->file('image');
                    Store::where('id', $request->id)->update(['logo_image' => $this->insert_image($request->file('logo_image'), 'store')]);
                }

                if ($request->hasFile('signature')) {
                    if (!is_dir(public_path("upload/store"))) {
                        mkdir(public_path("upload/store"));
                    }
                    //return $request->file('image');
                    Store::where('id', $request->id)->update(['signature' => $this->insert_image($request->file('signature'), 'store')]);
                }

                $user = User::where('id', $request->user_id)->first();
                $user->update([
                    'name' => $request->name
                ]);

                $setting = '';
                $settingData = [
                    'store_id' => $request->id,
                    'key' => "billing_header"

                ];
                $setting_qu = Setting::where($settingData);
                if ($setting_qu->get()->count() > 0) {
                    $setting = $setting_qu->first();
                    $setting->update(['value' => $request->input('billing_header')]);
                }

                // 'value' => $request->input('billing_header'),

                return response()->json(['success' => $this->page . "Successfully updated"]);
            } else {
                return response()->json(['error' => 'Store not found'], 404);
            }
        } catch (Exception $e) {
            // return response()->json(['error' => $this->page . " showing somthing wrong "]);
            return response()->json(['error' => $e->getMessage()]);
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
            Store::where('id', $id)->update(['deleted_at' => date('Y-m-d h:i:s'), 'deleted_by' => auth()->user()->id]);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page . "Can't Be Delete this May having some child"]);
        }
    }

    public function storage($data)
    {
        $id = auth()->user()->id;
        $storage_site = [
            'store_id' => $data->id,
            'name' => 'storage_site default',
            'address' => $data->address,
            'pincode' => $data->pin_code,
            'description' => "This is Default",
            'created_by' => $id,
            'flag' => "default",
        ];
        $storagesite = StorageSite::create($storage_site);

        if ($storagesite) {
            $storage_location = [
                'name' => "room-1",
                'sub_location_name' => "room-1",
                'storage_site_id' => $storagesite->id,
                'description' => "This is Default",
                'flag' => "default",
                'created_by' => $id,
            ];
            $storagelocation = StorageLocation::create($storage_location);

            if ($storagelocation) {
                $racks = [
                    'name' => "rack-1",
                    'storage_site_id' => $storagesite->id,
                    'storage_location_id' => $storagelocation->id,
                    'created_by' => $id,
                    'flag' => "default",
                    'store_id' => $data->id
                ];
                $rack = Rack::create($racks);
            }
        }
    }
    public function notification($data)
    {
        // $user_notification = User::create($request->except('_token'));
        $notification = Notification::create([
            'user_id' => $data['user_id'],
            'message' => $data['message'],
            'date_time' => Carbon::now(),
            'is_read' => $data['is_read'],
            'type' => $data['type'],
        ]);
    }
    public function centrastoremail($email, $id, $password)
    {
        $data = User::where('id', $id)->first();
        try {
            if ($data->type == "central-store") {
                $maildata = [
                    'title' => "central Added Successfully",
                    'name' => $data->name,
                    'email' => $data->email,
                    'password' => $password,
                    'role' => 'Central Admin',
                    'subject' => 'Central Mail'
                ];
            } else if ($data->type == "retail-store") {
                $maildata = [
                    'title' => "Retail Added Successfully",
                    'name' => $data->name,
                    'email' => $data->email,
                    'password' => $password,
                    'role' => "Retail Admin",
                    'subject' => 'Retail Mail'
                ];
            }

            Mail::to($email)->send(new Centrakmail($maildata));
        } catch (Throwable $t) {
            Log::error('Mail sending failed: ' . $t->getMessage());
            //throw $t;
        }
    }

    public function getstore($id)
    {
        $data = Store::where('publisher_id', $id)->where('type', 'central-store')->where('is_substore', null)->get();
        return $data;
    }
}
