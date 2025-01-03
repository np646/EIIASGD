<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Student extends Model
{
    use Searchable;
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

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'lastname' => $this->lastname,
            'identification' => $this->identification,
            'banner_code' => $this->banner_code,
        ];
    }

}
