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

// ENDPOINT CHAT
// Route::get('/chats', [DummyController::class, 'index']); // Get all chats
// Route::get('/chat/{user_id}', [DummyController::class, 'show']); // Get chat by ID
// Route::post('/chat', [DummyController::class, 'store']); // Create new chat
// Route::delete('/chat/{id}', [DummyController::class, 'destroy']); // Delete chat by ID

// // ENDPOINT ASSET
// Route::get('/assets', [DummyController::class, 'index']); // Get all assets
// Route::get('/asset/{user_id}', [DummyController::class, 'show']); // Get asset by ID
// Route::post('/asset', [DummyController::class, 'store']); // Create new asset
// Route::put('/asset/{id}', [DummyController::class, 'update']); // Update asset by ID
// Route::delete('/asset/{id}', [DummyController::class, 'destroy']); // Delete asset by ID

// // ENDPOINT TUGAS
// Route::get('/tugas/types', [DummyController::class, 'index']); // Get all tugas types
// Route::get('/tugas/type/{id}', [DummyController::class, 'show']); // Get tugas type by ID
// Route::post('/tugas/type', [DummyController::class, 'store']); // Create new tugas type
// Route::put('/tugas/type/{id}', [DummyController::class, 'update']); // Update tugas type by ID
// Route::delete('/tugas/type/{id}', [DummyController::class, 'destroy']); // Delete tugas type by ID

// // ENDPOINT TUJUAN TERNAK
// Route::get('/ternak/goals', [DummyController::class, 'index']); // Get all ternak goals
// Route::get('/ternak/goal/{id}', [DummyController::class, 'show']); // Get ternak goal by ID
// Route::post('/ternak/goal', [DummyController::class, 'store']); // Create new ternak goal
// Route::put('/ternak/goal/{id}', [DummyController::class, 'update']); // Update ternak goal by ID
// Route::delete('/ternak/goal/{id}', [DummyController::class, 'destroy']); // Delete ternak goal by ID

// // ENDPOINT USER
// Route::get('/users', [DummyController::class, 'index']); // Get all users
// Route::get('/user/{id}', [DummyController::class, 'show']); // Get user by ID
// Route::post('/user', [DummyController::class, 'store']); // Create new user
// Route::put('/user/{id}', [DummyController::class, 'update']); // Update user by ID
// Route::delete('/user/{id}', [DummyController::class, 'destroy']); // Delete user by ID

// // ENDPOINT DEFAULT TUGAS
// Route::get('/tugas/default/types', [DummyController::class, 'index']); // Get all tugas/default types
// Route::get('/tugas/default/type/{id}', [DummyController::class, 'show']); // Get tugas/default type by ID
// Route::post('/tugas/default/type', [DummyController::class, 'store']); // Create new tugas/default type
// Route::put('/tugas/default/type/{id}', [DummyController::class, 'update']); // Update tugas/default type by ID
// Route::delete('/tugas/default/type/{id}', [DummyController::class, 'destroy']); // Delete task type by ID

// // ENDPOINT JENIS TUGAS
// Route::get('/tugas/statuses', [DummyController::class, 'index']); // Get all tugas statuses
// Route::get('/tugas/status/{id}', [DummyController::class, 'show']); // Get tugas status by ID
// Route::post('/tugas/status', [DummyController::class, 'store']); // Create new tugas status
// Route::put('/tugas/status/{id}', [DummyController::class, 'update']); // Update tugas status by ID
// Route::delete('/tugas/status/{id}', [DummyController::class, 'destroy']); // Delete tugas status by ID



