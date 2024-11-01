<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidSupervision extends Model
{
    use HasFactory;

    protected $fillable = [
        'transportation_method',
        'vehicle_model',
        'vehicle_year',
        'vehicle_color',
        'other_details',
        'location_name',
        'location_address',
        'means_of_transport',
        'child_care_provider_sign',
        'child_care_provider_sign_date',
        'parent_guardian_sign',
        'parent_guardian_sign_date',
        'child_name',
        'child_provider_name',
        'child_provider_address',
        'location_name_2' ,
        'location_address_2' ,
        'means_of_transport_2' ,
        'location_name_3' ,
        'location_address_3' ,
        'means_of_transport_3' ,
        'location_name_4' ,
        'location_address_4' ,
        'means_of_transport_4' ,
        'location_name_5' ,
        'location_address_5' ,
        'means_of_transport_5' ,
        'location_name_6' ,
        'location_address_6' ,
        'means_of_transport_6' ,
    ];

    protected $casts = [
        'child_care_provider_sign_date' => 'date',
        'parent_guardian_sign_date' => 'date',
    ];

    
}
