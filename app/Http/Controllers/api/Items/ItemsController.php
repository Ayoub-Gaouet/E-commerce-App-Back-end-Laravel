<?php

namespace App\Http\Controllers\api\Items;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ItemsController extends Controller {
    public function getDataByCategory($id, $userId)
    {
        // Fetch items by category using the where clause
        $items = DB::table('itemsview')
            ->select('itemsview.*', DB::raw('1 as favorite'),
                DB::raw('(itemsview.item_price - (itemsview.item_price * itemsview.item_discount / 100)) as itemspricediscount'))
            ->join('favorite', function ($join) use ($userId) {
                $join->on('favorite.items_id', '=', 'itemsview.item_id')
                    ->where('favorite.users_id', '=', $userId);
            })
            ->where('itemsview.item_category_id', $id)
            ->unionAll(DB::table('itemsview')
                ->select('*', DB::raw('0 as favorite'),
                    DB::raw('(itemsview.item_price - (itemsview.item_price * itemsview.item_discount / 100)) as itemspricediscount'))
                ->whereNotIn('itemsview.item_id', function ($query) use ($userId) {
                    $query->select('itemsview.item_id')
                        ->from('itemsview')
                        ->join('favorite', function ($join) use ($userId) {
                            $join->on('favorite.items_id', '=', 'itemsview.item_id')
                                ->where('favorite.users_id', '=', $userId);
                        });
                })
                ->where('itemsview.item_category_id', $id))
            ->get();


        if ($items->isEmpty()) {
            return response()->json(['status' => 'failure', 'message' => 'No items found for the given category'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $items], 200);
    }
}
