<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    // Send verification link notice
    public function notice()
    {
        return response()->json([
            'message' => 'Verification link sent to your email if not verified.'
        ]);
    }

    // Handle email verification
   public function verify(EmailVerificationRequest $request)
{
    if ($request->user()->hasVerifiedEmail()) {
        return response()->json([
            'success' => false,
            'message' => 'Email already verified.'
        ], 400);
    }

    if ($request->user()->markEmailAsVerified()) {
        event(new Verified($request->user()));
    }

    return response()->json([
        'success' => true,
        'message' => 'Email has been successfully verified.',
    ]);
}


    // Resend email verification link
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified.']);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification link sent!']);
    }
}
