<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DiscountController extends Controller
{
    public $page = "Discount";
    public function index(Request $request)
    {
        $data = Discount::where('deleted_at', null)->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.discount.buttons', ['item' => $row, "route" => 'discount', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $page = $this->page;
        return view('admin.v1.discount.index', compact('page'));
    }

    public function add(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'discount' => 'required',
            'min' => 'required',
            'coupon_code' => 'required',
            // 'description' => 'required',
        ]);

        if ($validate->fails()) {
            return $validate->errors();
        } else {
            $request->request->add(['created_by' => auth()->user()->id]);
            $data =  Discount::create($request->except('_token'));
            if ($data) {
                return response()->json(['success' => $this->page . " SuccessFully Added "]);
            } else {
                return response()->json(['error' => "something went wrong"]);
            }
        }
    } 

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'discount' => 'required',
            'min' => 'required',
            'coupon_code' => 'required'
        ]);
        if ($validate->fails()) {
            return $validate->errors();
        } else {
            try {

                Discount::where('id', $id)->update($request->except(['_token', '_method']));
                
                return response()->json(['success' => $this->page . " Successfully Updated "]);
            } catch (Exception $e) {
                // return response()->json(['error' => $this->page . " showing somthing wrong "]);
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }


    public function destroy($id)
    {
       
              
                Discount::where('id', $id)->update(['deleted_at' => date('Y-m-d h:i:s'), 'deleted_by' => auth()->user()->id]);
                //return "inactive";
                return redirect()->back()->with('error', 'Discount successfully inactive.');          

             

    }
    public function edit($id)
    {
        $data = Discount::find($id);
        $page = $this->page;

        return view('admin.v1.discount.edit', compact('data', 'page'));
    }
}
