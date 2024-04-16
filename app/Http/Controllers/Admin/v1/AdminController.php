<?php

namespace App\Http\Controllers\Admin\v1;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Store;
use App\Models\Publisher;

class AdminController extends Controller
{
    public $page = 'User Management';

    public function index(Request $request)
    {
       // $this->page = $type;
        $page = $this->page;
        if (auth()->user()->type == "admin") {
            $data = User::with('role','store')->orderByDesc('id')->get();
           // $data = User::with('role')->where('type', $type)->orderByDesc('id')->get();
        } else {
            $data = User::with('role','store')->where('created_by', auth()->user()->id)->orderByDesc('id')->get();
        //    $data = User::with('role')->where('type', $type)->where('created_by', auth()->user()->id)->orderByDesc('id')->get();
        }
        if (isPublisher()){
            $id = auth()->user()->id;
            $data = User::with('role','store')->where('role_id', 6)
            ->orWhere('id', $id)
            ->orderByDesc('id')
            ->get();

            // $data = User::with('role' )->whereIn('role_id',[6,5])->where('id',$id)->orderByDesc('id')->get();
        }
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.admin.buttons', ['item' => $row, "route" => 'admin', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.v1.admin.index', compact('page','data'));
    }

    public function create(Request $request, $type=null)
    {
        $roles = Role::distinct('type')->pluck('type');
        // $roles = Role::distinct()->get();
         $type = Role::where('name','!=','Admin')->get();
        if (isPublisher()){
           $type = Role::where('name', 'Executive')->get();
          }
        $central_stores = Store::where('type','central-store')->where('deleted_at', null)->orderBy('store_name','asc')->get();
        $retail_stores = Store::where('type','retail-store')->where('deleted_at', null)->orderBy('store_name','asc')->get();
        $publishers = Publisher::where('deleted_at', null)->orderBy('store_name','asc')->get();
        // $page = str_replace("-", " ", $type);
        return view('admin.v1.admin.insert', compact('roles', 'central_stores','retail_stores','publishers', 'type'));
    }


    public function status($id)
    {

        $status = User::find($id);
        if ($status->status == "active") {
            User::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            User::where('id', $id)->update(['status' => 'active']);
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
        $role = $request->input('role');

        $all_required = [];

        $all_required['role']='required';
        $store_id=0;
        $publisher_id=0;
        if($role=='publisher')
        {
            $all_required['publisher_id_value']='required';
            $publisher_id = $request->input('publisher_id_value');
            $store_id=0;
        }
        else  if($role=='central-store')
        {
            $all_required['central_store_id']='required';
            $publisher_id = 0;
            $store_id=$request->input('central_store_id');
        }
        else  if($role=='retail-store')
        {
            $all_required['retail_store_id']='required';
            $publisher_id = 0;
            $store_id=$request->input('retail_store_id');
        }

        $all_required['email']='required|string|unique:users,email';
        $all_required['password']=['required', Password::defaults(), 'confirmed'];
        $all_required['role_id']='required|numeric';
        $all_required['mobile']='required|numeric';
        //$all_required['type']='required';
        $all_required['name']='required|string';


        $validate = Validator::make($request->all(), $all_required);
        if ($validate->fails()) {
            return $validate->errors();
        }
        try {
           // if (empty(get_admin_role($request->type))) {
            //    return response()->json(['error' => "First you have to create the role for " . $request->type]);
           // }
            $request->request->add(['created_by' => auth()->user()->id]);
            $request->merge(
                [
                    'password' => Hash::make($request->password),
                    'phone' => $request->mobile,
                    'type' => $request->role,                   
                    'created_by' => auth()->user()->id
                ]
            );

            if($role=='publisher')
            {
                $request->merge(
                    [
                        'publisher_id' => $publisher_id
                    ]
                );
            }
            if($role=='central-store')
            {
                $parent_id=User::where('store_id',$store_id)->first()->parent_id;
                $request->merge(
                    [
                        'store_id' => $store_id,
                        'parent_id' => $parent_id
                    ]
                );
            }
            if($role=='retail-store')
            {
                $parent_id=User::where('store_id',$store_id)->first()->parent_id;
                $request->merge(
                    [
                        'store_id' => $store_id,
                        'parent_id' => $parent_id
                    ]
                );
            }

            $user =  User::create($request->except('_token','publisher_id_value'));

            return response()->json(['success' => $this->page . " SuccessFully user Added "]);
        } catch (Exception $e) {
            // return response()->json(['error' => $this->page . " showing somthing wrong "]);
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|unique:users,email',
            'phone' => 'required|string|unique:users,mobile',
            'password' => ['required', Password::defaults(), 'confirmed'],
            'role_id' => 'required|numeric',
            //'mobile' => 'required|numeric',
            'type' => 'required|string',
            'name' => 'required|string'
        ]);
        if ($validate->fails()) {
            return $validate->errors();
        }
        try {
            if (empty(get_admin_role($request->type))) {
                return response()->json(['error' => "First you have to create the role for " . $request->type]);
            }
            $request->request->add(['created_by' => auth()->user()->id]);
            $request->merge(
                [
                    'password' => Hash::make($request->password),
                    'store_id' => auth()->user()->store_id
                ]
            );
            $user =  User::create($request->except('_token'));

            return response()->json(['success' => $this->page . " SuccessFully Added "]);
        } catch (Exception $e) {
            // return response()->json(['error' => $this->page . " showing somthing wrong "]);
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        $data = User::find($id);
        $page = $this->page;
        return view('admin.v1.admin.edit', compact('data', 'page'));
    }

    public function destroy($id)
    {
        try {
            User::destroy($id);
            return "delete";
        } catch (Exception $e) {
            return response()->json('delete',  'This Admin have Permissions So Please remove All permission for this Admin then delete this uesr ');
        }
        return response()->json('delete', $this->page . ' Deleted Successfully !!! ');
    }

    public function change_password($id)
    {
        $page = 'Change Password';
        $data = $id;
        return view('admin.v1.admin.changepassword', compact('data', 'page'));
    }

    public function updatepassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);
        if ($validate->fails()) {
            return $validate->errors();
        }
        try {
            User::find($request->id)->update(['password' => Hash::make($request->password)]);
            return response()->json(['success' => " Password SuccessFully Updated "]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function auth_change_password(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);
        if ($validate->fails()) {
            return $validate->errors();
        }
        $user = User::find(auth()->user()->id);
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['old_password' => " Old Password not matched with our records"]);
        }
        try {
            $user->update(['password' => Hash::make($request->password)]);
            return response()->json(['success' => " Password SuccessFully Updated "]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function auth_change_password_show()
    {
        $page = auth()->user()->name . " Change Password";
        return view('auth.changepassword', compact('page'));
    }

    public function user_role($role)
    {
        $data = Role::where('type',$role)->get();
        return response()->json($data);
    }

    public function get_role(Request $request)
    {
        $type = $request->type;
        $roles = Role::where('type', $type)->get();
        echo "<option selected disabled> -Select Role- </option>";
        foreach ($roles as $role) { ?>
            <option value="<?= $role->id ?>"><?= $role->name ?></option>
<?php  }
    }
}
