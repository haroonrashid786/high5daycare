<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidPhotoPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'kid_id',
        'parent_name',
        'child_name',
        'date_of_birth',
        'guardian_name',
        'consent_given',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }


}
