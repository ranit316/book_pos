<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use App\Models\Exchange;
use App\Models\ExchangeDetails;
use App\Models\MasterStockInventery;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\Rack;
use App\Models\SalePayament;
use App\Models\StorageLocation;
use App\Models\StorageSite;
use Database\Seeders\MasterStockerSeeder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class ExchangeController extends Controller
{
    public $page = 'Exchange';
    public function index(Request $request)
    {
        $page = $this->page;
        if ($request->ajax()) {
            $data = Exchange::with('store','customer')->where('store_id', loginStore()->id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.exchange.buttons', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.v1.exchange.index', compact('page'));
    }

    public function add()
    {
        $page = $this->page;
        return view('admin.v1.exchange.insert', compact('page'));
    }

    public function get_sale($invoice_no = null)
    {
        if (empty($invoice_no)) {
            return '<div class="alert alert-danger" role="alert">
                  Please Enter the Requisition number
       </div>';
        } else {
            $data = Sale::with('customer', 'storage_site')->where('invoice_no', $invoice_no)->where('store_id', loginStore()->id)->first();
            //$products = SaleDetails::with('product')->where('sale_id',$data->id)->get();
            if (!$data) {
                return '<div class="alert alert-danger" role="alert">
            No sale found with the provided invoice number
 </div>';
            } elseif ($data->status == 'unpaid') {
                return '<div class="alert alert-danger" role="alert">
            Your Bill is unpaid! Exchange not Available
 </div>';
            } else {
                $products = SaleDetails::with('product')->where('sale_id', $data->id)->get();
                $sites = StorageLocation::where('storage_site_id', $data->storage_site->id)->get();
                $racks = Rack::where('store_id', $data->store_id)->get();
                return view('admin.v1.exchange.get_exchange', compact('data', 'products', 'sites', 'racks'));
            }
        }
    }

    public function store(Request $request)
    {
        //return $request->all();

        $sale = Sale::where('invoice_no', $request->invoice_no)->first();
        $sale_payment = SalePayament::where('sale_id', $sale->id)->first();

        if (max($request->Qty) > 0) {
            $data = Exchange::create([
                'customer_id' => $request->customer_id,
                'storage_site_id' => $request->storage_site_id[0],
                'store_id' => loginStore()->id,
                'exchange_by' => auth()->user()->id,
                'publisher_id' => $sale->publisher_id,
                'invoice_number' => $request->invoice_no,
                'exchange_date' => Carbon::now()->format('ymd'),
                'transaction_no' => $sale_payment->trancaction_no,
                'status' => 'Exchange',
            ]);

            $sale->update([
                'status' => "paid(exchange)",
            ]);

            if (count($request->product_id) > 0) {
                for ($i = 0; $i < count($request->product_id); $i++) {
                    if ($request->Qty[$i] > 0 && $request->Qty[$i] != null) {
                        ExchangeDetails::create([
                            'exchange_id' => $data->id,
                            'product_id' => $request->product_id[$i],
                            'batch_no' => $request->batch_no[$i],
                            'lot_number' => $request->lot_no[$i],
                            'qty' => $request->Qty[$i],
                            'tax_percentage' => null,
                        ]);

                        $master_stock = MasterStockInventery::where('store_id', loginStore()->id)
                            ->where('product_id', $request->product_id[$i])
                            ->where('qty', '>', 0)
                            ->where('storage_site_id', $request->storage_site_id[$i])
                            ->first();

                        if ($master_stock) {
                            $master_stock->update([
                                'qty' => $master_stock->qty - $request->Qty[$i],
                            ]);
                        }

                        $exchange = MasterStockInventery::where('store_id', loginStore()->id)
                            ->where('product_id', $request->product_id[$i])
                            ->where('storage_site_id', $request->storage_site_id[$i])
                            ->where('purchase_price', $request->price[$i])
                            ->first();

                        if ($exchange) {
                            $exchange->update([
                                'qty' => $exchange->qty + $request->Qty[$i],
                            ]);
                        } else {
                            MasterStockInventery::create([
                                'product_id' => $request->product_id[$i],
                                'store_id' => loginStore()->id,
                                'storage_site_id' => $request->storage_site_id[$i],
                                'storage_location_id' => $request->storage_location_id[$i],
                                'rack_id' => $request->rack_id[$i],
                                'qty' => $request->Qty[$i],
                                'purchase_price' => $request->price[$i],
                                'sale_price' => $request->price[$i],
                                'supplier_price' => $request->price[$i],
                                'batch_no' => $request->batch_no[$i],
                                'lot_number' => $request->lot_no[$i],
                                'description' => $request->description,
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->route('exchange.index');
    }
}
