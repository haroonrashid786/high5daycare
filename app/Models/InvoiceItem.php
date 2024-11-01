<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
       'invoice_id',
       'kid_id',
       'kid_age',
       'presence_count',
       'rate',
       'amount',
       'ministry_share',
       'kid_total',
       'balance',
       'subsidized_days',
       'non_subsidized_days',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function kid()
    {
        return $this->belongsTo(Kid::class, 'kid_id');
    }

}
