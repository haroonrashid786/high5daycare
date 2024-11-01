<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidIndividualPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_name',
        'child_home_address',
        'phone',
        'child_care_provider',
        'child_care_address',
        'child_care_phone',
        'emergency_contact_name',
        'emergency_contact_phone_work',
        'emergency_contact_phone_cell',
        'emergency_contact_phone_home',
        'observed_requirements',
        'call_parent_guardian',
        'parent_guardian_name',
        'parent_guardian_phone_work',
        'parent_guardian_phone_cell',
        'parent_guardian_phone_home',
        'call_911',
        'call_doctor',
        'doctor_name',
        'doctor_phone',
        'medication_name',
        'dose',
        'signature',
        'date',
        'medical_condition',
        'symptoms',
        'acute',
        'chronic',
        'triggers',
        'other_information',
        'daily_modification',
        'medical_devices',
        'support',
        'evacuation_procedure',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    
    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }

    

}
