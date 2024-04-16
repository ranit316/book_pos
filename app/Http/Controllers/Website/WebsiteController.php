<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Publisher;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function booklist()
    {
        $data = Product::with('bookpublisher.publisher', 'bookcategory')->where('status', 'active')->get();
        $baseURL = request()->root();
        if (!empty($data)) {
            foreach ($data as $item) {
                $item->image = $baseURL . $item->image;
            }
        }

        return response()->json(responseData($data, "get all active book data"));
    }

    public function publisherlist()
    {
        $data = User::with('publisher')->where('type', 'publisher')->where('status', 'active')->get();
        $baseURL = request()->root();        
        if(!empty($data->publisher))
        {
            foreach($data->publisher as $item)
            $item->logo_image = $baseURL . $item->logo_image;
        }
        return response()->json(responseData($data, "get all publisher data"));
    }

    public function categorylist()
    {
        $data = Category::where('status', 'active')->get();
        return response()->json(responseData($data, "get all category data"));
    }

    public function storelist()
    {
        $data = Store::where('status', 'active')->get();
        $baseURL = request()->root();
        if(!empty($data))
        {
            foreach($data as $item)
            $item->logo_image = $baseURL . $item->logo_image;
            $item->signature = $baseURL . $item->signature;
        }

        return response()->json(responseData($data, "get all store data"));
    }
}
