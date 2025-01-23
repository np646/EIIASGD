<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);

        $name = $request->input('identifier');
        $password = $request->input('password');

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode('admin:65pT8HE9T4kQ'),
            'Content-Type' => 'application/json',
        ])->post('https://api.pucesi.edu.ec/Web-Services/api/auth', [
            'usuario' => $name,
            'password' => $password,
        ]);

        if ($response->successful() && $response->json('value') === true) {
            $user = User::where('name', $name)->first();

            if ($user && $user->status === 1) {

                Auth::login($user);
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->withErrors(['identifier' => 'Usuario no registrado.']);
            }
        } else {
            return redirect()->back()->withErrors(['password' => 'Credenciales no válidas.']);
        }
    }
}
