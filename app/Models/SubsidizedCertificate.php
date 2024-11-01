<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsidizedCertificate extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'kid_id',
        'certificate_file_path',
    ]; 
}
