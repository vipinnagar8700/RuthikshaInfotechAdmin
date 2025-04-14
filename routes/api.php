<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\EmailVerificationController;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Public routes
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/me', [UserController::class, 'getProfile']);

Route::post('/send-test-email', function () {
    $toEmail = request('email', 'vipinnagar8700@gmail.com'); // you can pass ?email=your@email.com

    Mail::to($toEmail)->send(new TestEmail("Test User"));

    return response()->json([
        'success' => true,
        'message' => "Test email sent to $toEmail",
    ]);
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'notice']);
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed'])
        ->name('verification.verify');
    Route::post('/email/resend', [EmailVerificationController::class, 'resend'])
        ->name('verification.send');
});