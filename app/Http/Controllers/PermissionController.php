<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::where('status', 1)->get();
        return Inertia::render('Settings/Permissions/Index', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return Inertia::render('Settings/Permissions/Create');
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

        $permission = Permission::create($request->all());
        return response()->json($permission, 201);
    }

    public function edit(Permission $permission)
    {
        return Inertia::render('Settings/Permissions/Edit', [
            'permission' => $permission
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $permission->update($request->all());
        return response()->json($permission);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->json(null, 204);
    }

    public function remove(Request $request, Permission $permission)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        $permission->update($request->only('status'));
        return redirect()->route('permissions.index');
    }

    public function fetch()
    {
        $permissions = Permission::where('status', 1)->get();
        return response()->json($permissions);
    }
    public function apiIndex()
    {
        return response()->json(Permission::all());
    }
}
