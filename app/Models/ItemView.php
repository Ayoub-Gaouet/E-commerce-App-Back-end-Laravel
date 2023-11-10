<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemView extends Model
{
    protected $table = 'itemsview'; // Replace with the actual view name

    protected $primaryKey = null; // Views don't have primary keys
    public $incrementing = false;

    protected $fillable = [
        'item_id', 'item_name', 'item_name_ar', 'item_description', 'item_description_ar',
        'item_image', 'item_count', 'item_active', 'item_price', 'item_discount', 'item_category_id',
        'item_created_at', 'item_updated_at', 'category_id', 'category_name', 'category_name_ar',
        'category_image', 'category_created_at', 'category_updated_at',
    ];

}
