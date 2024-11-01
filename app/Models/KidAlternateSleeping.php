<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidAlternateSleeping extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_name',
        'child_name',
        'date_of_birth',
        'sleeping_problems',
        'sleeping_problem_type',
        'night_sleep_duration',
        'day_sleep_pattern',
        'sleeping_position',
        'special_ways_to_sleep',
        'cries_before_sleep',
        'cries_after_waking_up',
        'sleeps_in_own_room',
        'sleeps_in_own_crib_bed',
        'special_toys_blanket',
        'consent_to_sleep_on_cot',
        'consent_to_sleep_on_playpen',
        'consent_to_sleep_on_provider_bed',
        'consent_to_sleep_on_couch',
        'consent_to_sleep_on_other',
        'parent_signature',
        'awaking_time',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }


}
