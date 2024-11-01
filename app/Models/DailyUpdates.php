<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyUpdates extends Model
{
    use HasFactory;

    protected $fillable=[
        'provider_id',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function media()
    {
        return $this->hasMany(DailyUpdatesMedia::class, 'daily_updates_id', 'id');
    }

    public function provider()
    {
        return $this->hasOne(DaycareProvider::class, 'id', 'provider_id');
    }

}
