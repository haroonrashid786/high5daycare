<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidImmunization extends Model
{
    use HasFactory;

    protected $fillable = [
        'kid_id',
        'file',
    ];
}
