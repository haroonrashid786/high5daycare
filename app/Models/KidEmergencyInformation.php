<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidEmergencyInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'kid_id',
        'doctor_name',
        'doctor_address',
        'medical_center',
        'doctor_phone',
        'emergency_contact_surname',
        'emergency_contact_first_name',
        'emergency_contact_address',
        'emergency_contact_relationship',
        'health_card_number',
        'health_card_dob',
        'allergies',
        'health_conditions',
        'parent_signature',
        'parent_signature_date',

        'child_name',
        'emergency_contact_c_no',
        'emergency_contact_p_no',
        'emergency_contact_surname_2',
        'emergency_contact_first_name_2',
        'emergency_contact_address_2',
        'emergency_contact_relationship_2',
        'emergency_contact_c_no_2',
        'emergency_contact_p_no_2',
        'emergency_contact_surname_3',
        'emergency_contact_first_name_3',
        'emergency_contact_address_3',
        'emergency_contact_relationship_3',
        'emergency_contact_c_no_3',
        'emergency_contact_p_no_3',
        'emergency_contact_surname_4',
        'emergency_contact_first_name_4',
        'emergency_contact_address_4',
        'emergency_contact_relationship_4',
        'emergency_contact_c_no_4',
        'emergency_contact_p_no_4',
        'health_card_number_2',
        'health_card_dob_2',
        'allergies_2',
        'health_conditions_2',

    ];


    protected $casts = [
        'health_card_dob' => 'date',
        'parent_signature_date' => 'date',
    ];

    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }

}
