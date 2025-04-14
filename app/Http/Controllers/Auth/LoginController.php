<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // ✅ Needed for request handling
use Illuminate\Support\Facades\Auth; // ✅ Needed for Auth::user()

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Override default login response to return JSON with user info.
     */
   protected function sendLoginResponse(Request $request)
{
    $user = Auth::user();

    return response()->json([
        'message' => 'Login successful',
        'user' => [
            'success' => true,
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'user_name' => $user->user_name,
            'email' => $user->email,
            'user_role' => $user->user_role,
        ],
        'token' => $user->createToken('API Token')->plainTextToken,
    ]);
}

    /**
     * Customize logout response.
     */
  public function logout(Request $request)
{
    try {
        // Get the current access token
        $token = $request->user()->currentAccessToken();

        // Check if there is no active token
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'No active token found or already revoked.',
            ], 400);  // Return 400 Bad Request if no token is found
        }

        // Delete the current active token
        $token->delete();

        return response()->json([
            'success' => true,
            'message' => 'Token revoked, logged out successfully',
        ]);
    } catch (\Exception $e) {
        // Catch any unexpected exceptions
        return response()->json([
            'success' => false,
            'message' => 'Logout failed',
            'error' => $e->getMessage(),
        ], 500);
    }
}


}
