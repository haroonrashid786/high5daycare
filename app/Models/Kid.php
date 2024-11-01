<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kid extends Model
{
    use HasFactory;
   
    protected $fillable=[
        'provider_id',
        'parent_id',
        'full_name',
        'age',
        'contact_number',
        'profile_picture',
        'allergies',
        'dob',
        'photo_permission',
        'subsidy_eligibility',
        'school_start',
        'contract_start',
        'contract_end',
        'comments',
        'status',
        'is_subsidized',
        'subsidized_from',
        'subsidized_to',
        'subsidized_percentage',
        'code',
        'incident',
        'is_part_time',
        'selected_days',
        'subsidized_certificate',
        'registeration_fee',
        'advance_payment',
        'father_name',
        'mother_name',
    ];

    protected $casts = [
        'school_start' => 'date',
        'contract_start' => 'date',
        'contract_end' => 'date',
    ];

    public function provider()
    {
        return $this->hasOne(DaycareProvider::class, 'id', 'provider_id');
    }

    public function parent()
    {
        return $this->hasOne(Parents::class, 'id', 'parent_id');
    }

        public function emergencyInformation()
    {
        return $this->hasOne(KidEmergencyInformation::class);
    }

    public function supervision()
    {
        return $this->hasOne(KidSupervision::class);
    }

    public function releaseInformation()
    {
        return $this->hasOne(KidReleaseInformation::class);
    }

    public function photoPermission()
    {
        return $this->hasOne(KidPhotoPermission::class);
    }

    public function alternateSleeping()
    {
        return $this->hasOne(KidAlternateSleeping::class);
    }

    public function drugInformation()
    {
        return $this->hasMany(KidDrugInformation::class);
    }
    
    public function medicationConsent()
    {
        return $this->hasOne(KidMedicationConsent::class);
    }

    public function anaphylacticEmergency()
    {
        return $this->hasOne(KidAnaphylacticEmergency::class);
    }

    public function individualPlan()
    {
        return $this->hasOne(KidIndividualPlan::class);
    }

    public function enrollementForm()
    {
        return $this->hasOne(KidEnrollmentForm::class);
    }

    public function contract()
    {
        return $this->hasOne(KidContract::class);
    }

    public function immunizationRecord()
    {
        return $this->hasOne(KidImmunization::class);
    }

    public function activitySheet()
    {
        return $this->hasOne(ActivitySheet::class, 'kid_id', 'id')->latest()->select('id','kid_id','file');
    }

    public function meals()
    {
        return $this->hasMany(KidMeal::class, 'kid_id', 'id');
    }

    
    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class, 'kid_id', 'id');
    }

    public function accidentReports()
    {
        return $this->hasMany(KidAccidentReport::class, 'kid_id', 'id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'kid_id', 'id');
    }
    
    public function subsidizedCertificates()
    {
        return $this->hasMany(SubsidizedCertificate::class);
    }
}
