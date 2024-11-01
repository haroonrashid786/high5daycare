<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'parent_id',
        'invoice_number',
        'total_presence',
        'total',
        'ministry_amount',
        'grand_total',
        'status',
        'modified_description',
        'modified_amount',
        'registeration_fee',
        'advance_payment',
        'net_amount',
        'kid_id',
        'previous_balance',
        'balance',
        'added_ministry_fund_type',
        'added_ministry_fund_amount',
        'subsidary_amount',
        'date',
        'security_deposit'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function parent()
    {
        return $this->belongsTo(Parents::class, 'parent_id');
    }

    public function provider()
    {
        return $this->belongsTo(DaycareProvider::class, 'provider_id');
    }

    public function invoiceItems()
    {
        return $this->hasOne(InvoiceItem::class, 'invoice_id', 'id');
    }

    public function invoiceData()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id', 'id');
    }

    public function kid()
    {
        return $this->belongsTo(Kid::class, 'kid_id');
    }

    public function funds()
    {
        return $this->hasMany(InvoiceFund::class, 'invoice_id', 'id');
    }
}
