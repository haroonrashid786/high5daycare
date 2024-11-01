<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'infant',
        'toddler',
        'pre_school',
        'ministry_rate',
        'spots_allowed_to_provider',
        'thrc_num',
        'ministry_rate_infant',
        'ministry_rate_toddler',
        'ministry_rate_pre_school',
        'infants_allowed_to_provider',
        'toddlers_allowed_to_provider',
        'pre_schoolers_allowed_to_provider',
        'parent_contract',
        'provider_contract',
        'parent_guide',
        'show_parents_survey','show_providers_survey',
    ];
}
