<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'amount',    
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
