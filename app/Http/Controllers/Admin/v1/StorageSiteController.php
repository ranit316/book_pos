<?php

namespace App\Http\Controllers\Admin\v1;

use App\Models\StorageSite; // use for file name(track)
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Http\Controllers\Controller;


class StorageSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $page = 'StorageSite';
    public $pagename = 'Storage Site';
    public function index(Request $request)
    {
        if ((auth()->user()->role_id != 3) && (auth()->user()->type == 'central-store')) {
            abort(404);
        }

        $page = $this->page;
        $pagename = $this->pagename;
        $default_exist = StorageSite::where('store_id', loginStore()->id)->where('flag', 'default')->get()->count();
        if ($request->ajax()) {


            $data = StorageSite::with('store')->where('deleted_at', null)->where('store_id', loginStore()->id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('flag', function ($row) {
                    $flag = 'No';
                    if ($row->flag == 'default') {
                        $flag = 'Yes';
                    }

                    return $flag;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.storagesite.buttons', ['item' => $row, "route" => 'storagesites', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action']) // this column should not be escaped?? means
                ->make(true); // it is a response
        }

        return view('admin.v1.storagesite.index', compact('page', 'pagename', 'default_exist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    public function status($id)
    {
        $status = StorageSite::find($id);
        if ($status->status == "active") {
            StorageSite::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            StorageSite::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    public function default($id)
    {
        $flag = StorageSite::find($id);
        if ($flag->flag == "default") {
            StorageSite::where('id', $id)->update(['flag' => '']);
            return "InActive";
        } else {
            StorageSite::where('store_id', $flag->store_id)->update(['flag' => '']);
            StorageSite::where('id', $id)->update(['flag' => 'default']);
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
            'name' => 'required|string|unique:storage_sites,name',
            'address' => 'required|string',

        ]);
        if ($validate->fails()) {
            return $validate->errors();
        } else {
            try {
                $request->merge([
                    'created_by' => auth()->user()->id,
                    'store_id' => loginStore()->id,
                ]);

                if ($request->flag == 'default') {
                    StorageSite::where('store_id', loginStore()->id)->update(['flag' => '']);
                }
                $data =  StorageSite::create($request->except('_token'));
                if ($request->hasFile('icon')) {
                    StorageSite::where('id', $data->id)->update(['icon' => $this->insert_image($request->file('icon'), 'StorageSite')]);
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
        $data = StorageSite::find($id);
        $page = $this->page;
        $pagename = $this->pagename;

        return view('admin.v1.storagesite.edit', compact('data', 'page', 'pagename'));
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
            'name' => 'required|string|unique:storage_sites,name,' . $id,
            'address' => 'required|string',
        ]);
        if ($validate->fails()) {
            return $validate->errors();
        } else {
            try {

                if ($request->flag == 'default') {
                    StorageSite::where('store_id', loginStore()->id)->update(['flag' => '']);
                }

                $request->request->add(['updated_by' => auth()->user()->id]);
                StorageSite::where('id', $id)->update($request->except(['_token', '_method', 'icon']));
                if ($request->hasFile('icon')) {
                    $this->update_images('categories', $id, $request->file('icon'), 'StorageSite', 'icon');
                }
                return response()->json(['success' => $this->page . " SuccessFully Updated "]);
            } catch (Exception $e) {
                // return response()->json(['error' => $this->page . " showing somthing wrong "]);
                return response()->json(['error' => $e->getMessage()]);
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
            StorageSite::where('id', $id)->update(['deleted_at' => date('Y-m-d h:i:s'), 'deleted_by' => auth()->user()->id]);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page . "Can't Be Delete this May having some child"]);
        }
    }
}
