<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;

class HomeController extends Controller
{
    public function getAllData()
    {
        $response["status"] = "success";
        $response['categories'] = Category::all();
        $response['items'] = Item::with('category')->get(); // Include the category information for each item
        return response()->json($response, 200);
    }
}
