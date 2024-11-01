<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitySuggesstion extends Model
{
    use HasFactory;

    protected $fillable = [
       'date',
       'file',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
