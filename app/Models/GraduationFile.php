<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduationFile extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'international_cert_path', 
        'english_cert_path',
        'community_internship_path',
        'preprofessional_internship_path',
        'graduation_type_path',
        'readers_path',
        'plan_approval_path',
        'status',
    ];
}
