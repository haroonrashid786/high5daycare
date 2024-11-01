<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitySheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'file',
        'provider_id',
        'kid_id',
    ];
    
    protected $casts = [
        'date' => 'date',
    ];


    public function kid()
    {
        return $this->hasOne(Kid::class, 'id', 'kid_id');
    }

    public function provider()
    {
        return $this->hasOne(DaycareProvider::class, 'id', 'provider_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'activity_sheet_id', 'id');
    }
    
}
