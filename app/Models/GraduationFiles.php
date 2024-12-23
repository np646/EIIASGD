<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduationFiles extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'international_cert_id', 
        'english_cert_id',
        'community_internship_id',
        'preprofessional_internship_id',
        'graduation_type_id',
        'readers_id',
        'plan_approval_id',
        'status',
    ];
}
