<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Edition;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class EditionController extends Controller
{
    public $page = "Book";

    public function edition()
    {
        $page = $this->page;
        if(isAdmin()){
            $suppliers = User::with('publisher')->get();
        }else{
            $suppliers = User::with('publisher')->where('id',auth()->user()->id)->get();
        }
        
        return view('admin.v1.product.edition', compact('page', 'suppliers'));
    }

    public function book_details($id)
    {
        $data = Product::select('id', 'title')->where('supplier_id', $id)->get();

        return $data;
    }

    public function bookget($id)
    {
        $data = Product::with('bookcategory', 'unit')->where('id', $id)->first();
        $author = Author::where('id', $data->author)->first();
        $baseUrl = request()->root();
        $data['baseUrl'] = $baseUrl;
        $data['author'] = $author;

        return $data;
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'type' => 'required',
            //'edition' => '',
        ]);

        if ($validate->fails()) {
            return $validate->errors();
        } else {
            try {
                $name = Product::where('id',$request->title)->first();

                if($request->type == 'reprint')
                {
                    $title = $name->title . "- (RP" . $request->publication_date . ")";
                }else{
                    $title = $name->title . " " . $request->edition . " edition";
                }

                $request->request->add(['created_by' => auth()->user()->id, 'image' => "null", 'title'=>$title, 'master_id' =>$request->title]);


                $request->merge([
                    'status' => 'active',
                    'unit_id' => $name->unit_id,
                    'author' => $name->author,
                    'category_id' => $name->category_id,
                ]);

                // if (isPublisher()) {
                // $request['supplier_id'] = auth()->user()->id;
                // }else{
                $data = Product::create($request->except('_token'));
                
                $edition = Edition::create([
                    'type' => $request->type,
                    'product_id' =>$data->id,
                    'remarks' => $request->description,
                    'master_id' => $name->id,
                ]);
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
}
