<?php

namespace App\Http\Controllers;
use App\Models\GraduationStatus;

use Illuminate\Http\Request;

class GraduationStatusController extends Controller
{
    public function fetch()
    {
        $statuses = GraduationStatus::get();
        return $statuses;
    }
}
