<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderFamilyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_about_id',
        'family_member_name',
        'police_certificate',
        'health_certificate',
    ];
}
