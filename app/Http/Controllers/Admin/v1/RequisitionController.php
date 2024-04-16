<?php

namespace App\Http\Controllers\Admin\v1;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MasterStockInventery;
use App\Models\Product;
use App\Models\Requisition;
use App\Models\RequisitionDetails;
use App\Models\User;
use App\Models\Store;
use App\Models\AppInfo;
use App\Models\GstSlab;
use Database\Seeders\MasterStockerSeeder;
use App\Models\SalePrice;
use Carbon\Carbon;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $page = 'Requisition';
    public function index(Request $request)
    {
        $page = $this->page;
        if ($request->ajax()) {
            if (isAdmin()) {
                $data = Requisition::with(['store', 'to_store','details', 'supplier','rdetails'])->where('deleted_at', null)->orderByDesc('id')->get();
            }
            if (isCentral()) {
                $data = Requisition::with(['store', 'to_store','details', 'supplier','rdetails'])->where('store_id', loginStore()->id)->where('deleted_at', null)->orderByDesc('id')->get();
            }
            if (isRetail()) {
                $data = Requisition::with(['store','to_store','details', 'supplier','rdetails'])->where('store_id', loginStore()->id)->where('deleted_at', null)->orderByDesc('id')->get();
            }


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    //$statusBtn = ucfirst($row->status);
                    $statusBtn = view('admin.v1.requisition.status', ['item' => $row, "route" => 'requisition', 'page' => $this->page]);
                    return $statusBtn;
                })
                ->addColumn('down_action', function ($row) {
                    $actionBtn1 = view('admin.v1.requisition.download_buttons', ['item' => $row, "route" => 'requisition', 'page' => $this->page]);
                    return $actionBtn1;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.requisition.buttons', ['item' => $row, "route" => 'requisition', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action','down_action'])
                ->make(true);
        }

        return view('admin.v1.requisition.index', compact('page'));
    }

    public function request(Request $request)
    {
        $page = $this->page;
        if ($request->ajax()) {
            if (isAdmin()) {
                $data = Requisition::with(['store', 'supplier'])->where('deleted_at', null)->orderByDesc('id')->get();
            }
            if (isCentral()) {
                $data = Requisition::with(['store', 'supplier'])->where('to_store', loginStore()->id)->whereColumn('to_store', '!=', 'store_id')->where('deleted_at', null)->orderByDesc('id')->get();
            }

            if (isPublisher()) {
                $data = Requisition::with(['store', 'supplier'])->where('deleted_at', null)->where('supplier_id', auth()->user()->id)->whereColumn('to_store', '=', 'store_id')->orderByDesc('id')->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.requisition.buttons', ['item' => $row, "route" => 'requisition', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.v1.requisition.request', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $date = Carbon::now();
        $formatteDate = $date->format('y-m');
        $sub_store = loginStore()->id;
        $storedetails = Store::where('id',$sub_store)->first();
        if($storedetails->type == 'retail-store' && $storedetails->publisher_id != null)
        {
            $stores = Store::with(['publisher','user'])->where('stores.deleted_at', null)->where('id',$storedetails->is_substore)->get();
        }else{
            $stores =  Store::with(['publisher','user'])->where('stores.deleted_at', null)->where('stores.type', 'central-store')->get();
        }
        $brands = Brand::where('deleted_at', null)->get();
        $suppliers = User::where('type', 'publisher')->where('store_id', loginStore()->id)->get();
        $products = Product::where('deleted_at', null)->get();
        $store_id = User::where('store_id', loginStore()->id)->first();
        $req = Requisition::latest()->first();
        $req_id = sprintf("%04s", ($req->id ?? 0) + 1);
        $store = sprintf("%04d", $store_id->store_id);
        $grn_no = "REQ-" . $store . "-" . $formatteDate . "-" . ($req_id);
        $page = $this->page;
        return view('admin.v1.requisition.insert', compact('page', 'brands', 'stores', 'suppliers', 'products'));
    }

    public function status($id)
    {
        $status = Requisition::find($id);
        if ($status->status == "active") {
            Requisition::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            Requisition::where('id', $id)->update(['status' => 'active']);
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
            // 'title' => 'required|string|unique:purchase,title',
        ]);

        // dd($request->all());
        if ($validate->fails()) {
            return $validate->errors();
        } else {

            $date = Carbon::now();
            $formatteDate = $date->format('y-m');
            $req = Requisition::latest()->first();
            $req_id = sprintf("%04s", ($req->id ?? 0) + 1);
            $store = sprintf("%04d", loginStore()->id);
            $grn_no = "REQ-" . $store . "-" . $formatteDate . "-" . ($req_id);

            try {
                $request->merge([
                    'requisition_no'=>$grn_no,
                    'store_id' => loginStore()->id,
                    'created_by' => auth()->user()->id,
                    'requisition_date' => date('Y-m-d'),
                ]);
                if (isCentral()) {
                    $request->merge([
                        'requisition_no'=>$grn_no,
                        'to_store' => loginStore()->id
                    ]);
                }
                if (isRetail()) {
                    $store_user_id = $request->to_store;
                    $to_store = User::where('id',$store_user_id)->first()->store_id;

                    $request->merge([
                        'requisition_no'=>$grn_no,
                        'to_store'=>$to_store,
                        'supplier_id' => $request->to_store
                    ]);
                }

                $data =  Requisition::create($request->except(['_token', 'products', 'request_qty', 'mrp_price', 'purchase_price', 'sale_price', 'batch_no', 'array_gst', 'array_cgst', 'array_igst', 'array_sgst', 'array_taxeble_amount', 'array_total_amount']));

                if (count($request->products) > 0) {
                    for ($i = 0; $i < count($request->products); $i++) {
                        RequisitionDetails::create([
                            'requisition_id' => $data->id,
                            'product_id' => $request->products[$i],
                            'price' => $request->price[$i],
                            'request_qty' => $request->request_qty[$i],
                            //'dispatch_qty' => $request->request_qty[$i],
                            //'received_qty' => $request->request_qty[$i],
                            'tax_amount' => 0,
                            'taxeble_amount' => $request->array_taxeble_amount[$i],
                            'total_amount' => $request->array_total_amount[$i],
                        ]);
                    }
                }
                return response()->json(['success' => $this->page . " SuccessFully Added "]);
            } catch (Exception $e) {
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
        $stores =  Store::with(['publisher'])->where('deleted_at', null)->where('type', 'central-store')->get();
        $brands = Brand::where('deleted_at', null)->get();
        $suppliers = User::where('type', 'publisher')->get(); 
        $products = Product::where('deleted_at', null)->get(); 
        // $requisation_book = RequisitionDetails::all();  
        $page = $this->page;
        $data = Requisition::with('details')->where('deleted_at', null)->where('id', $id)->whereIn('requisitions.status',['approved'])->first(); 
        if(empty($data))
        {
            abort(404);
        }
         $sale_price='';
        if (!empty($data->details)) {
            $product_id = $data->details->first()->product_id;
   
           // $sale_price = SalePrice::where('store_id', loginStore()->id)->where('product_id', $product_id)->get();
        }
       return view('admin.v1.requisition.show', compact('page', 'brands', 'stores', 'suppliers', 'products', 'data','sale_price'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stores =  Store::with(['publisher'])->where('deleted_at', null)->where('type', 'central-store')->get();
        $brands = Brand::where('deleted_at', null)->get();
        $suppliers = User::where('type', 'publisher')->get(); 
        $products = Product::where('deleted_at', null)->get(); 
        // $requisation_book = RequisitionDetails::all();  
        $page = $this->page;
        $data = Requisition::with('details')->where('deleted_at', null)->where('id', $id)->where('requisitions.status','pending')->first();
        if(empty($data))
        {
            abort(404);
        }
         $sale_price='';
        if (!empty($data->details)) {
            $product_id = $data->details->first()->product_id;
   
           // $sale_price = SalePrice::where('store_id', loginStore()->id)->where('product_id', $product_id)->get();
        }
       return view('admin.v1.requisition.edit', compact('page', 'brands', 'stores', 'suppliers', 'products', 'data','sale_price'));
    //    return $sale_price;
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
        //print_r($request->all());
        //return;
        //return response()->json(['success' => $this->page . " SuccessFully Updated ",'data'=>$request->products]);
        //die();
        //return;

        $validate = Validator::make($request->all(), [
             'requisition_no' => 'string',
        ]);

        // dd($request->all());
        if ($validate->fails()) {
            return $validate->errors();
        }
        // try {
        $request->merge([
            'updated_by' => auth()->user()->id,
        ]);
        // return $sale_price;
        Requisition::where('id', $id)->update($request->except(['_method', '_token', 'products', 'request_qty', 'price', 'purchase_price', 'sale_price', 'batch_no', 'array_gst', 'array_cgst', 'array_igst', 'array_sgst', 'array_taxeble_amount', 'array_total_amount', 'array_tax_amount', 'tatal_tax']));
        if (count($request->products) > 0) {
            RequisitionDetails::where('requisition_id', $id)->delete();
            for ($i = 0; $i < count($request->products); $i++) {
                RequisitionDetails::create([
                    'requisition_id' => $id,
                    'product_id' => $request->products[$i],
                    'price' => $request->price[$i],
                    //'sale_price' => $request->sale_price[$i],
                    'request_qty' => $request->request_qty[$i],
                    //'dispatch_qty' => $request->request_qty[$i],
                    //'received_qty' => $request->request_qty[$i],
                    'tax_amount' => 0,
                    'taxeble_amount' => $request->array_taxeble_amount[$i],
                    'total_amount' => $request->array_total_amount[$i],
                    'updated_at' => date('Y-m-d h:i:s')
                ]);
            }
        }
        return response()->json(['success' => $this->page . " SuccessFully Updated "]);
        // } catch (Exception $e) {
        //     return response()->json(['error' => $e->getMessage()]);
        // }
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
            Requisition::where('id', $id)->update(['deleted_at' => date('Y-m-d h:i:s'), 'deleted_by' => auth()->user()->id]);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page . "Can't Be Delete this May having some child"]);
        }
    }
    public function search($product)
    {
        $products =  Product::where('deleted_at', null)->where('title', 'like', '%' . $product . '%')->limit(50)->get();

        foreach ($products as $p) { ?>
            <option value="<?= $p->title ?>"></option>
<?php }
    }

    function productPrice($product_id = null)
    {
        $data = Product::find($product_id);
        return $data;
    }

    function getProductByCentralstore(Request $request)
    {
        $store_data = User::where('id', $request->to_store)->get();
        
        $products = Product::where('status','active')->where('deleted_at', null)->where('supplier_id', $store_data[0]->parent_id)->get();       
        
        return $products; 
    }

    public function print_req($id)
    {
        //return $id;
        $fetch_data = Requisition::with(['details.product','store'])->where('id',$id)->first();
        $data = Store::where('id',$fetch_data->to_store)->first();
        //$data = Setting::with('store')->where('store_id', loginStore()->id)->first();
        $tax = GstSlab::first();
        $logo = AppInfo::first();
        $baseURL = request()->root();
        if ($logo) {
            $logo->logo = $baseURL . '/' . $logo->logo;
        }
        if ($data->store) {
            $data->store->signature = $baseURL . '/' . $data->store->signature;
        }
        // return [$data, $fetch_data];
        return view('admin.v1.requisition.requsition_print',compact('fetch_data','data','logo','tax'));

    }

    public function download_pdf($id)
    {
         //return $id;
         $fetch_data = Requisition::with(['details.product','store'])->where('id',$id)->first();
         $data = Store::where('id',$fetch_data->to_store)->first();
         //$data = Setting::with('store')->where('store_id', loginStore()->id)->first();
         $tax = GstSlab::first();
         $logo = AppInfo::first();
         $baseURL = request()->root();
         if ($logo) {
             $logo->logo = $baseURL . '/' . $logo->logo;
         }
         if ($data->store) {
             $data->store->signature = $baseURL . '/' . $data->store->signature;
         }
         // return [$data, $fetch_data];
         return view('admin.v1.requisition.requsition_pdf_download',compact('fetch_data','data','logo','tax'));
    }

}
