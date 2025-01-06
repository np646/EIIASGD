<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function apiIndex()
    {
        // role_user.user_id is returned as 'id' to update the user, this is because SettingsDatatable expects
        // the id to be updated as 'id'

        $users = DB::table('role_user')
            ->join('users', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select(
                DB::raw('MIN(role_user.id) AS role_user_id'),
                'role_user.user_id AS id',
                'users.email',
                DB::raw('GROUP_CONCAT(roles.name ORDER BY role_user.role_id ASC) AS role'),
                DB::raw('GROUP_CONCAT(role_user.role_id ORDER BY role_user.role_id ASC) AS role_ids'),
                'users.name AS name'
            )
            ->groupBy('role_user.user_id', 'users.email', 'users.name')
            ->get();

        return response()->json($users);
    }
    public function store(Request $request)
    {
        $userController = new UserController();
        $userController->store($request);
        $user_id = $userController->getLastId();

        $roles = $request['roles'];

        foreach ($roles as $role) {
            DB::table('role_user')->insert([
                'user_id' => $user_id,
                'role_id' => $role,
            ]);
        }

        $lastInserted = $this->getLastInserted();
        return response()->json($lastInserted, 201);
    }

    public function fetchById($id)
    {
        $user = DB::table('role_user')
            ->join('users', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select(
                'role_user.user_id',
                'users.email',
                DB::raw('GROUP_CONCAT(roles.name ORDER BY role_user.role_id ASC) AS role'),
                DB::raw('GROUP_CONCAT(role_user.role_id ORDER BY role_user.role_id ASC) AS role_ids'),
                'users.name AS name'
            )
            ->where('role_user.user_id', $id)
            ->groupBy('role_user.user_id', 'users.email', 'users.name')
            ->first();

        return $user;
    }

    public function getLastInserted()
    {
        $lastRoleUser = DB::table('role_user')->latest('id')->first();
        if (!$lastRoleUser) {
            return null;
        }
        return DB::table('role_user')
            ->join('users', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select(
                'role_user.user_id',
                'users.email',
                DB::raw('GROUP_CONCAT(roles.name ORDER BY role_user.role_id ASC) AS role'),
                DB::raw('GROUP_CONCAT(role_user.role_id ORDER BY role_user.role_id ASC) AS role_ids'),
                'users.name AS name'
            )
            ->where('role_user.user_id', $lastRoleUser->user_id)
            ->groupBy('role_user.user_id', 'users.email')
            ->first();
    }

    public function update(Request $request, User $role_user)
    {
        $userController = new UserController();
        $id = $role_user->id;

        $user = $userController->fetchById($id);
        $userController->update($request, $user);

        $roles = $request['roles'];

        DB::table('role_user')
            ->where('user_id', $role_user->id)
            ->delete();

        foreach ($roles as $role) {
            DB::table('role_user')->insert([
                'user_id' => $role_user->id,
                'role_id' => $role,
            ]);
        }
        $users = $this->fetchById($role_user->id);
        return response()->json($users);
    }
}
