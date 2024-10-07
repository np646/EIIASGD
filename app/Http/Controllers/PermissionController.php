<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::where('status', 1)->get();
        return Inertia::render('Permissions/Index', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return Inertia::render('Permissions/Create');
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $data = [
            'name' => $params['name'],
            'status' => $params['status']
        ];
        Permission::create($data);
        return redirect()->route('permissions.index');
    }

    public function edit(Permission $permission)
    {
        return Inertia::render('Permissions/Edit', [
            'permission' => $permission
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update($request->all());
        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index');
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
}
