<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblTugas;
use App\Models\MJenisTugas;
use App\Models\MStatusTugas;
use Carbon\Carbon;


/**
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="apiKey",
 *     description="Masukkan token dalam format (Bearer <token>)",
 *     name="Authorization",
 *     in="header"
 * )
 */
class TugasController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/tugas",
     *     operationId="getAllTugas",
     *     tags={"Tugas"},
     *     summary="Mengambil semua tugas",
     *     description="Mengembalikan daftar semua tugas yang tersedia di sistem.",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil daftar tugas",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Tugas")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Kesalahan server",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Terjadi kesalahan pada server")
     *         )
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function allTugas()
    {
        $tugas = TblTugas::all();
        return response()->json($tugas);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/tugas/{user_id}",
     *     operationId="getTugasByUser",
     *     tags={"Tugas"},
     *     summary="Mengambil semua tugas berdasarkan user_id",
     *     description="Mengembalikan daftar tugas untuk pengguna dengan user_id tertentu.",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (user_id)",
     *         @OA\Schema(type="integer", example=123)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil daftar tugas pengguna",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Tugas")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pengguna tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Pengguna tidak ditemukan")
     *         )
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function tugasUserAll($user_id)
    {
        $tugas = TblTugas::where('user_id', $user_id)->get();
        $tugasData = [];
        foreach ($tugas as $key => $value) {
            $jenisTugas = MJenisTugas::where('user_id',$user_id)
                ->where('id', $value->jenis_tugas_id)->first();
            $nama_tugas = $jenisTugas->nama;
            $icon_path = $jenisTugas->icon_path;
            $status_tugas = MStatusTugas::where('id', $value->status_tugas_id)->first()->nama;
            $eachTugas = [
                    'id_tugas' => $value->id,
                    'nama_tugas' => $nama_tugas,
                    'icon_path' => $icon_path,
                    'status_tugas' => $status_tugas,
                    'waktu_tugas' => Carbon::parse($value->waktu_tugas)->format('H:i'), // Mengubah format waktu
                    'catatan' => $value->catatan
                ];
            $tugasData[] = $eachTugas; // Menambahkan jenis_tugas_id ke dalam array
        }

        return response()->json($tugasData); // Mengembalikan array tugasData setelah iterasi selesai
        return response()->json($tugas);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/tugas/{user_id}/{id}",
     *     operationId="getTugasByUserAndId",
     *     tags={"Tugas"},
     *     summary="Mengambil tugas berdasarkan user_id dan id",
     *     description="Mengembalikan detail tugas untuk pengguna dan ID tugas tertentu.",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (user_id)",
     *         @OA\Schema(type="string", example=123)
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID tugas",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil tugas",
     *         @OA\JsonContent(ref="#/components/schemas/Tugas")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tugas tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Tugas tidak ditemukan")
     *         )
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function tugasUser($user_id, $id)
    {
        $tugas = TblTugas::where('user_id', $user_id)->where('id', $id)->first();

        if ($tugas) {
            return response()->json($tugas);
        } else {
            return response()->json(['message' => 'Tugas tidak ditemukan'], 404);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/tugas",
     *     operationId="storeTugas",
     *     tags={"Tugas"},
     *     summary="Menyimpan tugas baru",
     *     description="Membuat tugas baru untuk pengguna tertentu.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "jenis_tugas_id", "tgl_tugas", "waktu_tugas", "status_tugas_id"},
     *             @OA\Property(property="user_id", type="integer", example=123, description="ID pengguna"),
     *             @OA\Property(property="jenis_tugas_id", type="integer", example=1, description="ID jenis tugas"),
     *             @OA\Property(property="tgl_tugas", type="string", format="date", example="2025-08-01", description="Tanggal tugas"),
     *             @OA\Property(property="waktu_tugas", type="string", format="time", example="08:00:00", description="Waktu tugas"),
     *             @OA\Property(property="status_tugas_id", type="integer", example=1, description="ID status tugas"),
     *             @OA\Property(property="catatan", type="string", example="Catatan tambahan", description="Catatan tugas (opsional)"),
     *             @OA\Property(property="is_pengingat", type="boolean", example=true, description="Apakah tugas memiliki pengingat (opsional)")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tugas berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/Tugas")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function storeTugas(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,uid',
            'jenis_tugas_id' => 'required|exists:m_jenis_tugas,id',
            'tgl_tugas' => 'required|date',
            'pengulangan_id' => 'required|exists:m_pengulangan_tugas,id',
            'waktu_tugas' => 'required|date_format:H:i:s',
            'status_tugas_id' => 'required|exists:m_status_tugas,id',
            'catatan' => 'nullable|string',
            'is_pengingat' => 'nullable|boolean',
        ]);

        $tugas = TblTugas::create($request->all());

        return response()->json($tugas, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/tugas/{user_id}/{id}",
     *     operationId="updateTugas",
     *     tags={"Tugas"},
     *     summary="Mengupdate tugas berdasarkan user_id dan id",
     *     description="Memperbarui tugas untuk pengguna dan ID tugas tertentu.",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (user_id)",
     *         @OA\Schema(type="integer", example=123)
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID tugas",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"jenis_tugas_id", "tgl_tugas", "waktu_tugas", "status_tugas_id"},
     *             @OA\Property(property="jenis_tugas_id", type="integer", example=1, description="ID jenis tugas"),
     *             @OA\Property(property="tgl_tugas", type="string", format="date", example="2025-08-01", description="Tanggal tugas"),
     *             @OA\Property(property="waktu_tugas", type="string", format="time", example="08:00:00", description="Waktu tugas"),
     *             @OA\Property(property="status_tugas_id", type="integer", example=1, description="ID status tugas"),
     *             @OA\Property(property="catatan", type="string", example="Catatan tambahan", description="Catatan tugas (opsional)"),
     *             @OA\Property(property="is_pengingat", type="boolean", example=true, description="Apakah tugas memiliki pengingat (opsional)")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tugas berhasil diperbarui",
     *         @OA\JsonContent(ref="#/components/schemas/Tugas")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tugas tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Tugas tidak ditemukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function updateTugas(Request $request, $user_id, $id)
    {
        $tugas = TblTugas::where('user_id', $user_id)->where('id', $id)->first();

        if (!$tugas) {
            return response()->json(['message' => 'Tugas tidak ditemukan'], 404);
        }

        $request->validate([
            'jenis_tugas_id' => 'required|exists:m_jenis_tugas,id',
            'tgl_tugas' => 'required|date',
            'waktu_tugas' => 'required|date_format:H:i:s',
            'status_tugas_id' => 'required|exists:m_status_tugas,id',
            'catatan' => 'nullable|string',
            'is_pengingat' => 'nullable|boolean',
        ]);

        $tugas->update($request->all());

        return response()->json($tugas);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/tugas/{user_id}/{id}",
     *     operationId="deleteTugas",
     *     tags={"Tugas"},
     *     summary="Menghapus tugas berdasarkan user_id dan id",
     *     description="Menghapus tugas untuk pengguna dan ID tugas tertentu.",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (user_id)",
     *         @OA\Schema(type="integer", example=123)
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID tugas",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tugas berhasil dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Tugas berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tugas tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Tugas tidak ditemukan")
     *         )
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function destroyTugas($user_id, $id)
    {
        $tugas = TblTugas::where('user_id', $user_id)->where('id', $id)->first();

        if (!$tugas) {
            return response()->json(['message' => 'Tugas tidak ditemukan'], 404);
        }

        $tugas->delete();

        return response()->json(['message' => 'Tugas berhasil dihapus']);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/jenis/tugas/{user_id}",
     *     operationId="getJenisTugas",
     *     tags={"Jenis Tugas"},
     *     summary="Mengambil jenis tugas berdasarkan user_id",
     *     description="Mengembalikan daftar jenis tugas untuk pengguna tertentu.",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (user_id)",
     *         @OA\Schema(type="integer", example=123)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil daftar jenis tugas",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/JenisTugas")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pengguna tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Pengguna tidak ditemukan")
     *         )
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function getJenisTugas($user_id)
    {
        $listJenisTugas = MJenisTugas::where('user_id', $user_id)->get();

        if ($listJenisTugas) {
            return response()->json($listJenisTugas);
        } else {
            return response()->json(['message' => 'List Jenis Tugas tidak ditemukan'], 404);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/v1/jenis/tugas/{user_id}/{id}",
     *     summary="Get details of a specific Jenis Tugas",
     *     description="Retrieves the details of a Jenis Tugas by user ID and task type ID.",
     *     operationId="getDetailJenisTugas",
     *     tags={"Jenis Tugas"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         description="ID of the user",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the Jenis Tugas",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="string", example="1"),
     *             @OA\Property(property="user_id", type="string", example="user123"),
     *             @OA\Property(property="nama", type="string", example="Pemberian Pakan"),
     *             @OA\Property(property="icon_path", type="string", example="assets/home_assets/icons/ic_snack.png"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-23T12:20:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-23T12:20:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Jenis Tugas not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Jenis Tugas tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function getDetailJenisTugas($user_id, $id)
    {
        $jenisTugas = MJenisTugas::where('user_id', $user_id)->where('id', $id)->first();

        if ($jenisTugas) {
            return response()->json($jenisTugas);
        } else {
            return response()->json(['message' => 'Jenis Tugas tidak ditemukan'], 404);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/jenis/tugas/{user_id}",
     *     operationId="storeJenisTugas",
     *     tags={"Jenis Tugas"},
     *     summary="Menyimpan jenis tugas baru",
     *     description="Membuat jenis tugas baru untuk pengguna tertentu.",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (user_id)",
     *         @OA\Schema(type="integer", example=123)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama"},
     *             @OA\Property(property="nama", type="string", example="Tugas Harian", description="Nama jenis tugas"),
     *             @OA\Property(property="icon_path", type="string", example="/images/icons/task.png", description="Path ikon jenis tugas (opsional)")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Jenis tugas berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/JenisTugas")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function storeJenisTugas(Request $request, $user_id)
    {
        $request->validate([
            'nama' => 'required|string',
            'icon_path' => 'nullable|string',
        ]);

        $jenisTugas = new MJenisTugas();
        $jenisTugas->user_id = $user_id;
        $jenisTugas->nama = $request->nama;
        $jenisTugas->icon_path = $request->icon_path;
        $jenisTugas->save();

        return response()->json($jenisTugas, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/jenis/tugas/{user_id}",
     *     operationId="updateJenisTugas",
     *     tags={"Jenis Tugas"},
     *     summary="Mengupdate jenis tugas berdasarkan user_id",
     *     description="Memperbarui jenis tugas untuk pengguna tertentu.",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (user_id)",
     *         @OA\Schema(type="integer", example=123)
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama", type="string", example="Tugas Harian", description="Nama jenis tugas (opsional)"),
     *             @OA\Property(property="icon_path", type="string", example="/images/icons/task.png", description="Path ikon jenis tugas (opsional)")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Jenis tugas berhasil diperbarui",
     *         @OA\JsonContent(ref="#/components/schemas/JenisTugas")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Jenis tugas tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Jenis Tugas tidak ditemukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function updateJenisTugas(Request $request, $user_id)
    {
        $jenisTugas = MJenisTugas::where('user_id', $user_id)->first();

        if (!$jenisTugas) {
            return response()->json(['message' => 'Jenis Tugas tidak ditemukan'], 404);
        }

        $request->validate([
            'nama' => 'nullable|string',
            'icon_path' => 'nullable|string',
        ]);

        $jenisTugas->update($request->all());

        return response()->json($jenisTugas);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/jenis/tugas/{user_id}",
     *     operationId="deleteJenisTugas",
     *     tags={"Jenis Tugas"},
     *     summary="Menghapus jenis tugas berdasarkan user_id",
     *     description="Menghapus jenis tugas untuk pengguna tertentu.",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (user_id)",
     *         @OA\Schema(type="integer", example=123)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Jenis tugas berhasil dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Jenis Tugas berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Jenis tugas tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Jenis Tugas tidak ditemukan")
     *         )
     *     ),
     *     security={{"sanctum": {}}}
     * )
     */
    public function destroyJenisTugas($user_id)
    {
        $jenisTugas = MJenisTugas::where('user_id', $user_id)->first();

        if (!$jenisTugas) {
            return response()->json(['message' => 'Jenis Tugas tidak ditemukan'], 404);
        }

        $jenisTugas->delete();

        return response()->json(['message' => 'Jenis Tugas berhasil dihapus']);
    }
}