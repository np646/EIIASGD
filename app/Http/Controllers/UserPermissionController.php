<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $permissions = $user->roles->flatMap->permissions->pluck('name')->unique();
        return response()->json($permissions);
    }
}
