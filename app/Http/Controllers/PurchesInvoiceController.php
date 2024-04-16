<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pniv;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Dispatch;
use App\Models\GrnDetail;
use App\Models\Product;
use App\Models\RequisitionDetails;
use App\Models\User;
use App\Models\Store;
use App\Models\MasterStockInventery;
use Database\Seeders\MasterStockerSeeder;
use App\Models\Purchase;
use App\Models\AppInfo;
use App\Models\GstSlab;
use App\Models\Requisition;
use App\Models\Grn;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Mail\grn_create_mail;
use App\Models\Pniv_details;
use App\Models\Publisher;

class PurchesInvoiceController extends Controller
{
    public $page = 'Purches Invoice';
    public function index(request $request)
    {


        $page =  $this->page;
        if ($request->ajax()) {

            $data = Pniv::with(['store', 'supplier'])->where('deleted_at', null)->orderByDesc('id')->get();


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.purches_invoice.buttons', ['item' => $row, "route" => 'purches', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.v1.purches_invoice.index', compact('page'));
    }
    public function create(Request $request)
    {
        $date = Carbon::now();
        $formatteDate = $date->format('y-m');
        $data['stores'] =  Store::with('publisher')->where('deleted_at', null)->where('type', 'retail-store')->get();
        $data['brands'] = Brand::where('deleted_at', null)->get();
        $data['suppliers'] = User::where('type', 'publisher')->get();
        $data['products'] = Product::where('deleted_at', null)->get();
        $data['page'] = $this->page;
        $data['products'] = Product::where('deleted_at', null)->get();
        $data['grn'] = Grn::where('deleted_at', null)->where('store_id', loginStore()->id)->orderByDesc('id')->get();
        $data['page'] = $this->page;
        $store_id = User::where('store_id', loginStore()->id)->first();
        $grnObject = Pniv::latest()->first();
        $grnObject_id = sprintf("%04s", ($grnObject->id ?? 0) + 1);
        $store = sprintf("%04d", $store_id->store_id);
        $grnObject_no = "GRN-" . $store . "-" . $formatteDate . "-" . ($grnObject_id);
        $data['grn_no'] =  $grnObject_no;

        return view('admin.v1.purches_invoice.insert', $data);
    }
    public function get_purchase($grn_no = null)
    {

        if (empty($grn_no)) {
            return '<div class="alert alert-danger" role="alert">
                      Please Enter the Grn order number 
           </div>';
        }
        $data['data'] = Grn::with(['grn_details', 'store', 'supplier', 'store2'])->where('deleted_at', null)->where('grn_no', $grn_no)->first();
        $data['brands'] = Brand::where('deleted_at', null)->get();
        $data['products'] = Product::where('deleted_at', null)->get();
        $data['publisher'] = Publisher::where('id', $data['data']->store2->publisher_id)->first();
        $data['page'] = $this->page;
        if (empty($data['data'])) {
            return '<div class="alert alert-warning" role="alert">
                  Please Check you Grn order number 
                  </div>';
        }
        //return $data;
        return view('admin.v1.purches_invoice.get_purches', $data);
    }
    public function purchase_print($id)
    {
        //return $id;
        $fetch_data = Pniv::with(['grn_details.product', 'store'])->where('id', $id)->first();
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
        //return [$data, $fetch_data];
        return view('admin.v1.purches_invoice.print', compact('fetch_data', 'data', 'logo', 'tax'));
    }

    public function purchase_pdf($id)
    {
        //return $id;
        $fetch_data = Pniv::with(['grn_details.product', 'store'])->where('id', $id)->first();
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
        //return [$data, $fetch_data];
        return view('admin.v1.purches_invoice.pdf', compact('fetch_data', 'data', 'logo', 'tax'));
    }


    public function store(Request $request)
    {
        //return response()->json(['data' => $request->all()]);



        $date = Carbon::now();
        $formatteDate = $date->format('y-m');
        $po = Pniv::latest()->first();
        $store_id = User::where('store_id', loginStore()->id)->first();
        $po_id = sprintf("%04s", ($po->id ?? 0) + 1);
        $store = sprintf("%04d", $store_id->store_id);
        $pniv_no = "PINV-" . $store . "-" . $formatteDate . "-" . ($po_id);


        $validate = Validator::make($request->all(), [
            //'po_no' => 'required|string|unique:purchases,po_no',
            'grn_no' => 'required|string|unique:pnivs,grn_no',

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
                //'to_store' => $to_store,
                'supplier_id' => $request->to_store
            ]);
        }
        if ($validate->fails()) {
            return $validate->errors();
        } else {

            try {
                $request->merge([
                    //'store_id' => loginStore()->id,
                    'created_by' => auth()->user()->id,
                    //'dispatch_by' => auth()->user()->id,
                    'round_off_amount' => $request->round_off_amount,
                    'paid_amount' => $request->total_amount,
                    //'po_no' => $po_no
                    'pniv_no' => $pniv_no,
                    'status' => "unpaid",

                ]);
                DB::beginTransaction();
                $grn_data = Grn::where('grn_no', $request->grn_no)->first();
                GRN::where('grn_no', $request->grn_no)->update([
                    'status' => 'PINV Generated'
                ]);
                $data =  Pniv::create($request->except(['_token', 'products', 'request_qty', 'mrp_price', 'purchase_price', 'sale_price', 'batch_no', 'array_gst', 'array_cgst', 'array_igst', 'array_sgst', 'array_taxeble_amount', 'array_total_amount', 'description']));

                if (isset($request->products) && count($request->products) > 0) {
                    for ($i = 0; $i < count($request->products); $i++) {
                        Pniv_details::create([
                            'grn_id' => $grn_data->id,
                            'pniv_id' => $data->id,
                            'purchase_id' => $data->id,
                            'product_id' => $request->products[$i],
                            // 'storage_site_id' => 1,
                            // 'storage_location_id' => 1,
                            // 'rack_id' => 1,
                            'price' => $request->price[$i],
                            'request_qty' => $request->request_qty[$i],
                            //'dispatch_qty' => $request->request_qty[$i],
                            //'tax_amount' => $request->array_tax_amount[$i],
                            //'taxeble_amount' => $request->array_taxeble_amount[$i],
                            'total_amount' => $request->array_total_amount[$i],
                            //'purchase_price' => $request->purchase_price[$i],
                            // 'sale_price' => $request->sale_price[$i],
                            // 'batch_no' => $request->batch_no[$i],
                            // 'cgst' => $request->array_cgst[$i] ?? 0,
                            // 'sgst' => $request->array_sgst[$i] ?? 0,
                            // 'igst' => $request->array_igst[$i] ?? 0,
                            'updated_at' => date('Y-m-d h:i:s')
                        ]);
                    }
                }
                DB::commit();
                $sale_inv = Pniv::with('details.product','store','store2')->where('id', $data->id)->first();
                $baseURL = request()->root();
                $logo = AppInfo::first();
                if ($logo) {
                    $logo->logo = $baseURL . '/' . $logo->logo;
                }
                return view('admin.v1.bill.purchase_inv', compact('sale_inv','logo'));
                //return response()->json(['success' => $this->page . " SuccessFully Added "]);
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }
}
