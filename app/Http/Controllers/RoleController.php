<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::where('status', 1)->get();
        return Inertia::render('Roles/Index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return Inertia::render('Roles/Create');
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $data = [
            'name' => $params['name'],
            'status' => $params['status']
        ];
        Role::create($data);
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        return Inertia::render('Roles/Edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index');
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
}
