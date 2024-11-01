<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NapTime extends Model
{
    use HasFactory;
    protected $fillable=[
        'provider_id',
        'kid_id',
        'date',
        'sleeping_time',
        'awaking_time',
        'checking_time',
        'note',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function kid()
    {
        return $this->hasOne(Kid::class, 'id', 'kid_id')->select('id', 'full_name');
    }

    public function provider()
    {
        return $this->hasOne(DaycareProvider::class, 'id', 'provider_id')->select('id', 'name');
    }
}
