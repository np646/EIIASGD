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
        return response()->json(User::where('status', 1)->get());
    }

    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create($request->all());
        //return response()->json($user, 201);
        return $user;
    }

    public function update(Request $request, User $user)
    {
        /*$validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }*/

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
        $student = User::findOrFail($id);
        $student->update(['status' => 0]);
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
}
