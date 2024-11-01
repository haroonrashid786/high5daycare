<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayCareVacation extends Model
{
    use HasFactory;

    protected $fillable = [
    'provider_id',
    'start_date',
    'end_date',
    'status',
    'alternate_provider_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function provider()
    {
        return $this->hasOne(DaycareProvider::class, 'id', 'provider_id');
    }

    public function alternateProvider()
    {
        return $this->hasOne(DaycareProvider::class, 'id', 'alternate_provider_id');
    }
    
}
