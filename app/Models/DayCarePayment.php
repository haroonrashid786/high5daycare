<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayCarePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'payment_number',
        'total_no_of_days',
        'total',
        'balance',
        'status',
        'modified_description',
        'modified_amount',
        'previous_balance',
        'net_amount',
        'added_ministry_fund_type',
        'added_ministry_fund_amount',
        'hceg_fund',
        'gog_fund',
        'provider_presence',
        'date'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function provider()
    {
        return $this->belongsTo(DaycareProvider::class, 'provider_id');
    }

    public function paymentItems()
    {
        return $this->hasMany(DayCarePaymentItem::class, 'payment_id', 'id');
    }

    public function funds()
    {
        return $this->hasMany(PaymentFunding::class, 'payment_id', 'id');
    }
}
