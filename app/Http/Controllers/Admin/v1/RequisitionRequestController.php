<?php

namespace App\Http\Controllers\Admin\v1;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Requisition;
use App\Models\RequisitionDetails;
use App\Models\User;
use App\Models\Store;
use App\Models\AppInfo;
use App\Models\GstSlab;
use App\Models\SalePrice;
use App\Models\MasterStockInventery;
use App\Models\Discount;


class RequisitionRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $page = 'Requisition';
    public function index(Request $request)
    {
        if ((auth()->user()->role_id != 3) && (auth()->user()->type == 'central-store')) {
            abort(404);
        }
        $page = $this->page;
        if ($request->ajax()) {
            if (isAdmin()) {
                $data = Requisition::with(['store', 'supplier', 'to_store','details','rdetails'])->where('deleted_at', null)->orderByDesc('id')->get();
            }
            if (isCentral()) {
                $data = Requisition::with(['store', 'supplier', 'to_store','details','rdetails'])->where('to_store', loginStore()->id)->whereColumn('to_store', '!=', 'store_id')->where('deleted_at', null)->orderByDesc('id')->get();
            }

            if (isPublisher()) {
                $data = Requisition::with(['store', 'supplier', 'to_store','details','rdetails'])->where('deleted_at', null)->where('supplier_id', auth()->user()->id)->whereColumn('to_store', '=', 'store_id')->orderByDesc('id')->get();
            }
            foreach ($data as $item) {
                foreach ($item->toArray() as $key => $value) {
                    if ($value === null) {
                        $item->{$key} = 'null';
                    }
                }
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    //$statusBtn = ucfirst($row->status);
                    $statusBtn = view('admin.v1.requisition_request.status', ['item' => $row, "route" => 'requisition', 'page' => $this->page]);
                    return $statusBtn;
                })
                ->addColumn('download_action', function ($row) {
                    $down_actionBtn = view('admin.v1.requisition_request.pdf_buttons', ['item' => $row, "route" => 'requisition-request', 'page' => $this->page]);
                    return $down_actionBtn;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.requisition_request.buttons', ['item' => $row, "route" => 'requisition-request', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action','download_action'])
                ->make(true);
        }

        return view('admin.v1.requisition_request.index', compact('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $stores =  Store::where('deleted_at', null)->where('type', 'central-store')->get();
        $brands = Brand::where('deleted_at', null)->get();
        $suppliers = User::where('type', 'publisher')->where('store_id', loginStore()->id)->get();
        $products = Product::where('deleted_at', null)->get();
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
            try {
                $request->merge([
                    'store_id' => loginStore()->id,
                    'created_by' => auth()->user()->id,
                    'requisition_date' => date('Y-m-d'),
                ]);
                if (isCentral()) {
                    $request->merge([
                        'to_store' => loginStore()->id
                    ]);
                }
                if (isRetail()) {
                    $request->merge([
                        'supplier_id' => Store::find($request->to_store)->id
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
                            'dispatch_qty' => $request->request_qty[$i],
                            'received_qty' => $request->request_qty[$i],
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
        $stores =  Store::with(['publisher'])->where('deleted_at', null)->where('type', 'central-store')->get();
        $brands = Brand::where('deleted_at', null)->get();
        $suppliers = User::where('type', 'publisher')->get();
        $products = Product::where('deleted_at', null)->get();
        $requisation_book = Requisition::with('details.product')->where('id', $id)->get();
        $page = $this->page;
        $data = Requisition::with(['details', 'details.product.gst'])->where('deleted_at', null)->where('id', $id)->where('requisitions.status', 'pending')
            ->first();
        if (empty($data)) {
            abort(404);
        }
        // $product_id = $data->details->product_id;
        //return $data->details;
        $sale_price = '';
        if (!empty($data->details)) {
            $product_id = $data->details->first()->product_id;

            $sale_price = MasterStockInventery::where('store_id', loginStore()->id)->where('product_id', $product_id)->get();
        }

        $avail = SalePrice::where('product_id', $product_id)
            ->whereIn('sale_price', $sale_price->pluck('sale_price'))
            ->count();
        return view('admin.v1.requisition_request.edit', compact('page', 'brands', 'stores', 'suppliers', 'requisation_book', 'data', 'sale_price', 'avail', 'products'));
        //  return loginStore()->id;
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

        $validate = Validator::make($request->all(), [
            // 'supplier_id' => 'required|numeric',
            'requisition_no' => 'required|string|unique:requisitions,requisition_no,' . $id,
            'expected_delivery_date' => 'required|date',
            // 'transport_details' => 'required|string',
            // 'transport_charge' => 'required|numeric',
        ]);

        // dd($request->all());
        if ($validate->fails()) {
            return $validate->errors();
        }
        // try {
        $request->merge([
            'updated_by' => auth()->user()->id,
        ]);

        Requisition::where('id', $id)->update($request->except(['_method', '_token', 'products', 'request_qty', 'price', 'purchase_price', 'sale_price', 'batch_no', 'array_gst', 'array_cgst', 'array_igst', 'array_sgst', 'array_taxeble_amount', 'array_total_amount', 'array_tax_amount', 'tatal_tax']));
        if (count($request->products) > 0) {
            //RequisitionDetails::where('requisition_id', $id)->delete();
            for ($i = 0; $i < count($request->products); $i++) {
                RequisitionDetails::where('requisition_id', $id)->where('product_id', $request->products[$i])->update([
                    //'requisition_id' => $id,
                    //'product_id' => $request->products[$i],
                    'price' => $request->price[$i],
                    'purchase_price' => $request->purchase_price[$i],
                    //'request_qty' => $request->request_qty[$i],
                    'dispatch_qty' => $request->request_qty[$i],
                    //'received_qty' => $request->request_qty[$i],
                    'tax_amount' => $request->array_tax_amount[$i],
                    'taxeble_amount' => $request->array_taxeble_amount[$i],
                    'total_amount' => $request->array_total_amount[$i],
                    // 'purchase_price' => $request->purchase_price[$i],
                    // 'sale_price' => $request->sale_price[$i],

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

    public function availableqty(Request $request)
    {
        // $data = $request->all();
        // return response()->json($data);

        $avail = MasterStockInventery::where('store_id', loginStore()->id)
            ->where('product_id', $request->product)
            ->where('id', $request->sale_price)
            ->where('qty', '>', 0)->first();
        return response()->json($avail);
    }
    public function all_discount_for_total_amount(Request $request)
    {
        // $data = $request->all();
        // return response()->json($data);
        $total_amount = $request->total_amount;


        $avail = Discount::where('status', 'active')
            ->where('min', '<=', $total_amount)->get();
        return response()->json($avail);
    }


    public function check_discount_for_total_amount(Request $request)
    {
        // $data = $request->all();
        // return response()->json($data);
        $total_amount = $request->total_amount;
        $coupon_code = $request->coupon_code;
        $id = $request->id;


        $avail = Discount::where('status', 'active')->where('id', $id)
            ->where('coupon_code', $coupon_code)
            ->where('min', '<=', $total_amount)->first();
        return response()->json($avail);

    }  
    
    public function reqcs_print($id)
    {
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
        return view('admin.v1.requisition_request.req_update_print',compact('fetch_data','data','logo','tax'));
    }

    public function reqcs_pdf($id)
    {
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
        return view('admin.v1.requisition_request.req_update_pdf',compact('fetch_data','data','logo','tax'));

    }
}
