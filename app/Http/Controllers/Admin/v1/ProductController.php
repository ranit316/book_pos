<?php

namespace App\Http\Controllers\Admin\v1;

use Exception;
use App\Models\Rack;
use App\Models\User;
use App\Models\Brand;
use App\Models\Author;
use League\Csv\Reader;
use App\Models\GstSlab;
use App\Models\Product;
use App\Models\Category;
use League\Csv\Statement;
use App\Models\MannualGrn;
use App\Models\StorageSite;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Models\StorageLocation;
use NunoMaduro\Collision\Writer;
use Yajra\DataTables\DataTables;
use App\Models\MannualGrnDetails;
use League\Csv\CannotInsertRecord;
use Database\Seeders\GstslabSeeder;
use App\Http\Controllers\Controller;
use App\Models\MasterStockInventery;
use App\Models\Publisher;
use App\Models\RequisitionDetails;
use App\Models\Unit;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;




class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $page = 'Book';
    public function index(Request $request)
    {
        $page = $this->page;

        if ((auth()->user()->role_id != 3) && (auth()->user()->type == 'central-store')) {
            abort(404);
        }
        if ((auth()->user()->role_id != 1) && (auth()->user()->type == 'retail-store')) {
            abort(404);
        }
        if ($request->ajax()) {
            if (isAdmin()) {
                $data = Product::with('bookauthor', 'bookpublisher.publisher', 'bookcategory')->where('deleted_at', null)->orderByDesc('id')->get();
            } else if (isCentral()) {
                $publisher_id = auth()->user()->parent_id;

                $data = Product::with('bookauthor', 'bookpublisher.publisher', 'bookcategory')->where('status', 'active')->where('deleted_at', null)->where('supplier_id', $publisher_id)->orderByDesc('id')->get();
            } else if (isRetail()) {
                // $retail_id = auth()->user()->id;
                $data = Product::with('bookauthor', 'bookpublisher.publisher', 'bookcategory')->where('status', 'active')->where('deleted_at', null)->orderByDesc('id')->get();
                // ->where('supplier_id', $retail_id)-
            } else {
                $data = Product::with('bookauthor', 'bookpublisher.publisher', 'bookcategory')->where('status', 'active')->where('deleted_at', null)->where('supplier_id', auth()->user()->id)->orderByDesc('id')->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.v1.product.buttons', ['item' => $row, "route" => 'books', 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.v1.product.index', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (isCentral()) {
            abort(404);
        } else {
            $id = auth()->user()->id;
            $data['categories'] = Category::where('deleted_at', null)->where('status', 'active')->orderBy('name', 'asc')->get();
            $data['brands'] = Brand::where('deleted_at', null)->get();
            if (isAdmin()) {

                $data['suppliers'] = User::where('type', 'publisher')
                    ->with(['publisher' => function ($query) {
                        $query->where('status', 'active');
                    }])->orderBy('name', 'asc')
                    ->get();
                //     //$data['suppliers'] = Publisher::where('deleted_at', null)->where('status','active')->get();


                // } else {
                //     $data['suppliers'] = User::where('type', 'publisher')->where('publisher_id', auth()->user()->id)->get();
                //     //$data['suppliers'] = Publisher::where('id', auth()->user()->id)->get();
                // }

                // if (isAdmin()) {
                // $data['suppliers'] = User::with('publisher')->get();
            } else {
                $data['suppliers'] = User::where('type', 'publisher')->where('id', auth()->user()->id)->orderBy('name', 'asc')->get();
            }

            $data['racks'] = Rack::where('deleted_at', null)->get();
            $data['storage_locations'] = StorageLocation::where('deleted_at', null)->get();
            $data['storage_sites'] = StorageSite::where('deleted_at', null)->get();
            $data['gst_slabs'] = GstSlab::where('deleted_at', null)->get();
            $data['authors'] = Author::orderBy('name', 'asc')->get();
            $data['units'] = Unit::where('status', 'active')->orderBy('name', 'asc')->get();
            $data['page'] = $this->page;

            return view('admin.v1.product.insert', $data);
        }
    }

    public function status($id)
    {
        $status = Product::find($id);
        if ($status->status == "active") {
            Product::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            Product::where('id', $id)->update(['status' => 'active']);
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
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg',
            'author' => 'required|string',
            'supplier_id' => 'required',
            'price' => 'required',
            'publication_date' => 'required',
            'language' => 'required',
            'unit_id' => 'required',
            // 'status'=>'required',

        ]);
        if ($validate->fails()) {
            return $validate->errors();
        } else {
            try {
                $request->request->add(['created_by' => auth()->user()->id, 'image' => "null",]);


                $request->merge([
                    'status' => 'active',
                ]);

                // if (isPublisher()) {
                // $request['supplier_id'] = auth()->user()->id;
                // }else{
                $data = Product::create($request->except('_token'));
                // }


                if ($request->hasFile('image')) {
                    Product::where('id', $data->id)->update(['image' => $this->insert_image($request->file('image'), 'product')]);
                } else {
                    Product::where('id', $data->id)->update(['image' => "assets/images/product/bookplaceholder.jpg"]);
                }
                return response()->json(['success' => $this->page . " SuccessFully Added "]);
            } catch (Exception $e) {
                // return response()->json(['error' => $this->page . " showing somthing wrong "]);
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    public function books_uploads(Request $request)
    {
        $page = 'Book Upload';
        echo "hi";
        die();

        // return view('admin.v1.product.book_upload', compact('page'));
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
        $data['data'] = Product::find($id);
        $data['page'] = $this->page;
        $data['categories'] = Category::where('deleted_at', null)->orderBy('name', 'asc')->get();
        $data['brands'] = Brand::where('deleted_at', null)->get();

        // $data['suppliers'] = User::where('type', 'publisher')->where('id', auth()->user()->id)->orderBy('name','asc')->get();
        $data['suppliers'] = User::where('type', 'publisher')
            ->with(['publisher' => function ($query) {
                $query->where('status', 'active');
            }])->orderBy('name', 'asc')
            ->get();

        $data['gst_slabs'] = GstSlab::where('deleted_at', null)->get();
        $data['page'] = $this->page;
        $data['authors'] = Author::orderBy('name', 'asc')->get();
        $data['units'] = Unit::where('status', 'active')->orderBy('name', 'asc')->get();
        return view('admin.v1.product.edit', $data);
    }

    public function view($id)
    {
        $data['data'] = Product::find($id);
        $data['page'] = $this->page;
        $data['categories'] = Category::where('deleted_at', null)->orderBy('name', 'asc')->get();
        $data['brands'] = Brand::where('deleted_at', null)->get();

        // $data['suppliers'] = User::where('type', 'publisher')->where('id', auth()->user()->id)->orderBy('name','asc')->get();
        $data['suppliers'] = User::where('type', 'publisher')
            ->with(['publisher' => function ($query) {
                $query->where('status', 'active');
            }])->orderBy('name', 'asc')
            ->get();

        $data['gst_slabs'] = GstSlab::where('deleted_at', null)->get();
        $data['page'] = $this->page;
        $data['authors'] = Author::orderBy('name', 'asc')->get();
        $data['units'] = Unit::where('status', 'active')->orderBy('name', 'asc')->get();
        return view('admin.v1.product.view', $data);
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
            'title' => 'required|string',
            'image' => 'image|mimes:png,jpg',
            'author' => 'required|string',
            'price' => 'required',
            'publication_date' => 'required',
            'language' => 'required',
            'unit_id' => 'required',
            'status' => 'required',
        ]);
        if ($validate->fails()) {
            return $validate->errors();
        } else {
            try {
                $request->request->add(['updated_by' => auth()->user()->id]);
                Product::where('id', $id)->update($request->except(['_token', '_method', 'image']));
                if ($request->hasFile('image')) {
                    $this->update_images('products', $id, $request->file('image'), 'product', 'image');
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
            /* $qty = MasterStockInventery::where('product_id',$id)->sum('qty');
            if($qty){
                Product::where('id', $id)->update(['status' => "inactive"]);
                return "inactive";
            }else{
            Product::where('id', $id)->update(['deleted_at' => date('Y-m-d h:i:s'), 'deleted_by' => auth()->user()->id]);
            return "Delete";
            }
            */
            $master_stock = MasterStockInventery::where('product_id', $id)->get()->count();
            $req_det = RequisitionDetails::where('product_id', $id)->get()->count();

            if (($master_stock > 0) || ($req_det > 0)) {
                Product::where('id', $id)->update(['status' => "inactive"]);
                //return "inactive";
                return redirect()->back()->with('error', 'Book successfully inactive.');
            } else {
                Product::where('id', $id)->update(['deleted_at' => date('Y-m-d h:i:s'), 'deleted_by' => auth()->user()->id]);
                // return "Delete";
                return redirect()->back()->with('error', 'Book successfully deleted.');
            }
        } catch (Exception $e) {
            //return response()->json(["error" => $this->page . "Can't Be Delete this May having some child"]);
            return redirect()->back()->with('error', 'Book successfully deleted.');
        }
    }

    /*     public function csv_productDownload()
    {
        $data['page'] = $this->page;
        return view('admin.v1.product.product-download-csv', $data);
    }

    public function csv_productDownloadByPublisherId()
    {
        $products = Product::where('deleted_at', null)->where('supplier_id', auth()->user()->parent_id)->get();
        //return $products;
        // Create a CSV writer instance
        $csv = Writer::createFromFileObject(new \SplTempFileObject());

    // Add CSV headers
    $csv->insertOne(['ID', 'PublisherID', 'Name','Author', 'Price','Quantity', 'Batch-No']);

    // Add product data to the CSV
    foreach ($products as $product) {
        try {
            $csv->insertOne([$product->id, $product->supplier_id, $product->title, $product->author, $product->price]);
        } catch (CannotInsertRecord $e) {
            // Handle exception if any issue occurs while inserting records
            // For simplicity, you can log the exception or take appropriate action
        }   
     }

    // Set the CSV response headers
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="products.csv"',
    ];

    // Return the CSV as a response
    return Response::make($csv->getContent(), 200, $headers);
       
    } */

    public function csv_productDownload()
    {


        $data['page'] = $this->page;
        return view('admin.v1.product.product-download-csv', $data);
    }

    public function csv_productDownloadByPublisherId()
    {

        $products = Product::with(['master_stock_inventory', 'publisher', 'bookauthor'])->where('deleted_at', null)->where('products.supplier_id', auth()->user()->id)->get();
        // $products = Product::with(['master_stock_inventory', 'publisher', 'bookauthor'])->where('deleted_at', null)->where('products.supplier_id', auth()->user()->parent_id)->get();
        //return $products[0]->master_stock_inventory;
        $products = Product::where('deleted_at', null)->where('products.supplier_id', auth()->user()->id)->get();



        $fileName = "books.csv";
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );



        // Add CSV headers
        $columns = array('Title', 'Author', 'Price');




        // Add product data to the CSV
        $callback = function () use ($products, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            $row['Title']  = '';
            $row['Author']    = '';
            $row['Price']    = 0;



            fputcsv($file, array($row['Title'], $row['Author'], $row['Price']));

            $options = array("Author 1", "Author 2", "Author 3");

            // Data array
            $data = array(

                array("",  implode(", ", $options), 0),
                array("",  implode(", ", $options), 0)
            );
            foreach ($data as $row) {
                fputcsv($file, $row);
            }



            fclose($file);
        };
        // Return the CSV as a response
        return response()->stream($callback, 200, $headers);
    }

    public function csv_productUpload()
    {
        $data['page'] = $this->page;
        return view('admin.v1.product.product-upload-csv', $data);
    }

    public function chkCsvProductUpload(Request $request)
    {
        // return $request;
        $validate = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt|max:10240', // Ensure the file is a CSV and not too large
            'storage_site_id' => 'required|string',
            'storage_location_id' => 'required|string',
            //'rack_id' => 'required|string',

        ]);
        if ($validate->fails()) {
            return $validate->errors();
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
                for ($i = 0; $i <= 8; $i++) {
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
                        'request_qty' => $row[7],
                        'batch_no' => $row[8],
                        'total_qty' => $row[6] + $row[7],
                        'total_amount' => $row[4] * $row[7],
                    );
                }
            } // end of while loop
            //return $data[0]->product_id;
            fclose($handle);

            return view('admin.v1.product.chk_csv', ['data' => $data]);
        }
    }


    public function csv_productUploadMasterInventory(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt|max:10240', // Ensure the file is a CSV and not too large
            'storage_site_id' => 'required|string',
            'storage_location_id' => 'required|string',
            'rack_id' => 'required|string',

        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        } else {

            $file = $request->file('csv_file');
            $path = $file->getRealPath();

            // Open and read the CSV file
            $handle = fopen($path, 'r');

            // Get the header
            $header = fgetcsv($handle);
            try {
                DB::beginTransaction();

                $grn =  MannualGrn::create([
                    'grn_no' => 'GRN' . rand(1000000000, 9999999999),
                    'store_id' => loginStore()->id,
                    'supplier_id' => auth()->user()->parent_id,
                    'created_by' => auth()->user()->id,
                    'grn_date' => date('Y-m-d'),
                ]);

                $total_amount = 0;
                // Read and process each row
                while (($row = fgetcsv($handle)) !== false) {
                    for ($i = 0; $i <= 8; $i++) {
                        if ($row[$i] == '') {
                            continue 2;
                        }
                    }
                    if (Product::where('id', $row[0])->exists()) {
                        // The record exists
                        // Map CSV columns to database columns
                        $productId = $row[0];
                        // ============= insert into grn_details==================
                        $data = [
                            'mannual_grn_id' => $grn->id,
                            'product_id' => $productId,
                            'price' => $row[4],
                            'request_qty' => $row[7],
                            'total_amount' => $row[4] * $row[7],
                            'storage_site_id' => $request->storage_site_id,
                            'storage_location_id' => $request->storage_location_id,
                            'rack_id' => $request->rack_id,
                            'batch_no' => $row[8],
                            'updated_at' => date('Y-m-d h:i:s')
                        ];
                        MannualGrnDetails::create($data);
                        //=======================================================
                        $inventry =  MasterStockInventery::where('store_id', auth()->user()->store_id)
                            ->where('product_id', $productId)
                            ->where('storage_site_id', $request->storage_site_id,)
                            ->where('storage_location_id', $request->storage_location_id)
                            ->where('rack_id', $request->rack_id)
                            ->where('batch_no', $row[8])
                            ->first();

                        if (!empty($inventry)) {
                            $inventry->update([
                                'purchase_price' => $row[4],
                                'sale_price' => $row[5],
                                'qty' => $row[6] + $row[7],
                            ]);
                        } else {
                            MasterStockInventery::create([
                                'product_id' => $productId,
                                'store_id' => loginStore()->id,
                                'storage_site_id' => $request->storage_site_id,
                                'storage_location_id' => $request->storage_location_id,
                                'rack_id' => $request->rack_id,
                                'purchase_price' => $row[4],
                                'sale_price' => $row[5],
                                'supplier_price' => $row[4],
                                'qty' => $row[7],
                                'batch_no' => $row[8],
                                'discount_amount' =>  0,
                            ]);
                        }

                        $total_amount += $row[4] * $row[7];
                        DB::commit();
                    }
                } // end of while loop
                $grn->update([
                    'total_amount' => $total_amount,

                ]);
                fclose($handle);

                return response()->json(['success' => $this->page . " SuccessFully Added "]);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json(['error' => $e->getMessage()]);
            }
        } //
    }

    public function getProductById(Request $request, $bookid = null)
    {

        $myModelQuery =  Product::where('deleted_at', null);
        if ($bookid != null) {
            $myModelQuery->where('id', $bookid);
        } else {
            $myModelQuery->where('supplier_id', $request->publisher_id);
        }
        $products = $myModelQuery->get();

        return $products;
    }

    public function books_search($id)
    {
        //return $id;
        $data = Product::where('deleted_at', null)->where('id', $id)->first();
        return $data;
    }

    

    /* public function csv_productUploadMasterInventory (Request $request)
    {
        $validate = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt|max:10240', // Ensure the file is a CSV and not too large

        ]);
        if ($validate->fails()) {
            return $validate->errors();
        } else {
            $uploadedFile = $request->file('csv_file');

            // Read the uploaded CSV file
            $reader = Reader::createFromPath($uploadedFile->getPathname());
    
            // Assuming the first row contains headers
            $headers = $reader->fetchOne();
           // $reader->setOffset(1); // Skip headers
    
            // Process each row
             // Process each row
        $limit = 1000; // Set a reasonable limit based on your needs
        $offset = 1;

        $stmt = (new Statement())->offset($offset)->limit($limit);
        $records = $stmt->process($reader)->fetchAllAssociative();

        while (!empty($records)) {
            foreach ($records as $row) {
                // Process and update the database based on the modified CSV data
                // (You may need to adjust this part based on your specific use case)
                $productId = $row[0];
                $inventry =  MasterStockInventery::where('store_id', auth()->user()->store_id)
                ->where('product_id', $productId)
                ->where('publisher_id', $row[1])               
                ->first();
    
                if (!empty($inventry)) {
                    $inventry->update([
                        'qty' => $row[5],
                        'purchase_price' => $row[4],
                        'sale_price' => $row[4],
                    ]);
                } else {
                    MasterStockInventery::create([
                        'product_id' => $productId,
                        'store_id' => loginStore()->id,
                        'qty' => $row[5],
                        'purchase_price' => $row[4],
                        'sale_price' => $row[4],
                        'supplier_price' => $row[4],
                        'discount_amount' =>  0,
                    ]);
                }
            }
            $offset += $limit;

            // Fetch the next set of records
            $stmt = (new Statement())->offset($offset)->limit($limit);
            $records = $stmt->process($reader)->fetchAssoc($headers);
        } // end of while
    
            // Redirect back or show a success message
            return redirect()->back()->with('success', 'CSV file uploaded and data updated successfully.');
        }
    } */
}
