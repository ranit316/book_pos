<?php

namespace App\Http\Controllers\Admin\v1;

use App\Events\SendSmsEvent;
use Exception;
use Throwable;
use Svg\Tag\Rect;
use App\Models\Cart;
use App\Models\Sale;
use App\Models\User;
use App\Models\Store;
use App\Models\Address;
use App\Models\AppInfo;
use App\Models\GstSlab;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Customer;
use App\Events\CustomerCreate;
use App\Models\Discount;
use App\Events\GeneralSms;
use App\Models\Publisher;
use App\Mail\CustomerMail;

use App\Models\SaleDetails;
use App\Models\StorageSite;
use App\Models\Notification;
use App\Models\SalePayament;
use Illuminate\Http\Request;
use App\Mail\NotificationMail;
use Illuminate\Support\Carbon;
use App\Models\Publisher_Payout;
use App\Mail\CustomerPayamentMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\CustomerbridgeStore;
use App\Models\MasterStockInventery;


use Illuminate\Support\Facades\Mail;
use App\Mail\LowstockMail;
use App\Mail\CustomeraddMail;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\PDF;

class PosController extends Controller
{
    public $maildata;
    public $page = 'pos';
    public $page2 = 'Transaction';
    public function tax($carts)
    {
        $totaltax = 0.00;
        foreach ($carts as $cart) {
            $itemtax = ($cart->price * $cart->qty) * 0.18;
            $totaltax += $itemtax;
        }
    }
    public function index(Request $request)
    {
        if (isCentral()) {
            $books = MasterStockInventery::with('product')->where('store_id', loginStore()->id)->get();
        } else {
            $books = [];
        }
        //$books = Product::where('deleted_at', null)->paginate(12);;
        $user = User::where('id', auth()->user()->id)->first();
        $stores = Store::where('deleted_at', null)->get();
        $category = Category::where('deleted_at', null)->orderBy('name', 'asc')->get();
        // $publishers = User::where('type', 'publisher')->get();
        $data = User::where('store_id', loginStore()->id)->first();
        if (isCentral()) {
            $publishers = User::where('id', $data->parent_id)
                ->with(['publisher' => function ($query) {
                    $query->where('deleted_at', null);
                }])
                ->get();
        } else {
            $publishers = User::where('type', 'publisher')
                ->with(['publisher' => function ($query) {
                    $query->where('deleted_at', null);
                }])
                ->get();
        }

        //$customers = Customer::where('deleted_at', null)->get();
        // $customers =  Customer::whereHas('store', function ($query) {
        //     $query->where('id', loginStore()->id)->where('customers.status','active');
        // })->orWhereHas('sales.store', function ($query) {
        //     $query->where('id', loginStore()->id)->where('customers.status','active');
        // })->get();
        $customers = CustomerbridgeStore::with('customer')->where('store_id', auth()->user()->store_id)->where('status', 'active')->get();
        $storage_sites = StorageSite::where('deleted_at', null)->where('store_id', loginStore()->id)->get();




        return view('admin.v1.pos.index', compact('user', 'books', 'stores', 'category', 'publishers', 'customers', 'storage_sites'));
    }
    public function add_cart(Request $request, $product_id)
    {
        // // print_r($id);
        // $detail = Product::where('id', $id)->get();
        $data = Product::with('gst')->where('id', $product_id)->first();
        $entity = Cart::where('customer_id', $request->customer_id)->where('product_id', $product_id)->first();
        if ($entity) {
            $qty = $entity->qty;
            $entity->update([
                'qty' => $qty + 1,
            ]);
        } else {
            Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $product_id,
                'customer_id' => $request->customer_id,
                'price' => $data->price,
                'qty' => 1,
                'discount' => 0,
                'tax' => 0,
                'created_by' => auth()->user()->id
            ]);
        }
        $carts = Cart::where('deleted_at', null)->where('user_id', auth()->user()->id)->where('customer_id', $request->customer_id)->where('status', 'active')->get();
        $qty = 0;
        $prices = 0.00;
        foreach ($carts as $cart) {
            $price = ($cart->price * $cart->qty);
            $prices = $prices + $price;
            $qty = $qty + $cart->qty;
        }
        $disamount = 0.00;
        $discount = Discount::where('min', '<=', $prices)->get();
        $tax = GstSlab::first();
        $taxPercentage = (float) rtrim($tax->tax, '%');
        $tax_amount = $prices * ($taxPercentage / 100);

        return view('admin.v1.pos.cart', ['carts' => $carts, 'discount' => $discount, 'prices' => $prices, 'disamount' => $disamount, 'tax' => $tax, 'tax_amount' => $tax_amount, 'qty' => $qty]);
    }

    public function update_cart_qty(Request $request, $cart_id_qty)
    {
        // $detail = Product::where('id', $id)->get();
        $cq = explode('-', $cart_id_qty);
        // return $cq;
        $cart =  Cart::find($cq[0]);
        $customer_id = $cart->customer_id;
        $cart_data = Cart::where('id', $cq[0])->first();
        if ($cart_data) {
            $cart_data->update([
                'qty' =>  $cq[1],
            ]);
        }
        $carts = Cart::where('deleted_at', null)->where('user_id', auth()->user()->id)->where('customer_id', $customer_id)->where('status', 'active')->get();
        $qty = 0;
        $prices = 0.00;
        foreach ($carts as $cart) {
            $price = ($cart->price * $cart->qty);
            $prices = $prices + $price;
            $qty = $qty + $cart->qty;
        }
        $disamount = 0.00;
        $discount = Discount::where('min', '<=', $prices)->get();
        $tax = GstSlab::first();
        $taxPercentage = (float) rtrim($tax->tax, '%');
        $tax_amount = $prices * ($taxPercentage / 100);
        return view('admin.v1.pos.cart', ['carts' => $carts, 'discount' => $discount, 'prices' => $prices, 'disamount' => $disamount, 'tax' => $tax, 'tax_amount' => $tax_amount, 'qty' => $qty]);
    }

    /* public function search(Request $request)
    {
        $id = auth()->user()->store_id;
        $books = Product::with(['master_stock_inventory' => function ($query) use ($id, $request) {
            $query->where('store_id', $id)->where('storage_site_id', $request->storage_site_id);
        }])->where('deleted_at', null)
            ->when($request->supplier_id, function ($query) use ($request) {
                return $query->where('supplier_id', $request->supplier_id);
            })
            ->when($request->category_id, function ($query) use ($request) {
                return $query->where('category_id', $request->category_id);
            })
            ->paginate(12);
                       
           // return $books;
        return view('admin.v1.pos.book_list', compact('books'));
    } */
    public function search(Request $request)
    {
        $id = auth()->user()->store_id;
        $customer_id = $request->customer_id;

        if ($customer_id > 0) {
            Cart::where(['user_id' => auth()->user()->id, 'customer_id' => $customer_id])->delete();
        }

        // $books = Product::with(['master_stock_inventory' => function ($query) use ($id, $request) {
        //     $query->where('store_id', $id)->where('storage_site_id', $request->storage_site_id);
        // }])->where('deleted_at', null)
        //     ->where('supplier_id', $request->publisher_id)
        //     ->when($request->category_id, function ($query) use ($request) {
        //         return $query->where('category_id', $request->category_id);
        //     })
        //     ->paginate(12);
        $catId = $request->cat_id ?? null;
        $books = MasterStockInventery::whereHas('product', function ($query) use ($request, $catId) {
            $query->where('supplier_id', $request->publisher);
            if ($catId) {
                $query->where('category_id', $catId);
            }
        })
            ->where('store_id', $id)
            ->where('storage_site_id', $request->storage_id)
            ->with('product') // Optionally eager load the product relationship for each result
            ->paginate(12);

        //return $books;
        return view('admin.v1.pos.book_list', compact('books'));
    }

    public function categorysearch(Request $request)
    {
        $id = auth()->user()->store_id;
        $books = MasterStockInventery::whereHas('product', function ($query) use ($request) {
            $query->where('supplier_id', $request->publisher)->where('category_id', $request->cat_id);
        })
            ->where('store_id', $id)
            ->where('storage_site_id', $request->storage_id)
            ->with('product') // Optionally eager load the product relationship for each result
            ->paginate(12);

        //return $books;
        return view('admin.v1.pos.book_list', compact('books'));
    }

    public function delete_cart($id)
    {
        $cart =  Cart::find($id);
        $customer_id = $cart->customer_id;
        $cart->delete($id);
        $carts = Cart::where('deleted_at', null)->where('user_id', auth()->user()->id)->where('customer_id', $customer_id)->where('status', 'active')->get();
        $qty = 0;
        $prices = 0.00;
        foreach ($carts as $cart) {
            $price = ($cart->price * $cart->qty);
            $prices = $prices + $price;
            $qty = $qty + $cart->qty;
        }
        $disamount = 0.00;
        $discount = Discount::where('min', '<=', $prices)->get();
        $tax = GstSlab::first();
        $taxPercentage = (float) rtrim($tax->tax, '%');
        $tax_amount = $prices * ($taxPercentage / 100);
        return view('admin.v1.pos.cart', ['carts' => $carts, 'discount' => $discount, 'prices' => $prices, 'disamount' => $disamount, 'tax' => $tax, 'tax_amount' => $tax_amount, 'qty' => $qty]);
    }

    public function get_customer($customer_id)
    {
        $carts = Cart::where('deleted_at', null)->where('user_id', auth()->user()->id)->where('customer_id', $customer_id)->where('status', 'active')->get();
        $qty = 0;
        $prices = 0.00;
        foreach ($carts as $cart) {
            $price = ($cart->price * $cart->qty);
            $prices = $prices + $price;
            $qty = $qty + $cart->qty;
        }
        $disamount = 0.00;

        $discount = Discount::where('min', '<=', $prices)->get();
        $tax = GstSlab::first();
        $taxPercentage = (float) rtrim($tax->tax, '%');
        $tax_amount = $prices * ($taxPercentage / 100);
        return view('admin.v1.pos.cart', ['carts' => $carts, 'discount' => $discount, 'prices' => $prices, 'disamount' => $disamount, 'tax' => $tax, 'tax_amount' => $tax_amount, 'qty' => $qty]);
    }

    public function add_customer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            //'phone' => 'required|numeric|digits:10|unique:customers,phone',
            //'gender' => 'required',
            //'address' => 'required',
            //'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'district_id' => 'required',


        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            if (empty($request->gender)) {
                return response()->json(['error' =>  " The Gender is reqiuired feild"]);
            }
            $cus_details = Customer::where('phone', $request->phone)->where('status', 'active')->first();
            if ($cus_details != null) {
                $cus_bridge = new CustomerbridgeStore();
                $cus_bridge->store_id = auth()->user()->store_id;
                $cus_bridge->customer_id = $cus_details->id;
                $cus_bridge->status = "active";
                $cus_bridge->save();
                return response()->json(['success' =>  " Successfully Added", 'id' => $cus_bridge->customer_id]);
            } else {
                $id = auth()->user()->id;
                $name = $request->first_name . ' ' . $request->last_name;

                $customer = Customer::create([
                    'name' => $name,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'company_name' => $request->company_name,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'dob' => $request->dob,
                    'created_by' => $id,
                    'store_id' => auth()->user()->store_id,
                ]);

                if ($customer) {
                    $data = Address::create([
                        'customer_id' => $customer->id,
                        'city' => $request->city ?? '',
                        'state' => $request->state,
                        'country' => $request->country,
                        'pincode' => $request->pincode,
                        'address' => $request->address ?? '',
                        'district' => $request->district_id,
                        'created_by' => $id,
                    ]);
                    if ($data) {
                        $data1 = CustomerbridgeStore::create([
                            'store_id' => auth()->user()->store_id,
                            'customer_id' => $customer->id,
                            'status' => 'active',
                        ]);
                    }

                    if ($data1) {
                        event(new CustomerCreate($request->phone));
                        if($customer->email !== null){
                            $this->customer_add($customer->email , $customer->id);
                        }
                        
                        return response()->json(['success' =>  " Successfully Added", 'id' => $customer->id]);
                    }
                    return response()->json(['success' =>  " Successfully Added", 'id' => $customer->id]);
                } else {
                    return response()->json(['error' => 'Failed to add customer', 'id' => $customer->id]);
                }
            }
        }
    }

    public function discount(Request $request, $id)
    {
        $data = Discount::where('id', $id)->first();
        $carts = Cart::where('deleted_at', null)->where('user_id', auth()->user()->id)->where('customer_id', $request->customer_id)->where('status', 'active')->get();
        $qty = 0;
        $prices = 0.00;
        foreach ($carts as $cart) {
            $price = ($cart->price * $cart->qty);
            $prices = $prices + $price;
            $qty = $qty + $cart->qty;
        }
        $disamount = ($prices * $data->discount) / 100;
        $discount = Discount::where('min', '<=', $prices)->get();
        $tax = GstSlab::first();
        $taxPercentage = (float) rtrim($tax->tax, '%');
        $tax_amount = ($prices - $disamount) * ($taxPercentage / 100);

        return view('admin.v1.pos.cart', ['carts' => $carts, 'discount' => $discount, 'prices' => $prices, 'disamount' => $disamount, 'data' => $data, 'tax' => $tax, 'tax_amount' => $tax_amount, 'qty' => $qty]);
    }

    public function books(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $data = Product::where('title', 'LIKE', '%' . $request->search . "%")->get();
            if ($data) {
                foreach ($data as $key => $book) {
                    $output .= '<tr>' .
                        '<td>' . $book->id . '</td>' .
                        '<td>' . $book->title . '</td>' .
                        '<tr>';
                }
                return Response($output);
            }
        }
    }

    public function pos_sale_store(Request $request)
    {
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
                $date = Carbon::now();
                $formatteDate = $date->format('y-m');
                $store_id = User::where('store_id', loginStore()->id)->first();
                $store = sprintf("%04d", $store_id->store_id);
                $sale_no = Sale::latest()->first();
                $sale_id = sprintf("%04s", ($sale_no->id ?? 0) + 1);
                $invoice_no = "INV-" . $store . "-" . $formatteDate . "-" . ($sale_id);
                $request->merge([
                    'store_id' => loginStore()->id,
                    'created_by' => auth()->user()->id,
                    'invoice_no' => $invoice_no,
                ]);
                $publisher = User::where('id', $request->publisher_id)->first();
                DB::beginTransaction();
                //return $request;
                $sale_data1 =  Sale::create([
                    'customer_id' => $request->customer_id,
                    'publisher_id' => $request->publisher_id,
                    'store_id' => auth()->user()->store_id,
                    'sale_by' => auth()->user()->id,
                    'sale_date' => date('Y-m-d'),
                    'total_tax' => $request->tax_amount,
                    'discount_type' => $request->discount_p,
                    'discount_percentage' => $request->discount_p,
                    'tax_percentage' => $request->tax_percentage_value,
                    'discount' => $request->discount_value ?? 0,
                    'sub_total' => $request->taxeble_amount,
                    'total' => $request->total_amount,
                    'sale_mode' => 'pos',
                    'round_off' => $request->round_off ?? 0,
                    //'description' => $request->description,
                    'description' => $request->description ?? '',
                    'invoice_no' => $invoice_no,
                    'shipping_charges' => 0,
                    'storage_site_id' => $request->storage_site_id,
                    // 'trancaction_no' => rand(1111111,88888888),
                    //'status' => $request->mode_status,

                ]);
                if ($sale_data1) {
                    $notification = Notification::create([
                        'publisher_id' => $publisher->publisher_id,
                        'message' => "Customer order has been Successfully Placed",
                        'date_time' => Carbon::now(),
                        'is_read' => "unread",
                        'user_id' =>  auth()->user()->id,
                    ]);
                }
                $customer = Customer::where('id', $request->customer_id)->first();
                if ($customer->email !== '') {
                    $this->customerorder($customer->email, $sale_data1->id);
                }

                $carts = Cart::where('deleted_at', null)->where('user_id', auth()->user()->id)->where('customer_id', $request->customer_id)->where('status', 'active')->get();


                if (count($carts) > 0) {
                    for ($i = 0; $i < count($carts); $i++) {
                        $sale_data = SaleDetails::create([
                            'sale_id' => $sale_data1->id,
                            'product_id' => $carts[$i]->product_id,
                            'price' => $carts[$i]->price,
                            'qty' => $carts[$i]->qty,
                            'tax_percentage' =>   0,
                            //'taxeble_amount' => $request->array_taxeble_amount[$i],
                            'total_amount' => $carts[$i]->price * $carts[$i]->qty,
                        ]);

                        /* $data = [
                            'product_id' => $product->id,
                            'storage_site_id' => $request->storage_site_id,
                            'qty' => $request->request_qty[$i]
                        ];
                        $this->masterStockManage($data); */
                        DB::commit();
                    }
                    // Cart::where('deleted_at', null)->where('user_id', auth()->user()->id)->where('customer_id', $request->customer_id)->update([
                    //     'status' => 'inactive',
                    // ]);
                    if ($sale_data) {
                        Cart::where('deleted_at', null)
                            ->where('user_id', auth()->user()->id)
                            ->where('customer_id', $request->customer_id)
                            ->delete();
                    }
                }
                return $this->getSaleInvoiceData($request->invoice_no);
                //return response()->json(['success' => $this->page . " SuccessFully Added "]);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function show($inv_no)
    {

        $page = $this->page;
        $saledata = Sale::with(['store', 'user', 'customer', 'saledetails', 'saledetails.product'])->where('invoice_no', $inv_no)->firstOrFail();
        return view('admin.v1.mannual_sale.view', ['page' => $page, 'saledata' => $saledata]);
    }


    public function coupon($total)
    {
        $total = $total;

        $data = Discount::whereRaw('CAST(`min` AS UNSIGNED) <= ?', [$total])
            ->orderBy('min', 'desc')
            ->first();

        return view('admin.v1.pos.coupan', compact('data'));
    }

    public function getSaleInvoiceData($inv_no)
    {
        //return $inv_no;
        $data = Setting::with('store')->where('store_id', loginStore()->id)->first();
        $saledata = Sale::with(['store', 'user', 'customer.address', 'saledetails', 'supplier', 'saledetails.product', 'salepayament'])->where('invoice_no', $inv_no)->firstOrFail();
        // return $saledata->saledetails[0];
        $addresses = $saledata->customer->address;
        session(['sale_id' => $saledata->id]);
        session(['user_id' => auth()->user()->id]);
        session(['inv_no' => $inv_no]);
        $publisher_id = $saledata->supplier->publisher_id;
        $publisher = Publisher::where('id', $publisher_id)->first();
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
        return view('admin.v1.bill.bill1', ['saledata' => $saledata, 'billing_header' => $data, 'addressLines' => $addressLines, 'tax' => $tax, 'tnc' => $tnc, 'user' => $user, 'discount' => $discount, 'logo' => $logo, 'stateLine' => $stateLine, 'supplier' => $publisher]);
    }

    public function getSaleInvoiceDataprint($inv_no)
    {
        //return $inv_no;
        $data = Setting::with('store')->where('store_id', loginStore()->id)->first();
        $saledata = Sale::with(['store', 'user', 'customer.address', 'saledetails', 'saledetails.product','salepayament'])->where('invoice_no', $inv_no)->firstOrFail();
        // return $saledata->saledetails[0];
        $addresses = $saledata->customer->address;
        session(['sale_id' => $saledata->id]);
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
        return view('admin.v1.bill.bill1print', ['saledata' => $saledata, 'billing_header' => $data, 'addressLines' => $addressLines, 'tax' => $tax, 'tnc' => $tnc, 'user' => $user, 'discount' => $discount, 'logo' => $logo, 'stateLine' => $stateLine]);
    }

    public function payment(Request $request)
    {
        if ((auth()->user()->role_id != 3) && (auth()->user()->type == 'central-store')) {
            abort(404);
        }
        $page = $this->page;
        $page2 = $this->page2;
        if ($request->ajax()) {
            // $data = Sale::with('customer', 'supplier', 'salepayament')->where('sale_by', auth()->user()->id)->where('status','paid')->latest()->get();
            $data = SalePayament::with('customername.customer', 'customername.supplier.publisher')->where('user_id', auth()->user()->id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $status = "<span class='badge bg-warning'>PENDING</span>";
                    if ($row->status == 'success') {
                        $status = "<span class='badge bg-success'>SUCCESS</span>";
                    } else if ($row->status == 'failed') {
                        $status = "<span class='badge bg-danger'>FAILED</span>";
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.pos.buttoncustomerview', ['item' => $row, "route" => 'pos', 'page' => $this->page, 'page2' => $this->page2]);
                    return $actionBtn;
                })
                ->addColumn('pdf_action', function ($row) {
                    $downloadBtn = view('admin.v1.pos.buttoncustomerdownload', ['item' => $row, "route" => 'pos', 'page' => $this->page, 'page2' => $this->page2]);
                    return $downloadBtn;
                })
                ->rawColumns(['action', 'status', 'pdf_action'])
                ->make(true);
        }
        // $data = Sale::with('customer', 'supplier')->where('sale_by', auth()->user()->id)->get();
        return view('admin.v1.pos.customerpayment', compact('page', 'page2'));
    }

    public function cashpayment(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'payament_mode' => 'required',
        ]);

        if ($validate->fails()) {
            return $validate->errors();
        } else {
            // if($request->payament_mode == "Cash")
            // {
            //     $pstatus = "success";
            // }else{
            //     $pstatus = "";
            // }
            $pstatus = "success";
            $data1 = Sale::where('invoice_no', $request->invoice_no)->first();
            if ($pstatus == "success") {
                $data = Sale::with('customer')->where('invoice_no', $request->invoice_no)->first();
                $data->update([
                    'status' => 'paid',
                    'trancaction_no' => $request->voucher_no,
                ]);
                
                $pub_id = User::where('id', $data->publisher_id)->first();
                $pub_user_payout = User::where('id', $data->publisher_id)->first();
                $payment = SalePayament::create([
                    'sale_id' => $data->id,
                    'amount' => $request->cash_amount,
                    'status' => 'success',
                    'user_id' => auth()->user()->id,
                    'payament_mode' => 'offline',
                    'payaments_type' => 'cash',
                    'trancaction_no' => $request->voucher_no,
                ]);

                if ($payment->status == 'success') {
                    $publisher_payout = Publisher_Payout::create([
                        'sale_id' => $data->id,
                        'status' => 'pending',
                        'amount' => $request->cash_amount,
                        'publisher_id' => $pub_id->publisher_id,
                        'user_id' => auth()->user()->id,
                        'payament_mode' => 'offline'
                    ]);

                    if ($publisher_payout) {
                        $sale_details = SaleDetails::where('sale_id', $data->id)->get();


                        foreach ($sale_details as $masterdata) {
                            $saledetails = [
                                'product_id' => $masterdata->product_id,
                                'store_id' => $data->store_id,
                                'qty' => $masterdata->qty,
                            ];
                            $this->masterStockManage($saledetails);
                        }
                    }
                }
            } else {
                $payment = SalePayament::create([
                    'sale_id' => $data1->id,
                    'amount' => $request->cash_amount,
                    'status' => 'cancel',
                    'user_id' => auth()->user()->id,
                    'payament_mode' => 'Debit Card',
                    'payaments_type' => 'central-store'
                ]);
            }

            if (isset($publisher_payout) && $publisher_payout != "") {
                $rand = mt_rand(1111, 9999);
                $stor_name = Store::where('id', $data->store_id)->first();
                $amount = $request->cash_amount;
                $notification = Notification::create([
                    'publisher_id' => $pub_id->publisher_id,
                    'message' => "Your payment of $amount for Order ID: " . $data1->invoice_no . " at I&CA Book Store - $stor_name->store_name is successful. Thank you! - I&CA Dept, Govt of West Bengal",
                    'date_time' => Carbon::now(),
                    'is_read' => "unread",
                    'user_id' =>  auth()->user()->id,
                ]);
                $customer = Customer::where('id', $data->customer_id)->first();
                // $pdf = PDF::loadHtml('admin.v1.customerpayment',$maildata);
                if ($customer->email !== '') {
                    $this->customerpayament($customer->email, $publisher_payout->id);
                }

                $send_msg = [
                    'message' => 'success',
                    'sale_id' => $data1->id,
                ];


                $pub_data = event(new SendSmsEvent($send_msg));
                //return $pub_data;
                // return response()->json(['status'=> 'Ok', 'payment' =>$payment,'data' => $data]);
                return view('admin.v1.bill.payamentinfo', compact('payment', 'data'));
                //     $html = '<table class="table mb-0">

                //     <tbody>


                //         <tr>

                //             <td>Status</td>
                //             <td>' . $payment->status . '</td>

                //         </tr>
                //         <tr>

                //         <td>Amount</td>
                //         <td>₹' . $payment->amount . '</td>

                //     </tr>
                // <tr>

                // <td>Transaction No</td>
                // <td>' . $payment->trancaction_no . '</td>

                // </tr>

                // <tr>

                // <td>Generated Time </td>
                // <td>' . $payment->created_at . '</td>

                // </tr>

                //     </tbody>
                // </table>';
                //     return $html;
            }
        }
    }
    public function masterStockManage($data)
    {
        $inventry_q = MasterStockInventery::where('store_id', $data['store_id'])
            ->where('product_id', $data['product_id'])
            //->where('storage_site_id', $data['storage_site_id'])
            ->where('qty', '>', 0);
        if ($inventry_q->get()->count() > 0) {
            $inventry = $inventry_q->first();
            $inv_q = $inventry->qty;
            $inventry->update([
                'qty' =>  $inv_q - $data['qty'],
            ]);
        }

        $inventry_q = MasterStockInventery::with('product', 'store')->where('store_id', $data['store_id'])->where('product_id', $data['product_id'])->where('qty', '<', 5)->first();

        if ($inventry_q !== null) {

            $notification = Notification::create([
                // 'publisher_id' => ,
                'message' => "Stock Alert: Low stock for {$inventry_q->product->title} at I&CA Book Store - {$inventry_q->store->store_name}. Replenish inventory. - I&CA Dept, Govt of West Bengal",
                'date_time' => Carbon::now(),
                'is_read' => "unread",
                'user_id' =>  auth()->user()->id,
            ]);
            // $store_name = Product::where()
            $store_id = Store::where('id', $inventry_q->store_id)->first();
            $publisher = User::where('publisher_id', $store_id->publisher_id)->first();
            $store_mail = User::where('store_id', $store_id->id)->first();
            $sms_array = [
                'phone' => $publisher->phone,
                'body' => $notification->message,
            ];
            event(new GeneralSms($sms_array));
            //$this->low_stock_mail($publisher,$inventry_q->id);

        }
    }

    public function transaction($id)
    {
        $view_transaction = SalePayament::where('id', $id)->first();
        return view('admin.v1.pos.viewtransaction', compact('view_transaction'));
        // echo $id;
    }

    public function bookinfo($bookId)
    {
        $data = Product::with('bookauthor', 'publisher')->where('id', $bookId)->first();

        $publisher = Publisher::where('id', $data->publisher->publisher_id)->first();

        return view('admin.v1.pos.bookdetails', compact('data', 'publisher'));
    }

    public function custunpaid()
    {
        return view('admin.v1.pos.unpaidlist');
    }

    public function unpaidpos(Request $request)
    {
        $store_id = loginStore()->id;


        if ($request->ajax()) {
            $date = Carbon::today()->subDays(7);
            $data = Sale::with('customer')->where('store_id', $store_id)->where('sale_mode', 'pos')->where('status', 'unpaid')->where('created_at', '>=', $date)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button class="btn btn-info view-btn" id="duebill" data-id="' . $row->invoice_no . '"><i class="bx bx-credit-card"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return;
    }

    public function custprint()
    {
        return view('admin.v1.pos.printlist');
    }

    public function printpos(Request $request)
    {
        $store_id = loginStore()->id;


        if ($request->ajax()) {
            $date = Carbon::today()->subDays(7);
            $data = Sale::with('customer')->where('store_id', $store_id)->where('sale_mode', 'pos')->where('status', 'paid')->where('created_at', '>=', $date)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button class="btn btn-info view-btn" id="duebill" data-id="' . $row->invoice_no . '"><i class="bx bx-printer"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return;
    }

    public function billstatus($cus_id)
    {
        $srore_id = loginStore()->id;
        $data = Sale::where('store_id', $srore_id)->where('customer_id', $cus_id)->where('status', 'unpaid')->first();

        if ($data) {
            return true;
        }
    }

    public function pos_success_payment(Request $request)
    {
        $data = Sale::with('customer')->where('id', $request->sale_id)->first();
        $payment = SalePayament::where('sale_id', $request->sale_id)->first();
        return view('admin.v1.bill.successpayment', compact('payment', 'data'));
    }

    public function customerorder($email, $id)
    {
        $data = Sale::with('customer')->where('id', $id)->first();
        try {
            $maildata = [
                'title' => "Customer order has been Successfully Placed",
                'name' => $data->customer->name,
                'total' => $data->total,
                'sale_date' => $data->sale_date,
                'store_id' => $data->user->store->store_name,
                'sale_mode' => $data->sale_mode,
                'invoice_no' => $data->invoice_no,
            ];
            Mail::to($email)->send(new CustomerMail($maildata));
        } catch (Throwable $t) {
            Log::error('Mail sending failed: ' . $t->getMessage());
            //throw $t;
        }
    }
    public function customerpayament($email, $id)
    {
        $maildata = $this->maildata;
        $data = Sale::with('customer')->where('id', $id)->first();
        // $pdf = PDF::loadHtml('admin.v1.customerpayment',$maildata);
        try {
            $maildata = [
                'title' => "Customer Payment has been Successfull",
                'name' => $data->customer->name,
                'total' => $data->total,
                'sale_date' => $data->sale_date,
                'store_id' => $data->user->store->store_name,
                'sale_mode' => $data->sale_mode,
                'invoice_no' => $data->invoice_no,
                // 'pdf' => $pdf,
            ];
            // $html = view('admin.v1.customerpayment', [
            //     'title' => "Customer Payment has been Successful",
            //     'name' => $data->customer->name,
            //     'total' => $data->total,
            //     'sale_date' => $data->sale_date,
            //     'store_id' => $data->user->store->store_name,
            //     'sale_mode' => $data->sale_mode,
            //     'invoice_no' => $data->invoice_no,
            //     'pdf' => $pdf,
            // ])->render();

            // Load the HTML content into the PDF
            $ccEmails = ["admin@ica.book.store.com"];
            $bccEmails = ["ranitg.timd@gmail.com"];
            Mail::to($email)
                ->cc($ccEmails)
                ->bcc($bccEmails)
                ->send(new CustomerPayamentMail($maildata));
        } catch (Throwable $t) {
            Log::error('Mail sending failed: ' . $t->getMessage());
            throw $t;
        }
    }

    public function low_stock_mail($publish, $id)
    {
        $product = Product::where('id', $id);
        $store = Store::where('id', $id->store_id);
        $app_name = optional(DB::table('app_infos')->first())->title;
        // try {
        $maildata = [
            'title' => "Low stock mail",
            'book_name' => $product->title,
            'pub_name' => $publish->name,
            'store_name' => $store->store_name,
            'app_name' => $app_name,

        ];
        $cc = $store->email;
        //$bcc = ['bcc@example.com'];
        Mail::to($publish->email)->cc($cc)->send(new LowstockMail($maildata));
        // } catch (Throwable $t) {
        // Log::error('Mail sending failed: ' . $t->getMessage());

        //  }
    }

    public function retryPayemnt()
    {
        $message = "Something went wrong please try again";
        session(['payment_error' => $message]);
        return redirect()->route('pos.index');
        //return view('admin.v1.pos.retry-payment');
    }

    public function unseterror()
    {
        Session::forget('payment_error');
        $sale_id = session('sale_id');
        
        $data = Sale::with('customer')->where('id',$sale_id)->first();
        $date = Carbon::now()->format('ymd H:m');

        return view ('admin.v1.bill.errorpayment',compact('data','date'));
        //return response('session unset');
    }
    public function customer_add($email,$id){
        $data = Customer::where('id',$id)->first();
        try{
            $maildata = [
                'name' => $data->name,
                'phone' => $data->phone,
                'app_name' => "I&CA BOOK Store",
            ];
            Mail::to($email)->send(new CustomeraddMail($maildata));
        } catch (Throwable $t) {
            Log::error('Mail sending failed: ' . $t->getMessage());
            throw $t;
        }
    }
}
