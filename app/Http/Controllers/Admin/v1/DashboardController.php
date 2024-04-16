<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Notification;
use App\Models\Publisher;


class DashboardController extends Controller
{
    public $page="Notification";
    public function index(){

        return view('admin.v1.admin-dashboard');
    }


    public function list_view(Request $request)
    {
        //return view('admin.v1.adminprofile.notificationtable');
         $page = $this->page;
        if ($request->ajax()) {
           
            $data =Notification::with('pubnotic')->orderByDesc('id')->get();
            return Datatables::of($data)
             ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.adminprofile.button', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action']) // this column should not be escaped?? means
                ->make(true);
        }
        return view('admin.v1.adminprofile.notificationtable', compact('page'));
    }

    public function edit_user()
    {
        $id=auth()->user()->publisher_id;
        $data= Publisher::where('id', $id)->first();
        return view('admin.v1.adminprofile.editprofile',compact('data'));
        //return $data;
    }

    public function view($id)
    {
        $editdata= Notification::where('id',$id)->first();
        return view('admin.v1.adminprofile.notificatinview',compact('editdata'));
    }

}
