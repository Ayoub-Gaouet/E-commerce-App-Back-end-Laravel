<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'users_id',
        'city',
        'street',
        'lat',
        'long',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
