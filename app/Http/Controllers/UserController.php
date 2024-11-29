<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return Inertia::render('Users/Index', [
            'users' => $users
        ]);
    }

    public function apiIndex()
    {
        return response()->json(User::all());
    }
    public function fetch()
    {
        $users = User::get();
        return response()->json($users);
    }

    public function create()
    {
        $userController = new UserController();
        $users = $userController->fetch();
        return Inertia::render('Users/Create', [
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $data = [
            'name' => $params['name'],
            'email' => $params['lastname'],
            'status' => $params['status']
        ];
        User::create($data);
        return redirect()->route('users.index');
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    public function remove(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        $user->update($request->only('status'));
        return redirect()->route('users.index');
    }

}
