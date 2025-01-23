<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;


class UserController extends Controller
{
    public function index()
    {
        $roleController = new RoleController();
        $roles = $roleController->fetch();
        return Inertia::render('Settings/Users/Index', [
            'roles' => $roles
        ]);
    }

    public function apiIndex()
    {
        return response()->json(User::get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create($request->all());
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function remove($id)
    {
        $user = User::findOrFail($id);
        $user->status = 0;
        $user->save();
        return response()->json(null, 204);
    }

    public function getLastId()
    {
        $userId = User::latest()->pluck('id')->first();
        return $userId;
    }

    public function fetchById($id)
    {
        $user = User::where('id', $id)->first();
        return $user;
    }

    public function fetchByName($name)
    {
        $user = User::where('name', $name)->first();
        return $user;
    }

    public function updateStatus($name)
    {
        $user = $this->fetchByName($name);
        if ($user && $user->status == 0) {
            $user->status = 1;
            $user->save();
        }
    }
}
