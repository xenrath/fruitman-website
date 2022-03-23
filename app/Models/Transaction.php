<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'invoice_number',
        'user_id',
        'product_id',
        'recipient',
        'phone',
        'place',
        'origin',
        'total_item',
        'price',
        'courier',
        'service_type',
        'estimation',
        'cost',
        'note',
        'total_price',
        'proof',
        'status',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getDateAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['date'])->format('d-F-Y');
    }
}
