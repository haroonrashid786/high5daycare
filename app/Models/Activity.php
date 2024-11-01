<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
       'activity_sheet_id',
       'activity_type',
       'monday_activities',
       'tuesday_activities',
       'wednesday_activities',
       'thursday_activities',
       'friday_activities',
       'saturday_activities',
       'sunday_activities',
       'activities_adjustment',
    ];

}
