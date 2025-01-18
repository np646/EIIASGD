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
        // Validate the request
        $request->validate([
            'identifier' => 'required|string',  // Username or Email
            'password' => 'required|string',
        ]);

        $name = $request->input('identifier');
        $password = $request->input('password');

        Log::info('Login attempt started.', ['identifier' => $name]);

        // Call the external API to authenticate
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode('admin:65pT8HE9T4kQ'),
            'Content-Type' => 'application/json',
        ])->post('https://api.pucesi.edu.ec/Web-Services/api/auth', [
            'usuario' => $name,
            'password' => $password,
        ]);

        // Check if the API response indicates successful authentication
        if ($response->successful() && $response->json('value') === true) {
            // Check if the user exists in your local database
            $user = User::where('name', $name)->orWhere('email', $name)->first();

            if ($user) {
                // Log in the user
                Auth::login($user);

                // Redirect to the desired page after login
                return redirect()->route('dashboard'); // Change this to your desired route
            } else {
                // Handle the case where the user doesn't exist in your local database
                return redirect()->back()->withErrors(['name' => 'User not found in the local database.']);
            }
        } else {
            // Handle the case where authentication failed
            return redirect()->back()->withErrors(['password' => 'Invalid credentials.']);
        }
    }
}
