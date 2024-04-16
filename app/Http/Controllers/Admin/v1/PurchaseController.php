<?php

namespace App\Http\Controllers\Admin\v1;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\RequisitionDetails;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\User;
use App\Models\Store;
use App\Models\AppInfo;
use App\Models\Grn;
use App\Models\GstSlab;
use Illuminate\Support\Carbon;
use App\Models\Requisition;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $page = 'Purchase Order';
    public function index(Request $request)
    {
        if ((auth()->user()->role_id != 3) && (auth()->user()->type == 'central-store')) {
            abort(404);
        }

        $page = $this->page;
        if ($request->ajax()) {
            if (isAdmin()) {
                $data = Purchase::with(['store', 'supplier'])->where('deleted_at', null)->orderByDesc('id')->get();
            }
            if (isCentral()) {
                $data = Purchase::with(['details', 'store', 'supplier'])->where('deleted_at', null)->where('to_store', loginStore()->id)->orderByDesc('id')->get();
            }
            if (isRetail()) {
                $data = Purchase::with(['store', 'supplier', 'store', 'store2'])->where('deleted_at', null)->where('store_id', loginStore()->id)->orderByDesc('id')->get();
            }
            if (isPublisher()) {
                $data = Purchase::with(['store', 'supplier'])->where('deleted_at', null)->where('supplier_id', auth()->user()->id)->orderByDesc('id')->get();
            }


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.purchase.buttons', ['item' => $row, "route" => 'purchase', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->addColumn('download', function ($row) {
                    $actionBtn = view('admin.v1.purchase.downloadbutton', ['item' => $row,  'page' => $this->page]);
                    return $actionBtn;
                })
                ->addColumn('no_book', function ($row) {
                    $no_book = PurchaseDetails::where('purchase_id', $row->id)->get();
                    $qty = 0;
                    if ($no_book->count() > 0) {
                        foreach ($no_book as $book) {
                            $qty = $qty + $book->request_qty;
                        }
                        return $qty;
                    }
                    return  $qty;
                })
                ->addColumn('grn_no', function ($row) {
                    $grn_no = Grn::select('grn_no')->where('po_no', $row->po_no)->first();
                    return $grn_no ? $grn_no->grn_no : null;
                })
                ->editColumn('updated_at', function ($item) {
                    return $item->updated_at->format('Y-m-d H:i:s');
                })
                ->editColumn('po_date', function ($item) {
                    return $item->updated_at->format('Y-m-d H:i:s');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.v1.purchase.index', compact('page'));
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
        $stores =  Store::with(['publisher', 'user'])->where('stores.deleted_at', null)->where('stores.type', 'central-store')->get();

        $data['brands'] = Brand::where('deleted_at', null)->get();
        $data['suppliers'] = User::where('type', 'publisher')->get();
        $data['products'] = Product::where('status', 'active')->where('deleted_at', null)->get();
        $data['requisitions'] = Requisition::where('deleted_at', null)->where('store_id', loginStore()->id)->where('status', 'approved')->get();
        $data['page'] = $this->page;
        $store_id = User::where('store_id', loginStore()->id)->first();
        $po = Purchase::latest()->first();
        $po_id = sprintf("%04s", ($po->id ?? 0) + 1);
        $store = sprintf("%04d", $store_id->store_id);
        $po_no = "PO-" . $store . "-" . $formatteDate . "-" . ($po_id);
        $data['po_no'] = $po_no;

        return view('admin.v1.purchase.insert', $data);
    }

    public function status($id)
    {
        $status = Purchase::find($id);
        if ($status->status == "active") {
            Purchase::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            Purchase::where('id', $id)->update(['status' => 'active']);
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
        //return response()->json(['data' => $request->all()]);



        $date = Carbon::now();
        $formatteDate = $date->format('y-m');
        $po = Purchase::latest()->first();
        $store_id = User::where('store_id', loginStore()->id)->first();
        $po_id = sprintf("%04s", ($po->id ?? 0) + 1);
        $store = sprintf("%04d", $store_id->store_id);
        $po_no = "PO-" . $store . "-" . $formatteDate . "-" . ($po_id);


        $validate = Validator::make($request->all(), [
            //'po_no' => 'required|string|unique:purchases,po_no',
            'requisition_no' => 'required|string|unique:purchases,requisition_no',

        ]);


        if (isCentral()) {
            $request->merge([
                'to_store' => loginStore()->id
            ]);
        }
        if (isRetail()) {
            $store_user_id = $request->to_store;
            $to_store = User::where('id', $store_user_id)->first()->store_id;

            $request->merge([
                'to_store' => $to_store,
                'supplier_id' => $request->to_store
            ]);
        }
        if ($validate->fails()) {
            return $validate->errors();
        } else {
            try {
                $request->merge([
                    'store_id' => loginStore()->id,
                    'created_by' => auth()->user()->id,
                    'dispatch_by' => auth()->user()->id,
                    'round_off_amount' => $request->round_off_amount,
                    'paid_amount' => $request->total_amount,
                    'po_no' => $po_no

                ]);
                DB::beginTransaction();
                Requisition::where('requisition_no', $request->requisition_no)->update([
                    'status' => 'PO Generated'
                ]);
                $data =  Purchase::create($request->except(['_token', 'products', 'request_qty', 'mrp_price', 'purchase_price', 'sale_price', 'batch_no', 'array_gst', 'array_cgst', 'array_igst', 'array_sgst', 'array_taxeble_amount', 'array_total_amount', 'description']));

                if (count($request->products) > 0) {
                    for ($i = 0; $i < count($request->products); $i++) {
                        PurchaseDetails::create([
                            'purchase_id' => $data->id,
                            'product_id' => $request->products[$i],
                            'price' => $request->price[$i],
                            'request_qty' => $request->request_qty[$i],
                            //'dispatch_qty' => $request->request_qty[$i],
                            'tax_amount' => $request->array_tax_amount[$i],
                            'taxeble_amount' => $request->array_taxeble_amount[$i],
                            'total_amount' => $request->array_total_amount[$i],
                            'purchase_price' => $request->purchase_price[$i],
                            // 'sale_price' => $request->sale_price[$i],
                            // 'batch_no' => $request->batch_no[$i],
                            'cgst' => $request->array_cgst[$i] ?? 0,
                            'sgst' => $request->array_sgst[$i] ?? 0,
                            'igst' => $request->array_igst[$i] ?? 0,
                            'updated_at' => date('Y-m-d h:i:s')
                        ]);
                    }
                }
                DB::commit();
                return response()->json(['success' => $this->page . " SuccessFully Added "]);
            } catch (Exception $e) {
                DB::rollBack();
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
        $stores =  Store::where('deleted_at', null)->get();
        $brands = Brand::where('deleted_at', null)->get();
        $suppliers = User::where('type', 'publisher')->get();
        $products = Product::where('status', 'active')->where('deleted_at', null)->get();
        $page = $this->page;
        $data = Purchase::with('details')->where('deleted_at', null)->where('id', $id)->first();
        return view('admin.v1.purchase.show', compact('page', 'brands', 'stores', 'suppliers', 'products', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stores =  Store::with(['publisher'])->where('deleted_at', null)->get();
        $brands = Brand::where('deleted_at', null)->get();
        $suppliers = User::where('type', 'publisher')->get();
        $products = Product::where('status', 'active')->where('deleted_at', null)->get();
        $page = $this->page;
        $data = Purchase::with('details')->where('deleted_at', null)->where('id', $id)->first();
        return view('admin.v1.purchase.edit', compact('page', 'brands', 'stores', 'suppliers', 'products', 'data'));
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
            'title' => 'required|string|unique:purchase,title,' . $id,
            'image' => 'image|mimes:png,jpg',
        ]);
        if ($validate->fails()) {
            return $validate->errors();
        } else {
            try {
                $request->request->add(['updated_by' => auth()->user()->id]);
                Purchase::where('id', $id)->update($request->except(['_token', '_method', 'image']));
                if ($request->hasFile('image')) {
                    $this->update_images('purchase', $id, $request->file('image'), 'product', 'image');
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
            Purchase::where('id', $id)->update(['deleted_at' => date('Y-m-d h:i:s'), 'deleted_by' => auth()->user()->id]);
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

    public function get_requisition($requistion_no = null)
    {

        if (empty($requistion_no)) {
            return '<div class="alert alert-danger" role="alert">
                      Please Enter the Requisition number
           </div>';
        }

        $stores =  Store::with(['publisher', 'user'])->where('stores.deleted_at', null)->where('stores.type', 'central-store')->get();

        $brands = Brand::where('deleted_at', null)->get();
        $suppliers = User::where('type', 'publisher')->get();
        $products = Product::where('status', 'active')->where('deleted_at', null)->get();
        $page = $this->page;
        $data = Requisition::with(['details', 'store', 'supplier', 'to_store'])->where('deleted_at', null)->where('requisition_no', $requistion_no)->where('status', 'approved')->first();


        if (empty($data)) {
            return '<div class="alert alert-warning" role="alert">
                  Please Check you Requistion number is approved
                  </div>';
        }

        return view('admin.v1.purchase.get_purchase', compact('page', 'brands', 'stores', 'suppliers', 'products', 'data'));
    }

    public function purches_print($id)
    {
        //return $id;
        $fetch_data = Purchase::with(['details.product', 'store'])->where('id', $id)->first();
        $data = Store::where('id', $fetch_data->to_store)->first();
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
        return view('admin.v1.purchase.purches_print', compact('fetch_data', 'data', 'logo', 'tax'));
    }

    public function purches_pdf($id)
    {
        //return $id;
        $fetch_data = Purchase::with(['details.product', 'store'])->where('id', $id)->first();
        $data = Store::where('id', $fetch_data->to_store)->first();
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
        return view('admin.v1.purchase.purches_pdf', compact('fetch_data', 'data', 'logo', 'tax'));
    }
}
