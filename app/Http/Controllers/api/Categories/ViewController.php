<?php

namespace App\Http\Controllers\api\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;

class ViewController extends Controller
{
    public function getAllData()
    {
        $categories = Category::all();

        // Vérifiez s'il n'y a pas de catégories
        if (count($categories) == 0) {
            return response()->json(['status' => 'error', 'message' => 'There are no categories'], 404);
        }

        // Modifiez les chemins des images pour qu'ils soient des liens complets
        foreach ($categories as $category) {
            $category->image = asset($category->image);
        }

        return response()->json(['status' => 'success', 'data' => $categories], 200);
    }
}
