<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorite';
    protected $fillable = [
        'users_id',
        'items_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'items_id');
    }
}
