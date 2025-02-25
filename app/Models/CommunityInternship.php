<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityInternship extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'academic_period_id',
        'project_id',
        'student_report_id', 
        'status',
    ];
}
