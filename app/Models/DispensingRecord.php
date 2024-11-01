<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispensingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'kid_medication_consent_id',
        'date',
        'item_given',
        'dosage',
        'signature',
        'observations',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function kidMedicationConsent()
    {
        return $this->belongsTo(KidMedicationConsent::class);
    }
    
}
