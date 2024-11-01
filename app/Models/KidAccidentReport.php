<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidAccidentReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'kid_id',
        'incident_number',
        'accident_date',
        'accident_time',
        'location',
        'observer',
        'nature_of_injury',
        'other_injury',
        'description',
        'first_aid',
        'phone_notified',
        'phone_notified_time',
        'phone_notified_by',
        'voicemail_notified',
        'voicemail_notified_time',
        'voicemail_notified_by',
        'email_notified',
        'email_notified_time',
        'email_notified_by',
        'in_person_notified',
        'in_person_notified_time',
        'in_person_notified_by',
        'report_provided_by',
        'guardian_name',
        'guardian_signature',
        'provider_signature',
        'childcare_provider_name',
        'childcare_provider_address',
        'same_as_provider',
        'filled_by',
        'signature_filled_by',
    ];


    protected $casts = [
        'accident_date' => 'date',
    ];

    public function kid()
    {
        return $this->hasOne(Kid::class, 'id', 'kid_id');
    }

}
