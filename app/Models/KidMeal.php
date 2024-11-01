<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidMeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'meal',
        'kid_id',
        'provider_id',
        'end_date',
    ];
    
    protected $casts = [
        'date' => 'date',
        'end_date' => 'date',
    ];

    public function kid()
    {
        return $this->hasOne(Kid::class, 'id', 'kid_id');
    }

    public function provider()
    {
        return $this->hasOne(DaycareProvider::class, 'id', 'provider_id');
    }

    public function items()
    {
        return $this->hasMany(KidMealItem::class, 'kid_meal_id', 'id');
    }

}
