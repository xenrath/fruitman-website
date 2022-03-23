<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'bargian_id',
        'address_id',
        'courier',
        'delivery_service',
        'note',
        'total_transfer',
        'status'
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
