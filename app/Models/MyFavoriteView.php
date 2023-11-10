<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyFavoriteView extends Model
{
    protected $table = 'myfavorite';
    protected $primaryKey = 'favorite_id';

    protected $fillable = [
        'favorite_id',
        'favorite_users_id',
        'favorite_items_id',
        'favorite_created_at',
        'favorite_updated_at',
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
        'users_id',
    ];
}
