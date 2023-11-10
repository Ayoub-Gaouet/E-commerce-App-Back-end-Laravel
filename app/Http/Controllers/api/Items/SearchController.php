<?php

namespace App\Http\Controllers\api\Items;

use App\Http\Controllers\Controller;
use App\Models\ItemView;

class SearchController extends Controller
{
    public function Search($name)
    {
        $items = ItemView::where('item_name', 'like', '%' . $name . '%')
            ->orWhere('item_name_ar', 'like', '%' . $name . '%')
            ->get();
        if ($items->isEmpty()) {
            return response()->json(['status' => 'noData', 'message' => 'No items found'], 200); // Change the HTTP status code to 200
        }
        return response()->json(['status' => 'success', 'data' => $items], 200);
    }
}
