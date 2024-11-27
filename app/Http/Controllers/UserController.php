<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserController extends Authenticatable
{
    public function store(Request $request)
    {
        $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string',
            ],
                [
                    'name.required' => 'The name field is required.',
                    'email.required' => 'The email field is required.',
                    'password.required' => 'The password field is required.',
            ]);

            $validated['password'] = Hash::make($validated['password']);  // Hash the password before saving

            // $users = User::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'password' => Hash::make($request->password), // Hash the password
            // ]);

            $user = User::create($validated);



            return response()->json([
                'message' => 'User registered successfully!',
                'user' => $user
            ], 201);


    }
    public function login(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();



        if ($user && Hash::check($validated['password'], $user->password)) {
            // Generate token or return success message
            $token = $user->createToken('aaa')->plainTextToken;

            $cleanToken = explode('|', $token)[1];

            return response()->json([
                'message' => 'Login successful!',
                'user' => $user,
                'token' => $cleanToken
            ]);
        }

        // If user not found or password doesn't match
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    public function get_all_user(){
        $users = User::all();
        return response()->json($users);
    }
}
