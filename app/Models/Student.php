<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'lastname', 
        'date_of_birth',
        'identification',
        'email',
        'banner_code',
        'sex',
        'course_id',
        'academic_period_start_id',
        'status',
    ];

}
