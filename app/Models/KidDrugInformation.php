<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidDrugInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'drug_id',
        'drug_name',
        'allowed',
        'brand',
        'comments',
        'parent_signature',
       'parent_name','child_name','dob',
    ];

    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }

    public function drug()
    {
        return $this->hasOne(Drug::class);
    }

}
