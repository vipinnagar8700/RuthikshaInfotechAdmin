<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log; 

class UserController extends Controller
{
    /**
     * Get the authenticated user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfile(Request $request)
    {
        try {
            // Check if the user is authenticated
            $user = Auth::user();
 Log::warning('Unauthorized access attempt.');
            // If no authenticated user, return an error response
            if (!$user) {
                   Log::warning('Unauthorized access attempt.');
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated.',
                ], 401); // Unauthorized status
            }

            // Return the user profile data excluding the password and token
            return response()->json([
                'success' => true,
                'message' => 'User profile fetched successfully.',
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
                    'updated_at' => $user->updated_at,
                ]
            ]);

        } catch (ValidationException $e) {
            // Handle validation exceptions (e.g., invalid data sent in request)
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'error' => $e->errors(),
            ], 422); // Unprocessable Entity status

        } catch (\Exception $e) {
            // Catch any unexpected exceptions and provide a detailed error message
            return response()->json([
                'success' => false,
                'message' => 'Error fetching user profile.',
                'error' => $e->getMessage(),
            ], 500); // Internal Server Error status
        }
    }
}
