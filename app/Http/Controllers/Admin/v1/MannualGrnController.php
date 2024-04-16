<?php


namespace App\Http\Controllers\Admin\v1;

use App\Models\MannualGrn;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Dispatch;
use App\Models\GrnDetail;
use App\Models\MannualGrnDetails;
use App\Models\Product;
use App\Models\RequisitionDetails;
use App\Models\User;
use App\Models\Store;
use App\Models\AppInfo;
use App\Models\GstSlab;
use App\Models\StorageLocation;
use App\Models\Rack;
use App\Models\MasterStockInventery;
use App\Models\Publisher;
use App\Models\Purchase;
use App\Models\Requisition;
use Illuminate\Support\Facades\DB;
use App\Models\SalePrice;
use App\Models\StorageSite;
use Carbon\Carbon;

class MannualGrnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $page = 'Mannual Good Receive Note';
    public function index(Request $request)
    {
        if ((auth()->user()->role_id != 3) && (auth()->user()->type == 'central-store')) {
            abort(404);
        }

        $page = $this->page;
        //if ($request->ajax()) 
        //{
        if (isAdmin()) {
            $data = MannualGrn::with(['store', 'supplier'])->where('grn_type', null)->where('deleted_at', null)->orderByDesc('id')->get();
        }

        if (isCentral()) {
            //$data = MannualGrn::with(['store', 'supplier'])->where('to_store', loginStore()->id)->where('deleted_at', null)->orderByDesc('id')->get();
            $data = MannualGrn::with(['store', 'supplier'])->where('store_id', loginStore()->id)->where('deleted_at', null)->orderByDesc('id')->get();
            //return $data;
        }
        if (isRetail()) {
            $data = MannualGrn::with(['store', 'supplier'])->where('grn_type', null)->where('store_id', loginStore()->id)->where('deleted_at', null)->orderByDesc('id')->get();
        }
        if (isPublisher()) {
            $data = MannualGrn::with(['store', 'supplier'])->where('grn_type', null)->where('deleted_at', null)->where('supplier_id', auth()->user()->id)->orderByDesc('id')->get();
            return $data;
        }

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.mannual_grn.buttons', ['item' => $row, "route" => 'mannual-grn', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.v1.mannual_grn.index', compact('page'));
    }
    public function grncsv(Request $request)
    {
        $page = 'GRN CSV';


        return view('admin.v1.mannual_grn.grncsv', compact('page'));
    }
    public function grncsv_upload(Request $request)
    {
        $page = 'GRN CSV Upload';


        return view('admin.v1.mannual_grn.grncsv_upload', compact('page'));
    }
    public function grncsv_download()
    {

        $products = Product::with(['master_stock_inventory', 'publisher', 'bookauthor'])->where('deleted_at', null)->where('products.supplier_id', auth()->user()->parent_id)->get();
        // $products = Product::with(['master_stock_inventory', 'publisher', 'bookauthor'])->where('deleted_at', null)->where('products.supplier_id', auth()->user()->parent_id)->get();
        //return $products[0]->master_stock_inventory;
        // echo "<pre>";
        //print_r($products);
        // die();

        /*  $res =1111;
       $sq_1 = MasterStockInventery::where(['product_id'=>5,'store_id'=>loginStore()]);
             if($sq_1->get()->count() > 0)
             {
                $res  =$sq_1->first()->sale_price;
             }
        return $res;
       */


        $fileName = "books.csv";
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );


        // Add CSV headers
        $columns = array('ID', 'PublisherID', 'Name', 'Author', 'Price', 'Store-Price', 'Avl-Qty', 'Req-Qty', 'Batch-No', 'Storage site id', 'Storage location id', 'Rack id');
        $line = "Fill this form as per instruction";
        $line = str_pad($line, count($columns) * 12, ' ', STR_PAD_BOTH); // Assuming an average cell width of 12 characters

        // Add product data to the CSV
        $callback = function () use ($products, $columns, $line) {
            $file = fopen('php://output', 'w');
            fwrite($file, $line . PHP_EOL);
            fputcsv($file, $columns);
            if (!empty($products)) {
                foreach ($products as $product) {
                    $row['ID']  = $product->id;
                    $row['PublisherID']    = $product->publisher->id;
                    $row['Name']    = $product->title;
                    $row['Author']  = $product->bookauthor->name;
                    $row['Price']  = $product->price;



                    $row['Store-Price'] = 0;
                    $row['Avl-Qty'] = 0;
                    $row['Batch-No'] = '';

                    $row['storage_site_id'] = '';
                    $row['storage_location_id'] = '';
                    $row['rack_id'] = '';

                    $sq_1 = MasterStockInventery::where(['product_id' => $product->id, 'store_id' => loginStore()->id]);
                    if ($sq_1->get()->count() > 0) {
                        $row['Store-Price']  = $sq_1->first()->sale_price;
                        $row['Avl-Qty']  = $sq_1->first()->qty;
                        $row['Batch-No'] = $sq_1->first()->batch_no;



                        $row['storage_site_id'] = $sq_1->first()->storage_site_id;
                        $row['storage_location_id'] = $sq_1->first()->storage_location_id;
                        $row['rack_id'] = $sq_1->first()->rack_id;
                    }




                    $row['Req-Qty'] = 0;
                    fputcsv($file, array($row['ID'], $row['PublisherID'], $row['Name'], $row['Author'], $row['Price'], $row['Store-Price'], $row['Avl-Qty'], $row['Req-Qty'], $row['Batch-No'], $row['storage_site_id'], $row['storage_location_id'], $row['rack_id']));
                }
            }
            fclose($file);
        };
        // Return the CSV as a response
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getStorageLocationOnSiteId(Request $request, $site_id = null)
    {
        // return $request->publisher_id;
        //$products =  Product::with('gst')->where('deleted_at', null)->where('supplier_id', $request->publisher_id)->where('title', 'like', '%' . $product . '%')->limit(50)->get();
        $products =  StorageLocation::where('deleted_at', null)->where('storage_site_id', $request->site_id)->limit(50)->get();
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

    public function create(Request $request)
    {
        // $date = Carbon::now();
        // $formatteDate = $date->format('y-m');
        $data['stores'] =  Store::where('deleted_at', null)->where('type', 'central-store')->get();
        $data['brands'] = Brand::where('deleted_at', null)->get();
        $data['suppliers'] = User::where('id', auth()->user()->parent_id)->get(); 
        //return $data['suppliers'];
        //$data['products'] = Product::where('deleted_at', null)->get();
        $data['page'] = $this->page;    
        $data['products'] = Product::where('status', 'active')->where('deleted_at', null)->where('supplier_id', auth()->user()->parent_id)->get();
        $data['dispatches'] = Dispatch::where('deleted_at', null)->where('store_id', loginStore()->id)->orderByDesc('id')->get();
        $store_id = User::where('store_id', loginStore()->id)->first();
        $data['page'] = $this->page;
        // $grn = MannualGrn::latest()->first();
        // $grn_id = sprintf("%04s", ($grn->id ?? 0) + 1);
        // $store = sprintf("%04d", $store_id->store_id);
        // if ($grn != null) {
        // $grn_no = "CGRN-" . $store . "-" . $formatteDate . "-" . ($grn_id);
        // }else{
        //     $grn_no = "GRN-".$store."-".$formatteDate."-"."0001";
        // }
        // $data['grn_no'] = $grn_no;
        //     $store = StorageSite::where('deleted_at', null)->where('store_id', loginStore()->id)->where('flag', "default")->first();
        //    return $data['storage_locations'] = StorageLocation::where('deleted_at', null)->where('storage_site_id',$store->id)
        //         ->get();

        return view('admin.v1.mannual_grn.insert', $data);
        // }
    }

    public function status($id)
    {
        $status = MannualGrn::find($id);
        if ($status->status == "active") {
            MannualGrn::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            MannualGrn::where('id', $id)->update(['status' => 'active']);
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


        if (isRetail()) {
            $request->merge([
                'supplier_id' => Store::find($request->to_store)->id
            ]);
        }
        // dd($request->all());
        if ($validate->fails()) {
            return $validate->errors();
        } else {
            // try {
            $store_id = User::where('store_id', loginStore()->id)->first();
            $date = Carbon::now();
            $formatteDate = $date->format('y-m');
            $grn = MannualGrn::latest()->first();
            $grn_id = sprintf("%04s", ($grn->id ?? 0) + 1);
            $store = sprintf("%04d", $store_id->store_id);
            $grn_no = "CGRN-" . $store . "-" . $formatteDate . "-" . ($grn_id);
            $request->merge([
                'store_id' => loginStore()->id,
                'created_by' => auth()->user()->id,
                'grn_date' => date('Y-m-d'),
                'grn_type' => 'manual',
                'grn_no' => $grn_no,
            ]);



            $grn =  MannualGrn::create($request->except(['_token', 'products', 'request_qty', 'mrp_price', 'purchase_price', 'sale_price', 'batch_no', 'array_gst', 'array_cgst', 'array_igst', 'array_sgst', 'array_taxeble_amount', 'array_total_amount', 'lot_number']));

            if (count($request->products) > 0) {
                for ($i = 0; $i < count($request->products); $i++) {
                    $product = Product::where('id', $request->products[$i])->first();

                    $data = [
                        'mannual_grn_id' => $grn->id,
                        'product_id' => $request->products[$i],
                        //'price' => $request->price[$i],
                        'price' => $product->price,
                        'sale_price' => $request->price[$i],
                        'request_qty' => $request->request_qty[$i],
                        'total_amount' => $request->array_total_amount[$i],
                        'storage_site_id' => $request->storage_site_id[$i],
                        'storage_location_id' => $request->storage_location_id[$i],
                        'rack_id' => $request->rack_id[$i],
                        'batch_no' => $request->batch_no[$i],
                        // 'lot_number' =>$request->lot_no[$i],
                        'updated_at' => date('Y-m-d h:i:s')
                    ];
                    MannualGrnDetails::create($data);
                    // SalePrice::create($data);
                    // $data = array_merge($data, [
                    //     'lot_number' => $request->lot_no[$i],
                    // ]);
                    $this->masterStockManage($data);
                }
            }
            return response()->json(['success' => $this->page . " SuccessFully Added "]);
            // } catch (Exception $e) {
            //     return response()->json(['error' => $e->getMessage()]);
            // }
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
        $stores =  Store::where('deleted_at', null)->where('type', 'central-store')->get();
        $brands = Brand::where('deleted_at', null)->get();
        $suppliers = User::where('type', 'publisher')->get();
        $products = Product::where('deleted_at', null)->get();
        $page = $this->page;
        $data = MannualGrn::with('details', 'publisher')->where('deleted_at', null)->where('id', $id)->first();
        return view('admin.v1.mannual_grn.edit', compact('page', 'brands', 'stores', 'suppliers', 'products', 'data'));
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
            // 'title' => 'required|string|unique:purchase,title',
        ]);

        // dd($request->all());
        if ($validate->fails()) {
            return $validate->errors();
        }
        try {
            $request->merge([
                'store_id' => loginStore()->id,
                'created_by' => auth()->user()->id,
                'requisition_date' => date('Y-m-d'),
            ]);



            MannualGrn::where('id', $id)->update($request->except(['_method', '_token', 'products', 'request_qty', 'price', 'purchase_price', 'sale_price', 'batch_no', 'array_gst', 'array_cgst', 'array_igst', 'array_sgst', 'array_taxeble_amount', 'array_total_amount', 'array_tax_amount', 'tatal_tax']));
            if (count($request->products) > 0) {
                RequisitionDetails::where('requisition_id', $id)->delete();
                for ($i = 0; $i < count($request->products); $i++) {
                    RequisitionDetails::create([
                        'requisition_id' => $id,
                        'product_id' => $request->products[$i],
                        'price' => $request->price[$i],
                        'request_qty' => $request->request_qty[$i],
                        'dispatch_qty' => $request->request_qty[$i],
                        'received_qty' => $request->request_qty[$i],
                        'tax_amount' => $request->array_tax_amount[$i],
                        'taxeble_amount' => $request->array_taxeble_amount[$i],
                        'total_amount' => $request->array_total_amount[$i],
                        'purchase_price' => $request->purchase_price[$i],
                        'sale_price' => $request->sale_price[$i],
                        'batch_no' => $request->batch_no[$i],
                        'cgst' => $request->array_cgst[$i],
                        'sgst' => $request->array_igst[$i],
                        'igst' => $request->array_igst[$i],
                        'updated_at' => date('Y-m-d h:i:s')
                    ]);
                }
            }
            return response()->json(['success' => $this->page . " SuccessFully Updated "]);
        } catch (Exception $e) {
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
            MannualGrn::where('id', $id)->update(['deleted_at' => date('Y-m-d h:i:s'), 'deleted_by' => auth()->user()->id]);
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

    public function get_purchase($dispatch_no = null)
    {

        if (empty($dispatch_no)) {
            return '<div class="alert alert-danger" role="alert">
                       Please Enter the Dispatch order number
            </div>';
        }
        $data['data'] = Dispatch::with(['details', 'details.product', 'store', 'supplier', 'to_store'])->where('deleted_at', null)->where('dispatch_no', $dispatch_no)->first();
        $data['brands'] = Brand::where('deleted_at', null)->get();
        $data['products'] = Product::where('deleted_at', null)->get();
        $data['page'] = $this->page;
        //return $data['data'];
        if (empty($data['data'])) {
            return '<div class="alert alert-warning" role="alert">
                   Please Check you Dispatch order number 
                   </div>';
        }
        return view('admin.v1.grn.get_grn', $data);
    }


    public function grncsv_upload_submit(Request $request)
    {

        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        // Open and read the CSV file
        $handle = fopen($path, 'r');

        $total_amount = 0;

        // Get the header
        $header = fgetcsv($handle);
        $total_amount = 0;
        $total_req_qty = 0;
        $data = [];
        while (($row = fgetcsv($handle)) !== false) {
            // Map CSV columns to database columns
            // ============= insert into grn_details==================
            for ($i = 0; $i <= 11; $i++) {
                if ($row[$i] == '') {
                    continue 2;
                }
            }
            if (Product::where('id', $row[0])->exists()) {
                // The record exists
                if ($row[7] > 0) {
                    $total_amount = $total_amount + ($row[5] * $row[7]);
                    $total_req_qty = $total_req_qty + $row[7];

                    $data[] = (object) array(
                        'product_id' => $row[0],
                        'publisher_name' => $row[1],
                        'product_name' => $row[2],
                        'author' => $row[3],
                        'price' => $row[4],
                        'store_price' => $row[5],
                        'avl_qty' => $row[6],
                        'req_qty' => $row[7],
                        'batch_no' => $row[8],
                        'storage_site_id' => $row[9],
                        'storage_location_id' => $row[10],
                        'rack_id' => $row[11]

                    );
                }
            }
        } // end of while loop
        //return $data[0]->product_id;
        fclose($handle);

        if ($total_req_qty > 0) {
            $store_id = loginStore()->id;
            $created_by = auth()->user()->id;
            $grn_date = date('Y-m-d');
            $date = Carbon::now();
            $formatteDate = $date->format('y-m');
            $grn = MannualGrn::latest()->first();
            $grn_id = sprintf("%04s", ($grn->id ?? 0) + 1);
            $store_id_format = sprintf("%04d", $store_id);
            $grn_no = "CGRN-" . $store_id_format . "-" . $formatteDate . "-" . ($grn_id);

            $grn_type = 'CSV';

            $supplier_id = auth()->user()->parent_id;



            $temp_data = ['store_id' => $store_id, 'created_by' => $created_by, 'grn_date' => $grn_date, 'grn_no' => $grn_no, 'grn_type' => $grn_type, 'supplier_id' => $supplier_id, 'total_amount' => $total_amount];
            $grn =  MannualGrn::create($temp_data);

            if (count($data) > 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $data_int = [
                        'mannual_grn_id' => $grn->id,
                        'product_id' => $data[$i]->product_id,
                        'price' => $data[$i]->price,
                        'sale_price' => $data[$i]->store_price,
                        'request_qty' => $data[$i]->req_qty,
                        'total_amount' => ($data[$i]->req_qty * $data[$i]->store_price),
                        'storage_site_id' => $data[$i]->storage_site_id,
                        'storage_location_id' => $data[$i]->storage_location_id,
                        'rack_id' => $data[$i]->rack_id,
                        'batch_no' => $data[$i]->batch_no,
                        'grn_type' => 'CSV',
                        // 'lot_number' =>$request->lot_no[$i],
                        'updated_at' => date('Y-m-d h:i:s')
                    ];

                    MannualGrnDetails::create($data_int);
                    // SalePrice::create($data);

                    $this->masterStockManage($data_int);
                }
            }
        }
        return 'Your csv data is updated';
    }
    //chk_grncsv_upload_submit
    public function chk_grncsv_upload_submit(Request $request)
    {
        // return $request;
        $validate = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt|max:10240', // Ensure the file is a CSV and not too large

            //'rack_id' => 'required|string',

        ]);
        if ($validate->fails()) {
            //return $validate->errors();
            $errors = $validate->errors();
            if ($errors->has('csv_file')) {
                return $errors->first('csv_file');
            }
        } else {

            $file = $request->file('csv_file');
            $path = $file->getRealPath();

            // Open and read the CSV file
            $handle = fopen($path, 'r');

            // Get the header
            $header = fgetcsv($handle);
            $total_amount = 0;
            $data = [];
            while (($row = fgetcsv($handle)) !== false) {
                // Map CSV columns to database columns
                // ============= insert into grn_details==================
                for ($i = 0; $i <= 11; $i++) {
                    if ($row[$i] == '') {
                        continue 2;
                    }
                }
                if (Product::where('id', $row[0])->exists()) {
                    // The record exists

                    $data[] = (object) array(
                        'product_id' => $row[0],
                        'publisher_name' => $row[1],
                        'product_name' => $row[2],
                        'author' => $row[3],
                        'price' => $row[4],
                        'store_price' => $row[5],
                        'avl_qty' => $row[6],
                        'req_qty' => $row[7],
                        'batch_no' => $row[8],
                        'storage_site_id' => $row[9],
                        'storage_location_id' => $row[10],
                        'rack_id' => $row[11]

                    );
                }
            } // end of while loop
            //return $data[0]->product_id;
            fclose($handle);

            return view('admin.v1.mannual_grn.chk_csv', ['data' => $data]);
        }
    }


    public function masterStockManage($dispatch_datails)
    {
        $inventry =  MasterStockInventery::where('store_id', auth()->user()->store_id)
            ->where('product_id', $dispatch_datails['product_id'])
            ->where('storage_site_id', $dispatch_datails['storage_site_id'])
            ->where('storage_location_id', $dispatch_datails['storage_location_id'])
            ->where('rack_id', $dispatch_datails['rack_id'])
            //->where('batch_no', $dispatch_datails['batch_no'])
            //->where('sale_price', $dispatch_datails['sale_price'])
            ->first();
        if (!empty($inventry)) {
            $inventry->update([
                'qty' => $inventry->qty + $dispatch_datails['request_qty'],
                'purchase_price' => $dispatch_datails['price'],
                'sale_price' => $dispatch_datails['sale_price'],
            ]);
        } else {
            $masterStockInventery = MasterStockInventery::create([
                'product_id' => $dispatch_datails['product_id'],
                'store_id' => loginStore()->id,
                'storage_site_id' => $dispatch_datails['storage_site_id'],
                'storage_location_id' => $dispatch_datails['storage_location_id'],
                'rack_id' => $dispatch_datails['rack_id'],
                'qty' => $dispatch_datails['request_qty'],
                'purchase_price' => $dispatch_datails['price'],
                'sale_price' => $dispatch_datails['sale_price'],
                'supplier_price' => $dispatch_datails['price'],
                'discount_amount' => $dispatch_datails['discount_amount'] ?? 0,
                'batch_no' => $dispatch_datails['batch_no'],
            ]);
            $lastInsertId = $masterStockInventery->id;
            SalePrice::create([
                'product_id' => $dispatch_datails['product_id'],
                // 'master_stock_inventeries_id' => $dispatch_datails['dispatch_datails'],
                'store_id' => loginStore()->id,
                'storage_site_id' => $dispatch_datails['storage_site_id'],
                'storage_location_id' => $dispatch_datails['storage_location_id'],
                'rack_id' => $dispatch_datails['rack_id'],
                'sale_price' => $dispatch_datails['sale_price'],
                'qty' => $dispatch_datails['request_qty'],
                'purchase_price' => $dispatch_datails['price'],
                //'lot_number' => $dispatch_datails['lot_number'],
                'price' =>  $dispatch_datails['price'],
            ]);
        }
    }

    public function grn_print($id)
    {
         //return $id;
         $fetch_data = MannualGrn::with(['details.product','store'])->where('id',$id)->first();
         $data = Publisher::where('id',$fetch_data->supplier_id )->first();
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
         return view('admin.v1.mannual_grn.grn_print',compact('fetch_data','data','logo','tax'));
    }

    public function grn_pdf($id)
    {
           //return $id;
           $fetch_data = MannualGrn::with(['details.product','store'])->where('id',$id)->first();
           $data = Publisher::where('id',$fetch_data->supplier_id )->first();
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
           return view('admin.v1.mannual_grn.grn_pdf',compact('fetch_data','data','logo','tax'));
    }
}
