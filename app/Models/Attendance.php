<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable=[
        'provider_id',
        'date',
        'file',
        'kid_id',
        'present',
        'drop_time',
        'pickup_time',
    ];

    protected $casts = [
        'date' => 'date',
    ];
    
    public function provider()
    {
        return $this->hasOne(DaycareProvider::class, 'id', 'provider_id')->select('id', 'name');
    }

    public function kid()
    {
        return $this->hasOne(Kid::class, 'id', 'kid_id')->select('id', 'full_name');
    }

}
