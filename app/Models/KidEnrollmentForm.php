<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidEnrollmentForm extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }
}
