<?php

namespace App\Http\Controllers\api\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartView;

class CartController extends Controller
{
    public function addCart($usersId, $itemsId){
        $cart = Cart::create([
            'users_id' => $usersId,
            'items_id' => $itemsId
        ]);
        return response()->json([
            'message' => 'Item added to cart',
            'status' => 200
        ], 200);

    }
    function removeCart($usersId, $itemsId){
        $cart = Cart::where('users_id', $usersId)->where('items_id', $itemsId)->limit(1)->first();
        //remove item from cart
        $cart->delete();
        return response()->json(['status' => 'success' , 'data'=> $cart], 200);
    }
    function getCount($usersId, $itemsId) {
        $count = Cart::where('users_id', $usersId)
            ->where('items_id', $itemsId)
            ->count();
        if ($count > 0){
            return response()->json(['status' => 'success', 'data' => $count], 200);
        }else{
            return response()->json(['status' => 'success', 'data' => 0], 200);
        }
    }
    public function getAllData($usersId) {
        $cartItems = CartView::where('cart_users_id', $usersId)->get();
        $totalPrice = 0;
        $totalCount = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->itemsprice * $item->countitems;
            $totalCount += $item->countitems;
        }
        return response()->json(['status' => 'success', 'data' => $cartItems, 'countprise' => ['totalprice' => $totalPrice, 'totalcount' => $totalCount]], 200);
    }
}
