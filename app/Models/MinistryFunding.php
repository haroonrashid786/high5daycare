<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinistryFunding extends Model
{
    use HasFactory;

    protected $fillablem = [
        'category',
        'amount',
        'balance',
        'status',
        'from',
        'to',
        'type',
        'funding_category_id',
        'date',
    ];

    protected $casts = [
        'from' => 'date',
        'to' => 'date',
        'date' => 'date',
    ];

    public function fundingCategory()
    {
        return $this->hasOne(FundingCategory::class, 'id', 'funding_category_id');
    }

}
