<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyUpdatesMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'daily_updates_id',
            'file'
    ];
}
