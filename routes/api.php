<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/hello', function (Request $request) {
    return response()->json([
        'message' => 'Hello, this is a simple inline GET API!',
        'status' => 'success',
        'data' => [
            'id' => 1,
            'name' => 'John Doe'
        ]
    ], 200);
});

// Example protected route (requires authentication)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});