<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityProject extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'academic_period_id',
        'project_report_id',
        'status',
    ];
}
