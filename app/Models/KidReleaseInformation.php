<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidReleaseInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_name',
        'name',
        'home_address',
        'relationship',
        'place_of_work',
        'work_address',
        'cell_number',
        'phone_number',
        'work_number',
        'special_instructions',
        'authorization_name',
        'authorization_relationship',
        'authorization_signature',
        'authorization_date',

        'name_2',
        'home_address_2',
        'relationship_2',
        'place_of_work_2',
        'work_address_2',
        'cell_number_2',
        'phone_number_2',
        'work_number_2',

        'name_3',
        'home_address_3',
        'relationship_3',
        'place_of_work_3',
        'work_address_3',
        'cell_number_3',
        'phone_number_3',
        'work_number_3',
    ];

    protected $casts = [
        'authorization_date' => 'date'
    ];


    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }


}
