<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'name_ar',
        'image'
    ];
    protected $appends = ['image_path'];
    public function getImagePathAttribute()
    {
        return asset('category_images/' . $this->image);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
