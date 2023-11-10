<?php

namespace App\Http\Controllers\api\Favorite;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\MyFavoriteView;

class FavoriteController extends Controller
{
    public function addFavorite( $usersId, $itemsId){
        $favorite = new Favorite();
        $favorite->users_id = $usersId;
        $favorite->items_id = $itemsId;
        $favorite->save();
            return response()->json(['status' => 'success', 'data' => $favorite], 200);
    }
    public function deleteFavorite( $usersId, $itemsId){
        $favorite = Favorite::where('users_id', $usersId)->where('items_id', $itemsId)->first();
        $favorite->delete();
        return response()->json(['status' => 'success', 'data' => $favorite], 200);
    }
    public function getFavorite($usersId){
        $favorite = MyFavoriteView::where('favorite_users_id', $usersId)->get();
        return response()->json(['status' => 'success', 'data' => $favorite], 200);
    }
    public function deletefromfavroite ($favoriteId){
        $favorite = Favorite::find($favoriteId);
        $favorite->delete();
        return response()->json(['status' => 'success'], 200);
    }
}
