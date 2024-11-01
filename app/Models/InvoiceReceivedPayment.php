<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceReceivedPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'kid_id',
        'amount',    
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];
    
}
