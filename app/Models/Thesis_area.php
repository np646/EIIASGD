<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis_area extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'area',
        'status', //check if this one is right
    ];
}
