<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayCarePaymentItem extends Model
{
    use HasFactory;

    protected $fillable = [
       'payment_id',
       'kid_id',
       'kid_age',
       'no_of_days',
       'rate',
       'amount',
       'first_fortnight',
       'second_fortnight'
    ];


    public function payment()
    {
        return $this->belongsTo(DayCarePayment::class, 'payment_id');
    }

    public function kid()
    {
        return $this->belongsTo(Kid::class, 'kid_id');
    }
}
