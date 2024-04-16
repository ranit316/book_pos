<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public $page = 'Unit';
    public function index(Request $request)
    {
        $page = $this->page;
        if ($request->ajax()) {
            $data = Unit::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.unit.button', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action']) // this column should not be escaped?? means
                ->make(true); // it is a response
        }
        // $unit = Unit::all();
        return view('admin.v1.unit.index',compact('page'));
    }
    public function post(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $unit = new Unit();
            $unit->name = $request->name;
            $unit->description = $request->description;
            $unit->status = 'active';
            $unit->save();
            return redirect()->route('admin.inx.unit')->with('success','Unit Added Successfully');
        }
    }
    public function update(Request $request,$id)
    {
         $validator = Validator::make($request->all(),[
            'name'=> 'required',
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }else{
             Unit::where('id',$id)->update([
                'name'=> $request->name,
                // 'status' => $request->status,
                'description' =>$request->description,
             ]);
             return response()->json(['success' => $this->page . "SuccessFully updated" ]);
        }
    }

    
    public function delete($id){
        Unit::find($id)->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        $page = $this->page;
        $data = Unit::where('id',$id)->first();
        return view ('admin.v1.unit.edit', compact('data','page'));
    }
}
