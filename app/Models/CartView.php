<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartView extends Model
{
    // Define the table associated with this model
    protected $table = 'cartview';
    protected $primaryKey = null; // Views don't have primary keys
    public $timestamps = false;
    // Define the fields that are fillable
    protected $fillable = [
        'itemsprice',
        'countitems',
        'cart_id',
        'cart_users_id',
        'cart_items_id',
        'cart_created_at',
        'cart_updated_at',
        'id',
        'name',
        'name_ar',
        'description',
        'description_ar',
        'image',
        'count',
        'active',
        'price',
        'discount',
        'category_id',
        'created_at',
        'updated_at',
    ];
}
