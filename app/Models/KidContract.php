<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidContract extends Model
{
    use HasFactory;

    protected $fillable = [
       'kid_id',
       'contract_type',
       'parent_name',
       'parent_signature',
       'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    
    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }
    
}
