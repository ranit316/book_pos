<?php

namespace App\Http\Controllers;

use App\Models\MasterStockInventery;
use App\Models\CustomerbridgeStore;
use Illuminate\Http\Request;
use App\Models\CustomerWishlist;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DataTables;
class CustomerWishlistController extends Controller
{
    public $page = 'Customer Wishlist';

    public function customerwish(Request $request)
    {
        $page = $this->page;
        $product = MasterStockInventery::with('product')->where('qty', 0)->where('store_id', auth()->user()->store_id)->get();
        $customer = CustomerbridgeStore::with('customer')->where('store_id', auth()->user()->store_id)->get();
        
        if ($request->ajax()) {
            $data = CustomerWishlist::with('product', 'customer', 'publisher')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($page) {
                    $actionBtn = view('admin.v1.customer.buttons', ['item' => $row, 'page' => $page]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('admin.v1.customer.wishindex', compact('page', 'product', 'customer'));
    }
    
   public function store(Request $request){
   
    $validator = Validator::make($request->all(), [
        'product_id' => 'required',
        'customer_id' => 'required',
    ]);
    
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    } else {
        $id = auth()->user()->store_id;
        $entity = new CustomerWishlist();
        $entity->product_id = $request->product_id;
        $entity->customer_id = $request->customer_id;
        $entity->store_id = $id;
        $entity->status = 'active';
        $entity->save();
    
        return response()->json([
            'success' => 'Category Saved Successfully'
        ], 200);
    }
    
    
   }
}
