<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaycareProvider extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'code',
        'name',
        'phone_number',
        'email',
        'address',
        'city',
        'country',
        'state',
        'logo',
        'license',
        'police_clearance',
        'bank_details',
        'status',
        'postal_code',
        'location_link',
        'thrc_membership_num',
        'program_statement_signature',
        'behavioral_managements_signature',
        'provider_responsibility_signature',
        'health_assessment_certificate',
        'cpr',
        'fire_evacuation_program',
        'fire_inspection_certificate',
        'insurance',
        'contract',
        'food_handler',
        'offence_declaration',
        'notice_of_personal_information_collection',
        'covid_vaccine',
        'sign_of_policies',
        'landlord_approval_letter',
        'pet_vaccination',
        'additional_certification',
        'infant_percentage',
        'toddler_percentage',
        'pre_school_percentage',
        'contract_signature',
        'contract_signature_date',
        'admin_signature',
        'admin_signature_date',
        'ministry_funding',
        'hceg_funding',
        'joining_date'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function dailyUpdates()
{
    return $this->hasMany(DailyUpdates::class, 'provider_id', 'id');
}

public function images()
{
    return $this->hasMany(ProviderImage::class,'provider_id','id');
}

public function lastAttendance()
{
    return $this->hasOne(Attendance::class, 'provider_id', 'id')->latest();
}

public function lastNapMarked()
{
    return $this->hasOne(NapTime::class, 'provider_id', 'id')->latest();
}

public function invoices()
{
    return $this->hasMany(Invoice::class);
}

public function kids()
{
    return $this->hasMany(Kid::class, 'provider_id', 'id');
}

public function aboutMe()
{
    return $this->hasOne(ProviderAbout::class, 'provider_id', 'id');
}

}
