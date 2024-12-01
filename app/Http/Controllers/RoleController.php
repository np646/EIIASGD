<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::where('status', 1)->get();
        return Inertia::render('Settings/Roles/Index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return Inertia::render('Settings/Roles/Create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $role = Role::create($request->all());
        return response()->json($role, 201);
    }

    public function edit(Role $role)
    {
        return Inertia::render('Settings/Roles/Edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $role->update($request->all());
        return response()->json($role);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(null, 204);
    }

    public function remove(Request $request, Role $role)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        $role->update($request->only('status'));
        return redirect()->route('roles.index');
    }

    public function fetch()
    {
        $roles = Role::where('status', 1)->get();
        return response()->json($roles);
    }

    public function apiIndex()
    {
        return response()->json(Role::all());
    }
}
