<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidMedicationConsent extends Model
{
    use HasFactory;

    protected $fillable = [
        'kid_id',
        'child_name',
        'address',
        'physician_name',
        'phone_number',
        'medication_name',
        'medication_prescribed_date',
        'start_date',
        'end_date',
        'dosage',
        'parent_times_given',
        'provider_times_given',
        'provider_amount_given',
        'storage_instructions',
        'side_effects',
        'parent_signature',
    ];


    protected $casts = [
        'medication_prescribed_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }
    
    public function dispensingRecords()
    {
        return $this->hasMany(DispensingRecord::class);
    }

}
