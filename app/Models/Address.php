<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'place',
        'address',
        'province_id',
        'province_name',
        'city_id',
        'city_name',
        'postal_code',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
