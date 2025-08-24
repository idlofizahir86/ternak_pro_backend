<?php

namespace App\Http\Controllers;

use App\Models\MHewan;
use Illuminate\Http\Request;
use App\Models\TblTernak;
use App\Models\MTujuanTernak;
use Carbon\Carbon;


class TernakController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/ternak",
     *     summary="Mengambil semua data ternak",
     *     description="Endpoint ini digunakan untuk mengambil semua data ternak yang tersedia.",
     *     tags={"Ternak"},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data ternak",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Ternak")
     *         )
     *     )
     * )
     */
    public function allTernak()
    {
        $ternak = TblTernak::all();
        return response()->json($ternak);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/ternak/{user_id}",
     *     summary="Mengambil semua data ternak berdasarkan user_id",
     *     description="Endpoint ini digunakan untuk mengambil semua data ternak milik pengguna tertentu berdasarkan user_id.",
     *     tags={"Ternak"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (uid)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data ternak",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Ternak")
     *         )
     *     )
     * )
     */
    public function ternakUserAll($user_id)
    {
        $ternak = TblTernak::where('user_id', $user_id)->get();
        $ternakData = [];
        foreach ($ternak as $key => $value) {
            $hewan = MHewan::where('id', $value->hewan_id)->first();
            $nama_hewan = $hewan->nama;
            $icon_path = $hewan->icon_path;
            $eachTernak = [
                    'id_ternak' => $value->id,
                    'tag_id' => $value->tag_id,
                    'nama_ternak' => $value->nama_ternak,
                    'jenis_hewan' => $nama_hewan,
                    'icon_path' => $icon_path,
                    'berat' => $value->berat,
                    'usia' => $value->usia,
                    'kondisi_ternak' => $value->kondisi_ternak,
                    'jenis_kelamin' => $value->jenis_kelamin,
                    'tgl_mulai' => Carbon::parse($value->tgl_mulai)->format('Y-m-d'),
                    'catatan' => $value->catatan
                ];
            $ternakData[] = $eachTernak; // Menambahkan jenis_ternak_id ke dalam array
        }

        return response()->json($ternakData); // Mengembalikan array tugasData setelah iterasi selesai
    }

    /**
     * @OA\Get(
     *     path="/api/v1/ternak/{user_id}/{id}",
     *     summary="Mengambil data ternak berdasarkan user_id dan id",
     *     description="Endpoint ini digunakan untuk mengambil data ternak spesifik berdasarkan user_id dan id ternak.",
     *     tags={"Ternak"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (uid)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID ternak",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data ternak",
     *         @OA\JsonContent(ref="#/components/schemas/Ternak")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ternak tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Ternak tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function ternakUser($user_id, $id)
    {
        $ternak = TblTernak::where('user_id', $user_id)->where('id', $id)->first();

        if ($ternak) {
            return response()->json($ternak);
        } else {
            return response()->json(['message' => 'Ternak tidak ditemukan'], 404);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/ternak",
     *     summary="Menyimpan ternak baru",
     *     description="Endpoint ini digunakan untuk membuat data ternak baru.",
     *     tags={"Ternak"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "tag_id", "nama_ternak", "tgl_mulai", "hewan_id", "ras_id", "tujuan_ternak_id", "usia", "kondisi_ternak", "jenis_kelamin", "berat"},
     *             @OA\Property(property="user_id", type="string", example="user123"),
     *             @OA\Property(property="tag_id", type="string", example="Sapi Ke1"),
     *             @OA\Property(property="nama_ternak", type="string", example="Sapi Perah"),
     *             @OA\Property(property="tgl_mulai", type="string", format="date", example="2025-08-20"),
     *             @OA\Property(property="hewan_id", type="integer", example=1),
     *             @OA\Property(property="ras_id", type="integer", example=1),
     *             @OA\Property(property="tujuan_ternak_id", type="integer", example=1),
     *             @OA\Property(property="usia", type="integer", example=24),
     *             @OA\Property(property="kondisi_ternak", type="string", example="Sehat"),
     *             @OA\Property(property="jenis_kelamin", type="string", example="Betina"),
     *             @OA\Property(property="berat", type="number", format="float", example=500.5),
     *             @OA\Property(property="catatan", type="string", example="Catatan tambahan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ternak berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/Ternak")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Validasi gagal"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function storeTernak(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,uid',
            'nama_ternak' => 'required|string',
            'tgl_mulai' => 'required|date',
            'hewan_id' => ' required|exists:m_hewans,id',
            'ras_id' => 'required|exists:m_ras,id',
            'tujuan_ternak_id' => 'required|exists:m_tujuan_ternaks,id',
            'usia' => 'required|integer',
            'kondisi_ternak' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'berat' => 'required|numeric',
            'catatan' => 'nullable|string',
        ]);

        $ternak = TblTernak::create($request->all());

        return response()->json($ternak, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/ternak/{user_id}/{id}",
     *     summary="Mengupdate data ternak",
     *     description="Endpoint ini digunakan untuk mengupdate data ternak berdasarkan user_id dan id.",
     *     tags={"Ternak"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (uid)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID ternak",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama_ternak", type="string", example="Sapi Perah"),
     *             @OA\Property(property="tgl_mulai", type="string", format="date", example="2025-08-20"),
     *             @OA\Property(property="hewan_id", type="integer", example=1),
     *             @OA\Property(property="ras_id", type="integer", example=1),
     *             @OA\Property(property="tujuan_ternak_id", type="integer", example=1),
     *             @OA\Property(property="usia", type="integer", example=24),
     *             @OA\Property(property="kondisi_ternak", type="string", example="Sehat"),
     *             @OA\Property(property="jenis_kelamin", type="string", example="Betina"),
     *             @OA\Property(property="berat", type="number", format="float", example=500.5),
     *             @OA\Property(property="catatan", type="string", example="Catatan tambahan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ternak berhasil diupdate",
     *         @OA\JsonContent(ref="#/components/schemas/Ternak")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ternak tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Ternak tidak ditemukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Validasi gagal"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function updateTernak(Request $request, $user_id, $id)
    {
        $ternak = TblTernak::where('user_id', $user_id)->where('id', $id)->first();

        if (!$ternak) {
            return response()->json(['message' => 'Ternak tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_ternak' => 'nullable|string',
            'tgl_mulai' => 'nullable|date',
            'hewan_id' => 'nullable|exists:m_hewan,id',
            'ras_id' => 'nullable|exists:m_ras,id',
            'tujuan_ternak_id' => 'nullable|exists:m_tujuan_ternak,id',
            'usia' => 'nullable|integer',
            'kondisi_ternak' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string',
            'berat' => 'nullable|numeric',
            'catatan' => 'nullable|string',
        ]);

        $ternak->update($request->all());

        return response()->json($ternak);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/ternak/{user_id}/{id}",
     *     summary="Menghapus data ternak",
     *     description="Endpoint ini digunakan untuk menghapus data ternak berdasarkan user_id dan id.",
     *     tags={"Ternak"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (uid)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID ternak",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ternak berhasil dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Ternak berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ternak tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Ternak tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function destroyTernak($user_id, $id)
    {
        $ternak = TblTernak::where('user_id', $user_id)->where('id', $id)->first();

        if (!$ternak) {
            return response()->json(['message' => 'Ternak tidak ditemukan'], 404);
        }

        $ternak->delete();

        return response()->json(['message' => 'Ternak berhasil dihapus']);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/ternak/tujuan/{user_id}",
     *     summary="Mengambil semua tujuan ternak berdasarkan user_id",
     *     description="Endpoint ini digunakan untuk mengambil semua data tujuan ternak milik pengguna tertentu berdasarkan user_id.",
     *     tags={"Tujuan Ternak"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (uid)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data tujuan ternak",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TujuanTernak")
     *         )
     *     )
     * )
     */
    public function gotTujuanTernak($user_id)
    {
        $tujuanTernak = MTujuanTernak::where('user_id', $user_id)->get();
        return response()->json($tujuanTernak);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/ternak/tujuan/{ Uuser_id}",
     *     summary="Menyimpan tujuan ternak baru",
     *     description="Endpoint ini digunakan untuk membuat data tujuan ternak baru berdasarkan user_id.",
     *     tags={"Tujuan Ternak"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (uid)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama"},
     *             @OA\Property(property="nama", type="string", example="Peternakan Sapi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tujuan ternak berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/TujuanTernak")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Validasi gagal"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function storeTujuanTernak(Request $request, $user_id)
    {
        $request->validate([
            'nama' => 'required|string',
        ]);

        $tujuanTernak = new MTujuanTernak();
        $tujuanTernak->user_id = $user_id;
        $tujuanTernak->nama = $request->nama;
        $tujuanTernak->save();

        return response()->json($tujuanTernak, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/ternak/tujuan/{user_id}",
     *     summary="Mengupdate tujuan ternak",
     *     description="Endpoint ini digunakan untuk mengupdate data tujuan ternak berdasarkan user_id.",
     *     tags={"Tujuan Ternak"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (uid)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama", type="string", example="Peternakan Sapi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tujuan ternak berhasil diupdate",
     *         @OA\JsonContent(ref="#/components/schemas/TujuanTernak")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tujuan ternak tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Tujuan Ternak tidak ditemukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Validasi gagal"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function updateTujuanTernak(Request $request, $user_id)
    {
        $tujuanTernak = MTujuanTernak::where('user_id', $user_id)->first();

        if (!$tujuanTernak) {
            return response()->json(['message' => 'Tujuan Ternak tidak ditemukan'], 404);
        }

        $request->validate([
            'nama' => 'nullable|string',
        ]);

        $tujuanTernak->update($request->all());

        return response()->json($tujuanTernak);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/ternak/tujuan/{user_id}",
     *     summary="Menghapus tujuan ternak",
     *     description="Endpoint ini digunakan untuk menghapus data tujuan ternak berdasarkan user_id.",
     *     tags={"Tujuan Ternak"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna (uid)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tujuan ternak berhasil dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Tujuan Ternak berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tujuan ternak tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Tujuan Ternak tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function destroyTujuanTernak($user_id)
    {
        $tujuanTernak = MTujuanTernak::where('user_id', $user_id)->first();

        if (!$tujuanTernak) {
            return response()->json(['message' => 'Tujuan Ternak tidak ditemukan'], 404);
        }

        $tujuanTernak->delete();

        return response()->json(['message' => 'Tujuan Ternak berhasil dihapus']);
    }
}