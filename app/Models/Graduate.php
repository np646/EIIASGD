<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduate extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'academic_period_start_id', // PERIODO QUE CURSÓ DISEÑO Y EVALUACIÓN DE PROYECTOS
        'plan_approval_date',
        'graduation_type', //MODALIDAD DE TITULACIÓN
        'thesis_name',
        'thesis_area',
        'advisor_id',
        'academic_period_end_id', // PERIODO QUE CURSÓ INTEGRACIÓN CURRICULAR
        'reader1_id',
        'reader2_id',
        'graduation_date',
        'registration_times', // CANTIDAD DE VECES QUE TOMA INTEGRACIÓN CURRICULAR
        'status',
    ];
}
