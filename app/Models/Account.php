<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_id',
        'bank_name',
        'name',
        'number'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
