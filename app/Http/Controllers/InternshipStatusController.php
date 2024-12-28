<?php

namespace App\Http\Controllers;

use App\Models\InternshipStatus;
use Illuminate\Http\Request;

class InternshipStatusController extends Controller
{
    public function fetch()
    {
        $statuses = InternshipStatus::get();
        return $statuses;
    }
}
