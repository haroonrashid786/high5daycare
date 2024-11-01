<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderAbout extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'provider_id',
        'family_members',
        'family_members_below_18',
        'family_members_above_18',
        'courses',
        'about_me',
    ];
    

    public function familyMembers()
    {
        return $this->hasMany(ProviderFamilyMember::class, 'provider_about_id', 'id');
    }
}
