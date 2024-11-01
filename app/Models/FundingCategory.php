<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundingCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'type',
    ];
    
}
