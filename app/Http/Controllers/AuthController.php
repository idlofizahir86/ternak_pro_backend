<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\MAsset;
use App\Models\MDefaultAsset;
use App\Models\MDefaultJenisTugas;
use App\Models\MDefaultTujuanTernak;
use App\Models\User;
use App\Models\MJenisTugas;
use App\Models\MTujuanTernak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_telepon' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Create user
        $user = User::create([
            'uid' => Str::uuid()->toString(), // Generate UUID for uid
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_telepon' => $request->no_telepon,
            'role_id' => $request->role_id,
        ]);

        // ==========================DATA DEFAULT KETIKA REGISTER===============================
        // Ambil semua data aktif dari MDefaultJenisTugas
        $defaultJenisTugas = MDefaultJenisTugas::where('is_aktif', true)->get();
        foreach ($defaultJenisTugas as $jenisTugas) {
            MJenisTugas::create([
                'user_id' => $user->uid, // Pastikan kamu memiliki $user di sini
                'nama' => $jenisTugas->nama,
                'icon_path' => $jenisTugas->icon_path,
                'created_at' => now()->format('Y-m-d H:i:s'),
                'updated_at' => now()->format('Y-m-d H:i:s'),
            ]);
        }

        $defaultAset = MDefaultAsset::where('is_aktif', true)->get();
        foreach ($defaultAset as $aset) {
            MAsset::create([
                'user_id' => $user->uid, // Pastikan kamu memiliki $user di sini
                'nama' => $aset->nama,
                'created_at' => now()->format('Y-m-d H:i:s'),
                'updated_at' => now()->format('Y-m-d H:i:s'),
            ]);
        }

        $defaultTujuanTernak = MDefaultTujuanTernak::where('is_aktif', true)->get();
        foreach ($defaultTujuanTernak as $tujuanTernak) {
            MTujuanTernak::create([
                'user_id' => $user->uid, // Pastikan kamu memiliki $user di sini
                'nama' => $tujuanTernak->nama,
                'created_at' => now()->format('Y-m-d H:i:s'),
                'updated_at' => now()->format('Y-m-d H:i:s'),
            ]);
        }

        // Chat awal
        Chat::create([
            'user_id' => $user->uid,
            'sender_type' => 'assistant',
            'response_text' => 'Halo '.$user->name.'👋, Kenalin Aku Siternak Asisten Ternak Pribadimu!',
        ]);
        Chat::create([
            'user_id' => $user->uid,
            'sender_type' => 'assistant',
            'response_text' => 'Bagaimana Aku Bisa Membantumu ☺️ ?',
        ]);
        // ==================================================================================================

        // Generate Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => [
                'user' => $user,
                'token' => $token,
            ],
        ], 201);
    }

    public function login(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Attempt to authenticate
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Generate Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => [
                'user' => [
                    'uid' => $user->uid,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role_id' => $user->role_id,
                ],
                'token' => $token,
            ],
        ], 200);
    }
}