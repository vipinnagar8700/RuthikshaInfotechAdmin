<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Handle the registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // Validate the incoming registration data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', // Add password confirmation
            'ip_address' => 'required|ip',
            'contact_no' => 'required|string|max:20|unique:users',
            'address' => 'required|string|max:255',
            'user_role' => 'required|integer|in:1,2,3,4,5',
        ]);

        // Check if validation failed
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Restrict multiple users with user_role = 1
    if ($request->user_role == 1 && User::where('user_role', 1)->exists()) {
        return response()->json([
            'success' => false,
            'message' => 'A user with role 1 already exists. Only one such user is allowed.'
        ], 403);
    }
        // Create the new user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ip_address' => $request->ip_address,
            'contact_no' => $request->contact_no,
            'address' => $request->address,
            'user_role' => $request->user_role,
        ]);

        // Fire the Registered event to trigger email verification
        event(new Registered($user));

        // Create a Sanctum token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response with user details and token
        return response()->json([
            'success' => true,
            'message' => 'User registered successfully. Please check your email for verification.',
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'user_name' => $user->user_name,
                'email' => $user->email,
                'contact_no' => $user->contact_no,
                'address' => $user->address,
                'user_role' => $user->user_role,
                'created_at' => $user->created_at,
            ],
            'token' => $token
        ], 201);
    }
}
