<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    protected $fillable =[
        'daycare_provider_id',
        'user_id',
        'code',
        'name',
        'phone_number',
        'email',
        'address',
        'city',
        'country',
        'state',
        'display_picture',
        'status',
        'photo_id_front',
        'photo_id_back',
        'contract_signature',
        'contract_signature_date',
    ];

    protected $casts = [
        'contract_signature_date' => 'date',
    ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(DaycareProvider::class,'daycare_provider_id');
    }

    public function kids()
    {
        return $this->hasMany(Kid::class,'parent_id','id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'parent_id', 'id');
    }

    public function getTotalDocumentsAttribute()
    {
        return $this->kids->sum(function ($kid) {
            if ($kid->status == 1) {
            return 11;
            }else{
                return 0;
            }
        });
    }

    public function getFilledDocumentsAttribute()
    {
        return $this->kids->sum(function ($kid) {
            if ($kid->status == 1) {   
             return $kid->emergencyInformation()->count() +
                $kid->supervision()->count() +
                $kid->releaseInformation()->count() +
                $kid->photoPermission()->count() +
                $kid->alternateSleeping()->count() +
                $kid->drugInformation()->count() +
                $kid->medicationConsent()->count() +
                $kid->individualPlan()->count() +
                $kid->contract()->count() +
                $kid->immunizationRecord()->count() +
                $kid->anaphylacticEmergency()->count();
            } else {
                return 0;
            }
        });
    }
}
