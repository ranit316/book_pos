<?php

namespace App\Http\Controllers\Admin\v1;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\MasterStockInventery;
use App\Models\Product;
use App\Models\Requisition;
use App\Models\Setting;
use Illuminate\Support\Carbon;
use App\Models\AppInfo;
use App\Models\GstSlab;
use App\Models\SaleDetails;
use App\Models\User;
use App\Models\Store;
use Database\Seeders\MasterStockerSeeder;
use App\Models\Sale;
use App\Models\StorageSite;
use Illuminate\Support\Facades\DB;
use App\Models\Discount;
use App\Models\Publisher;
use App\Models\SalePayament;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use App\Models\CustomerbridgeStore;
use App\Models\Saleprice;
use App\Models\Publisher_Payout;







class MunnualSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $page = 'Sale';
    public function index(Request $request)
    {
        $page = $this->page;
        if ($request->ajax()) {
            if (isAdmin()) {
                $data = Sale::with(['store', 'customer','SalePayament','sale_to_details'])->where('deleted_at', null)->orderByDesc('id')->get();
            }
            if (isCentral()) {
                $data = Sale::with(['store', 'customer','SalePayament','sale_to_details'])->where('store_id', loginStore()->id)->where('deleted_at', null)->orderByDesc('id')->get();
            }
            if (isRetail()) {
                $data = Sale::with(['store', 'customer','SalePayament','sale_to_details'])->where('store_id', loginStore()->id)->where('deleted_at', null)->orderByDesc('id')->get();
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
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.mannual_sale.buttons', ['item' => $row, "route" => 'sale', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->addColumn('download_action', function ($row) {
                    $download_Btn = view('admin.v1.mannual_sale.download_buttons', ['item' => $row, "route" => 'sale', 'page' => $this->page]);
                    return $download_Btn;
                })
                ->rawColumns(['action','download_action'])
                ->make(true);
        }

        return view('admin.v1.mannual_sale.index', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        // if (isAdmin()) {
        // $data['stores'] =  Store::where('deleted_at', null)->get();
        // } else {
        $data['stores'] =  Store::where('deleted_at', null)->where('id', loginStore()->id)->first();
        // }
        if (isCentral()) {
            $data['suppliers'] = User::where('type', 'publisher')
                ->with(['publisher' => function ($query) {
                    $query->where('deleted_at', null);
                }])
                ->first();
            $publisher_id = User::where('id', auth()->user()->id)->first();
            $data['products'] = Product::with(['master_stock_inventory' => function ($query) {
                $query->where('qty', '>', 0)->where('store_id', loginStore()->id);
            }])->where('supplier_id', $publisher_id->parent_id)->get();
        } else {
            $data['suppliers'] = Publisher::get();
        }

        //$data['products'] = Product::where('deleted_at', null)->get();
        // $data['customers'] = Customer::where('deleted_at', null)->where('store_id', loginStore()->id)->get();
        // $data['customers'] = Customer::where('status', 'active')->whereHas('store', function ($query) {
        //     $query->where('id', loginStore()->id)->where('customers.status','active');
        // })->orWhereHas('sales.store', function ($query) {
        //     $query->where('id', loginStore()->id)->where('customers.status','active');
        // })->get();
        $data['customers'] = CustomerbridgeStore::with('customer')->where('store_id', auth()->user()->store_id)->where('status', 'active')->get();
        $data['storage_sites'] = StorageSite::where('deleted_at', null)->where('store_id', loginStore()->id)->where('flag', 'default')->get();


        $data['sale_price']  = MasterStockInventery::where('store_id', loginStore()->id)->where('product_id', $request->products)
            ->get();

        //     $query = MasterStockInventery::where('store_id', loginStore()->id)
        //         ->where('product_id', $request->products);
        //     dd($query->toSql());
        //    $data['sale_price'] = $query->get();


        $data['page'] = $this->page;
        // $page = $this->page;

        return view('admin.v1.mannual_sale.insert', $data);
    }

    public function status($id)
    {
        $status = Sale::find($id);
        if ($status->status == "active") {
            Sale::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            Sale::where('id', $id)->update(['status' => 'active']);
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
        //return $request->all();
        $date = Carbon::now();
        $formatteDate = $date->format('y-m');
        $store_id = User::where('store_id', loginStore()->id)->first();
        $store = sprintf("%04d", $store_id->store_id);
        $sale_no = Sale::latest()->first();
        $sale_id = sprintf("%04s", ($sale_no->id ?? 0) + 1);
        $invoice_no = "INV-" . $store . "-" . $formatteDate . "-" . ($sale_id);
        $pub_name = Publisher::where('store_name', $request->publisher_id)->first();
        $pub_id = User::where('publisher_id', $pub_name->id)->first();
        // return $request->all();
        $validate = Validator::make($request->all(), [
            // 'title' => 'required|string|unique:purchase,title',
        ]);

        //return $request->all();

        // dd($request->all());
        if ($validate->fails()) {
            return $validate->errors();
        } else {
            try {


                $request->merge([
                    'store_id' => loginStore()->id,
                    'created_by' => auth()->user()->id,
                ]);
                DB::beginTransaction();
                //return $request->products;
                $sale_data =  Sale::create([
                    'customer_id' => $request->customer_id,
                    'publisher_id' => $pub_id->id,
                    'store_id' => $request->store_id,
                    'sale_by' => auth()->user()->id,
                    'sale_date' => date('Y-m-d'),
                    'total_tax' => $request->tax_amount,
                    'discount_type' => 'F',
                    'discount' => $request->discount ?? 0,
                    'round_off' => $request->round_off_amount ?? 0,
                    'sub_total' => $request->taxeble_amount,
                    'discount_percentage' => $request->discount_p,



                    'tax_percentage' => $request->tax_percentage_value,


                    'total' => $request->total_amount,
                    'sale_mode' => 'manual',
                    'description' => $request->description,
                    'invoice_no' => $invoice_no,
                    'shipping_charges' => $request->delivery_charge ?? 0,
                    'storage_site_id' => $request->storage_site_id,
                    'status' => $request->mode_status,

                ]);

                if (count($request->products) > 0) {
                    for ($i = 0; $i < count($request->products); $i++) {

                        //return $request->products[$i];

                        SaleDetails::create([
                            'sale_id' => $sale_data->id,
                            'product_id' => $request->products[$i],
                            'price' => $request->price[$i],
                            'qty' => $request->request_qty[$i],
                            'tax_percentage' =>  0,
                            //'taxeble_amount' => $request->array_taxeble_amount[$i],
                            'total_amount' => $request->array_total_amount[$i],
                            //'sale_price' => $request->price[$i],
                        ]);

                        /* $data = [
                            'product_id' => $product->id,
                            'storage_site_id' => $request->storage_site_id,
                            'qty' => $request->request_qty[$i]
                        ];
                        $this->masterStockManage($data); */
                        DB::commit();
                    }
                }

                if ($request->mode_status == 'draft') {
                    return response()->json(['success' => $this->page . " SuccessFully Added "]);
                }
                if ($request->mode_status == 'unpaid') {
                    return $this->getSaleInvoiceData($invoice_no);
                }
            } catch (Exception $e) {
                DB::rollback();
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    /*  public function show($inv_no)
    {

        $page = $this->page;
        $saledata = Sale::with(['store', 'user', 'customer', 'saledetails', 'saledetails.product'])->where('invoice_no', $inv_no)->firstOrFail();
        return view('admin.v1.mannual_sale.view', ['page' => $page, 'saledata' => $saledata]);
    } */

    public function search_cus_invoice($cus_id)
    {

        $page = $this->page;
        $saledata = Sale::where('invoice_no', $cus_id)->firstOrFail();
        if ($saledata) {
            return $this->getSaleInvoiceData($saledata->invoice_no);
        } else {
            return 'false';
        }
        //return view('admin.v1.mannual_sale.view', ['page' => $page, 'saledata' => $saledata]);
    }



    public function pendinginvoice_bycusid($cus_id)
    {

        $page = $this->page;

        $saledata = Sale::where('customer_id', $cus_id)->where('status', 'unpaid')->where('store_id', loginStore()->id);
        if ($saledata->get()->count() > 0) {
            return $this->getSaleInvoiceData($saledata->first()->invoice_no);
        } else {
            return 'false';
        }
        //return view('admin.v1.mannual_sale.view', ['page' => $page, 'saledata' => $saledata]);
    }

    public function search_cus_invoice_dprint($inv_no)
    {
        //return $inv_no;
        $saledata = Sale::with(['store', 'user', 'customer', 'saledetails', 'saledetails.product','salepayament'])->where('invoice_no', $inv_no)->firstOrFail();
        $data = Setting::with('store')->where('store_id', loginStore()->id)->first();
        $addresses = $saledata->customer->address;
        $tax = GstSlab::first();
        $tnc = AppInfo::first();
        $user = User::where('id', auth()->user()->id)->first();
        $discount = Discount::where('coupon_code', $saledata->discount_type)->first();
        $baseURL = request()->root();
        $logo = AppInfo::first();
        if ($logo) {
            $logo->logo = $baseURL . '/' . $logo->logo;
        }
        if ($data->store) {
            $data->store->signature = $baseURL . '/' . $data->store->signature;
        }
        $addressLines = [];
        $stateLine = [];
        foreach ($addresses as $address) {
            $addressLines[] = $address->address . ' ' . $address->city;
            $stateLine[] = $address->state . ',' . $address->pincode;
        }
        if ($saledata->status == 'paid') {
            return view('admin.v1.bill.bill1print_dprint', ['saledata' => $saledata, 'billing_header' => $data, 'addressLines' => $addressLines, 'tax' => $tax, 'tnc' => $tnc, 'user' => $user, 'discount' => $discount, 'logo' => $logo, 'stateLine' => $stateLine]);
        } else {
            return view('admin.v1.bill.bill1_dprint', ['saledata' => $saledata, 'billing_header' => $data, 'addressLines' => $addressLines, 'tax' => $tax, 'tnc' => $tnc, 'user' => $user, 'discount' => $discount, 'logo' => $logo, 'stateLine' => $stateLine]);
        }
    }

    public function download_pdf($inv_no)
    {
        $saledata = Sale::with(['store', 'user', 'customer', 'saledetails', 'saledetails.product'])->where('invoice_no', $inv_no)->firstOrFail();
        $data = Setting::with('store')->where('store_id', loginStore()->id)->first();
        $addresses = $saledata->customer->address;
        $tax = GstSlab::first();
        $tnc = AppInfo::first();
        $user = User::where('id', auth()->user()->id)->first();
        $discount = Discount::where('coupon_code', $saledata->discount_type)->first();
        $baseURL = request()->root();
        $logo = AppInfo::first();
        if ($logo) {
            $logo->logo = $baseURL . '/' . $logo->logo;
        }
        if ($data->store) {
            $data->store->signature = $baseURL . '/' . $data->store->signature;
        }
        $addressLines = [];
        $stateLine = [];
        foreach ($addresses as $address) {
            $addressLines[] = $address->address . ' ' . $address->city;
            $stateLine[] = $address->state . ',' . $address->pincode;
        }
        if ($saledata->status == 'paid') {
            return view('admin.v1.bill.bill1print_downprint', ['saledata' => $saledata, 'billing_header' => $data, 'addressLines' => $addressLines, 'tax' => $tax, 'tnc' => $tnc, 'user' => $user, 'discount' => $discount, 'logo' => $logo, 'stateLine' => $stateLine]);
        } else {
            return view('admin.v1.bill.bill1_downprint', ['saledata' => $saledata, 'billing_header' => $data, 'addressLines' => $addressLines, 'tax' => $tax, 'tnc' => $tnc, 'user' => $user, 'discount' => $discount, 'logo' => $logo, 'stateLine' => $stateLine]);
        }
    }

    public function getSaleInvoiceData($inv_no)
    {
        //return $inv_no;
        $saledata = Sale::with(['store', 'user', 'customer', 'saledetails', 'saledetails.product'])->where('invoice_no', $inv_no)->firstOrFail();
        $data = Setting::with('store')->where('store_id', loginStore()->id)->first();
        $addresses = $saledata->customer->address;
        $tax = GstSlab::first();
        $tnc = AppInfo::first();
        $user = User::where('id', auth()->user()->id)->first();
        $discount = Discount::where('coupon_code', $saledata->discount_type)->first();
        $baseURL = request()->root();
        $logo = AppInfo::first();
        if ($logo) {
            $logo->logo = $baseURL . '/' . $logo->logo;
        }
        if ($data->store) {
            $data->store->signature = $baseURL . '/' . $data->store->signature;
        }
        $addressLines = [];
        $stateLine = [];
        foreach ($addresses as $address) {
            $addressLines[] = $address->address . ' ' . $address->city;
            $stateLine[] = $address->state . ',' . $address->pincode;
        }
        if ($saledata->status == 'paid') {
            return view('admin.v1.bill.bill1print', ['saledata' => $saledata, 'billing_header' => $data, 'addressLines' => $addressLines, 'tax' => $tax, 'tnc' => $tnc, 'user' => $user, 'discount' => $discount, 'logo' => $logo, 'stateLine' => $stateLine]);
        } else {
            return view('admin.v1.bill.bill1', ['saledata' => $saledata, 'billing_header' => $data, 'addressLines' => $addressLines, 'tax' => $tax, 'tnc' => $tnc, 'user' => $user, 'discount' => $discount, 'logo' => $logo, 'stateLine' => $stateLine]);
        }
    }

    public function downloadSalePdf($inv_no)
    {
        //return $request->sale_id;
        // Get all sale details  from the database
        $saledata = Sale::with(['store', 'user', 'customer', 'saledetails', 'saledetails.product'])->where('invoice_no', $inv_no)->firstOrFail();
        // Generate QR image
        $qrCodeData = $saledata->invoice_no;
        if (!is_dir(public_path("qr_codes"))) {
            mkdir(public_path("qr_codes"));
        }
        $qrCodePath =  "qr_codes/$qrCodeData.svg";
        QrCode::size(200)->generate($saledata->total, public_path($qrCodePath));

        // Compress and store QR code image

        // Add QR code data and path to the array
        $qrCodes = [
            'data' => $qrCodeData,
            'path' => base64_encode(file_get_contents($qrCodePath)),
            'amount' => $saledata->total,
        ];
        // End QR Image
        $data = [
            'saledata' =>  $saledata,
            'qrCodes' => $qrCodes,
        ];
        // Store the PDF
        $pdf = Pdf::loadView('admin.v1.bill.bill_pdf_download', $data);
        $deleteFolderPath = public_path('qr_codes');
        $dd = File::cleanDirectory($deleteFolderPath);
        $time = date_create(now());
        $get_date = date_format($time, 'Y-m-d');
        $sl  = $get_date . '-Sale_Details'; // Generate a random code
        return $pdf->download($sl . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    /*  public function edit($id)
    {
        $stores =  Store::where('deleted_at', null)->where('type', 'central-store')->get();
        $brands = Brand::where('deleted_at', null)->get();
        $suppliers = User::where('type', 'publisher')->get();
        $products = Product::where('deleted_at', null)->get();
        $page = $this->page;
        $data = Sale::with('details')->where('deleted_at', null)->where('id', $id)->first();
        return view('admin.v1.requisition.edit', compact('page', 'brands', 'stores', 'suppliers', 'products', 'data'));
    } */
    public function edit($id)
    {
        $data['suppliers'] = User::where('type', 'publisher')->get();
        $data['storage_sites'] = StorageSite::where('deleted_at', null)->where('store_id', loginStore()->id)->get();
        $data['page'] = $this->page;
        //return $data['page'];
        $saledata = Sale::with(['store', 'user', 'supplier', 'customer', 'saledetails', 'saledetails.product'])->where('id', $id)->firstOrFail();
        // return $saledata;
        return view('admin.v1.mannual_sale.edit', ['data' => $data, 'saledata' => $saledata]);
        //
        /*  $stores =  Store::where('deleted_at', null)->where('id', loginStore()->id)->get();
        $brands = Brand::where('deleted_at', null)->get();
        $suppliers = User::where('type', 'publisher')->get();
        $products = Product::where('deleted_at', null)->get();
        return $products;
        $page = $this->page;
        $data = Sale::with('details')->where('deleted_at', null)->where('id', $id)->first();
        return view('admin.v1.mannual_sale.edit', compact('page', 'brands', 'stores', 'suppliers', 'products', 'data'));
         */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function updateSale(Request $request)
    {
        //return $request->products;
        $validate = Validator::make($request->all(), [
            // 'title' => 'required|string|unique:purchase,title',
        ]);

        // dd($request->all());
        if ($validate->fails()) {
            return $validate->errors();
        }
        try {
            $request->merge([
                'updated_by' => auth()->user()->id,
            ]);
            DB::beginTransaction();

            Sale::where('id', $request->saleid)->update([
                'customer_id' => $request->customer_id,
                'publisher_id' => $request->publisher_id,
                'store_id' => $request->store_id,
                'sale_date' => date('Y-m-d'),
                'total_tax' => $request->total_tax,
                'discount_type' => 'F',
                'discount' => $request->discount ?? 0,
                'sub_total' => $request->taxeble_amount,
                'total' => $request->total_amount,
                'sale_mode' => 'manual',
                'description' => $request->description,
                'invoice_no' => $request->invoice_no,
                'shipping_charges' => $request->shipping_charges ?? 0,
                'storage_site_id' => $request->storage_site_id,
                'status' => $request->mode_status,

            ]);

            SaleDetails::where('sale_id', $request->saleid)->delete();
            if (count($request->products) > 0) {
                for ($i = 0; $i < count($request->products); $i++) {
                    $product = Product::where('title', $request->products[$i])->first();
                    //return $request->array_tax_percentage;
                    SaleDetails::create([
                        'sale_id' => $request->saleid,
                        'product_id' => $product->id,
                        'price' => $request->price[$i],
                        'qty' => $request->request_qty[$i],
                        'tax_percentage' =>  $request->array_tax_percentage[$i],
                        //'taxeble_amount' => $request->array_taxeble_amount[$i],
                        'total_amount' => $request->array_total_amount[$i],
                    ]);
                    DB::commit();
                }
            }
            // return response()->json(['success' => $this->page . " SuccessFully Updated "]);
            return $this->getSaleInvoiceData($request->invoice_no);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()]);
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
            Sale::where('id', $id)->update(['deleted_at' => date('Y-m-d h:i:s'), 'deleted_by' => auth()->user()->id]);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page . "Can't Be Delete this May having some child"]);
        }
    }
    public function search(Request $request, $product = null)
    {
        // return $request->publisher_id;
        //$products =  Product::with('gst')->where('deleted_at', null)->where('supplier_id', $request->publisher_id)->where('title', 'like', '%' . $product . '%')->limit(50)->get();
        $products =  Product::with('gst')->where('deleted_at', null)->where('supplier_id', $request->publisher_id)->limit(50)->get();
        //return $products;
        $data = [];
        /* foreach ($products as $p) {
            $master_stock_inventry = MasterStockInventery::where('product_id', $p->id)->where('storage_site_id', $request->storage_site_id)->where('store_id', loginStore()->id)->first();
            if (!empty($master_stock_inventry)) {
?>
                <option value="<?= $p->title ?>"><?= $p->title ?></option>
<?php }
        } */
        foreach ($products as $p) {
            $master_stock_inventry = MasterStockInventery::where('product_id', $p->id)->where('storage_site_id', $request->storage_site_id)->where('store_id', loginStore()->id)->first();
            if (!empty($master_stock_inventry)) {
                $data[] = $p->title;
            }
        }
        return $data;
    }

    function productPrice(Request $request, $product = null)
    {
        $data = Product::where('id', $product)->where('deleted_at', null)->first();
        $master_stock_inventry = MasterStockInventery::where('product_id', $data->id)->where('store_id', loginStore()->id)->first();
        $data->stock = $master_stock_inventry;
        return $data;
    }


    public function productByStorageSite($site_id)
    {
        $master_stock_inventry =  MasterStockInventery::where('storage_site_id', $site_id)->get();
    }

    public function masterStockManage($data)
    {
        $inventry =  MasterStockInventery::where('store_id', auth()->user()->store_id)
            ->where('product_id', $data['product_id'])
            ->where('storage_site_id', $data['storage_site_id'])
            ->where('qty', '>', 0)
            ->first();

        $inventry->update([
            'qty' => $inventry->qty - $data['qty']
        ]);
    }

    //==================By TApas ======================================
    public function discountPrice(Request $request)
    {
        //return $request->all();
        //return $request->all();
        $taxebleAmount = $this->calculateTaxebleAmount($request->products, $request->price, $request->request_qty);
        //return  $taxebleAmount;
        $disamount = 0.00;
        // $discount = Discount::whereRaw('CAST(`min` AS UNSIGNED) <= ?', [$taxebleAmount])
        //    ->orderBy('min', 'desc')
        //   ->first();
        $data7 = Discount::whereRaw('CAST(`min` AS UNSIGNED) <= ?', [$taxebleAmount])
            ->orderBy('min', 'desc');
        //return  $discount;
        if ($data7->get()->count() == 0) {
            return $data7->first();
        } else {
            $discountqr = $data7->first();
            $disamount = ($taxebleAmount * $discountqr->discount) / 100;
            //return $disamount;
            //return $disamount;
            $data = $data7->first();
            return view('admin.v1.mannual_sale.coupon', compact('data', 'disamount'));
        }
    }

    protected function calculateTaxebleAmount($products, $prices, $quantities)
    {
        // Implement your calculation logic here
        $taxebleAmount = 0;

        // Example: Sum of product prices * quantities
        foreach ($products as $key => $product) {
            $taxebleAmount += $prices[$key] * $quantities[$key];
        }

        return $taxebleAmount;
    }

    public function payout_pending(Request $request)
    {
        if ((auth()->user()->role_id != 3) && (auth()->user()->type == 'central-store')) {
            abort(404);
        }

        $page = $this->page;
        if ($request->ajax()) {
            if (isPublisher()) {
                // $data = Sale::where('publisher_id', auth()->user()->id)->with(['customer', 'supplier', 'salepayament', 'publisher_payout' => function ($query) {
                //     $query->where('status', 'pending');
                // }])->get();

                $data = Publisher_Payout::where('publisher_id', auth()->user()->publisher_id)->with('sale.customer', 'sale.salepayament', 'publisher')->where('status', 'pending')->get();

            }
            
            if (isCentral() || isRetail()) {
                //$data =Sale::with(['customer', 'supplier', 'salepayament', 'publisher_payout' => function ($query) {
                // $query->where('status', 'pending');
                // }])->get();
                $data = Publisher_Payout::with('sale.customer', 'sale.salepayament', 'publisher')->where('user_id', auth()->user()->id)->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                  
                    if ($row->status == 'success') {
                        $status = "<span class='badge bg-success'>SUCCESS</span>";
                    } else if ($row->status == 'failed') {
                        $status = "<span class='badge bg-danger'>FAILED</span>";
                    }
                    $status = "<span class='badge bg-warning'>PENDING</span>";

                    return $status;
                })
                ->addColumn('action_pdf', function ($row) {
                    $downloadBtn = view('admin.v1.mannual_sale.pdf_button', ['item' => $row, "route" => 'sale', 'page' => $this->page]);
                    return $downloadBtn;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.mannual_sale.payout_button', ['item' => $row, "route" => 'sale', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status','action_pdf'])
                ->make(true);
        }
        return view('admin.v1.mannual_sale.payout_pending', compact('page'));
    }

    public function sale_view($id)
    {
        $page = $this->page;
        $data = Publisher_Payout::with('sale.customer')->where('id',$id)->first();
       // return $data;
        return view ('admin.v1.mannual_sale.sale_view', compact('data','page'));
    }

    public function payout_pdf($id)
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

    public function payout_print($id)
    {
        //$fetch_data = Publisher_Payout::with(['details.product','store'])->where('id',$id)->first();
        $data = Publisher_Payout::with('sale.customer')->where('id',$id)->first();
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
        return view('admin.v1.mannual_sale.payout_print',compact('data','logo','tax'));
    }

    public function newbook($pub_id)
    {
        //return $pub_id;

        // $publisher = Publisher::where('store_name', $pub_id)->first();
        // $books = User::where('publisher_id', $publisher->id)->first();
        // $data = Product::where('supplier_id', $books->id)->get();
        $publisher_id = User::where('id', auth()->user()->id)->first();
        $data = Product::with(['master_stock_inventory' => function ($query) {
            $query->where('qty', '>', 0);
        }])->where('supplier_id', $publisher_id->parent_id)->get();

        return $data;
    }


    public function show_publisher_transaction()
    {
        $id = auth()->user()->id;
        $show_tranc = Publisher::where('id', $id)->with('sale')->get();
    }
}
