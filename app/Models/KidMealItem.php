<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidMealItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'kid_meal_id',
        'day',
        'morning_snack',
        'lunch',
        'afternoon_snack',
    ];
}
