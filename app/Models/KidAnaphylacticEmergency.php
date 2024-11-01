<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidAnaphylacticEmergency extends Model
{
    use HasFactory;

    protected $fillable = [
        'kid_id',
        'child_name',
        'photo',
        'peanuts',
        'tree_nuts',
        'eggs',
        'milk',
        'insect_stings',
        'latex',
        'medications',
        'others',
        'epipen_jr',
        'epipen',
        'twinjet_015mg',
        'twinjet_030mg',
        'location_of_auto_injectors',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_home_phone',
        'emergency_contact_cell_phone',
        'emergency_contact_work_phone',
        'emergency_contact_name_2',
        'emergency_contact_relationship_2',
        'emergency_contact_home_phone_2',
        'emergency_contact_cell_phone_2',
        'emergency_contact_work_phone_2',
        'parent_signature',
    ];

    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }

}
