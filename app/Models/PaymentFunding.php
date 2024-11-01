<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentFunding extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'name',
        'amount',
    ];
}
