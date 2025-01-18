<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreprofessionalInternship extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'academic_period_id',
        'external_cert_id',
        'student_report_id', 
        'banner_cert_id',
        'status',
    ];
}
