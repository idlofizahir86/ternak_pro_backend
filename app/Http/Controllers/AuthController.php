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
    /**
     * @OA\Post(
     *     path="/api/v1/register",
     *     summary="Registrasi pengguna baru",
     *     description="Endpoint ini digunakan untuk mendaftarkan pengguna baru dalam aplikasi.",
     *     tags={"Autentikasi"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password", "role_id"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="johndoe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="no_telepon", type="string", example="08123456789"),
     *             @OA\Property(property="role_id", type="integer", example="1")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User successfully registered",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="User registered successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="user", type="object",
     *                     @OA\Property(property="uid", type="string", example="123e4567-e89b-12d3-a456-426614174000"),
     *                     @OA\Property(property="name", type="string", example="John Doe"),
     *                     @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *                     @OA\Property(property="role_id", type="integer", example="1")
     *                 ),
     *                 @OA\Property(property="token", type="string", example="your-generated-token-here")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Validation failed"),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="name", type="array", @OA\Items(type="string", example="The name field is required")),
     *                 @OA\Property(property="email", type="array", @OA\Items(type="string", example="The email field is required"))
     *             )
     *         )
     *     )
     * )
     */
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
            'response_text' => 'Halo ' . $user->name . '👋, Kenalin Aku Siternak Asisten Ternak Pribadimu!',
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

    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     summary="Login pengguna",
     *     description="Endpoint ini digunakan untuk login ke aplikasi dengan email dan password.",
     *     tags={"Autentikasi"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="johndoe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login berhasil",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Login successful"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="user", type="object",
     *                     @OA\Property(property="uid", type="string", example="123e4567-e89b-12d3-a456-426614174000"),
     *                     @OA\Property(property="name", type="string", example="John Doe"),
     *                     @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *                     @OA\Property(property="role_id", type="integer", example="1")
     *                 ),
     *                 @OA\Property(property="token", type="string", example="your-generated-token-here")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Invalid credentials")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Validation failed"),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="email", type="array", @OA\Items(type="string", example="The email field is required")),
     *                 @OA\Property(property="password", type="array", @OA\Items(type="string", example="The password field is required"))
     *             )
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        // Validasi data request
        $validator = Validator::make($request->all(), [
            'email_or_phone' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data yang dimasukkan tidak sesuai',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Cek apakah input email_or_phone berupa email atau nomor telepon
        $user = null;
        if (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            // Jika input adalah email, cari user berdasarkan email
            $user = User::where('email', $request->email_or_phone)->first();
        } else {
            // Jika input bukan email, cari user berdasarkan nomor telepon
            $user = User::where('no_telepon', $request->email_or_phone)->first();
        }

        // Jika user tidak ditemukan atau password tidak cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email/No Handphone atau Password salah',
            ], 401);
        }

        // Generate token dengan Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // Kembalikan response login berhasil
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => [
                'user' => [
                    'uid' => $user->uid,
                    'name' => $user->name,
                    'email' => $user->email,
                    'no_telepon' => $user->no_telepon,
                    'role_id' => $user->role_id,
                ],
                'token' => $token,
            ],
        ], 200);
    }

    public function loginWeb(Request $request)
    {
        // Validasi data request
        $validator = Validator::make($request->all(), [
            'email_or_phone' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data yang dimasukkan tidak sesuai',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Cek apakah input email_or_phone berupa email atau nomor telepon
        $user = null;
        if (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $request->email_or_phone)->first();
        } else {
            $user = User::where('no_telepon', $request->email_or_phone)->first();
        }

        // Jika user tidak ditemukan atau password tidak cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email/No Handphone atau Password salah',
            ], 401);
        }

        // Generate token dengan Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // Data untuk dikirim ke Flutter
        $userData = [
            'token' => $token,
            'user_id' => $user->uid,
            'email' => $user->email,
            'name' => $user->name,
            'role_id' => $user->role_id,
        ];

        // Mengarahkan pengguna ke aplikasi Flutter dengan data login
        return redirect()->to('https://app.ternakpro.id?' . http_build_query($userData));
    }

}