<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $fillable = [
        'name',
        'name_ar',
        'description',
        'description_ar',
        'image',
        'count',
        'active',
        'price',
        'discount',
        'category_id'
    ];
    protected $appends = ['image_path'];
    public function getImagePathAttribute()
    {
        return asset('item_images/' . $this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
