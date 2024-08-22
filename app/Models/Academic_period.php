<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic_period extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'period',
        'year',
        'status',
    ];
}
