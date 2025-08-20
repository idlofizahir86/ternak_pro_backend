<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblKeuangan;

class KeuanganController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/keuangan/{tipe}/total/{user_id}",
     *     summary="Mengambil total keuangan berdasarkan tipe dan user_id",
     *     description="Endpoint ini digunakan untuk mengambil total nominal keuangan berdasarkan tipe (pengeluaran atau pemasukan) dan ID pengguna.",
     *     tags={"Keuangan"},
     *     @OA\Parameter(
     *         name="tipe",
     *         in="path",
     *         required=true,
     *         description="Tipe keuangan (pengeluaran atau pemasukan)",
     *         @OA\Schema(type="string", enum={"pengeluaran", "pemasukan"})
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil total keuangan",
     *         @OA\JsonContent(
     *             @OA\Property(property="total_keuangan", type="number", format="float", example=1000000.00)
     *         )
     *     )
     * )
     */
    public function totalKeuangan($tipe, $user_id)
    {
        $keuangan = TblKeuangan::where('user_id', $user_id)
                               ->where('is_pengeluaran', $tipe === 'pengeluaran' ? true : false)
                               ->sum('nominal_total');
        return response()->json(['total_keuangan' => $keuangan]);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/keuangan/{tipe}/{user_id}",
     *     summary="Mengambil data keuangan berdasarkan tipe dan user_id",
     *     description="Endpoint ini digunakan untuk mengambil semua data keuangan berdasarkan tipe (pengeluaran atau pemasukan) dan ID pengguna.",
     *     tags={"Keuangan"},
     *     @OA\Parameter(
     *         name="tipe",
     *         in="path",
     *         required=true,
     *         description="Tipe keuangan (pengeluaran atau pemasukan)",
     *         @OA\Schema(type="string", enum={"pengeluaran", "pemasukan"})
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data keuangan",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Keuangan")
     *         )
     *     )
     * )
     */
    public function dataKeuanganUser($tipe, $user_id)
    {
        $keuangan = TblKeuangan::where('user_id', $user_id)
                               ->where('is_pengeluaran', $tipe === 'pengeluaran' ? true : false)
                               ->get();
        return response()->json($keuangan);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/keuangan",
     *     summary="Menyimpan data keuangan baru",
     *     description="Endpoint ini digunakan untuk membuat data keuangan baru.",
     *     tags={"Keuangan"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "is_pengeluaran", "tgl_keuangan", "nominal_total"},
     *             @OA\Property(property="user_id", type="string", example="user123"),
     *             @OA\Property(property="is_pengeluaran", type="boolean", example=true),
     *             @OA\Property(property="tgl_keuangan", type="string", format="date", example="2025-08-20"),
     *             @OA\Property(property="nominal_total", type="number", format="float", example=1000000.00),
     *             @OA\Property(property="dari_tujuan", type="string", example="Pembelian pakan"),
     *             @OA\Property(property="aset_id", type="integer", example=1),
     *             @OA\Property(property="catatan", type="string", example="Pembelian pakan untuk sapi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Data keuangan berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/Keuangan")
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
    public function storeKeuangan(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,uid',
            'is_pengeluaran' => 'required|boolean',
            'tgl_keuangan' => 'required|date',
            'nominal_total' => 'required|numeric',
            'dari_tujuan' => 'nullable|string',
            'aset_id' => 'nullable|exists:m_assets,id',
            'catatan' => 'nullable|string',
        ]);

        $keuangan = TblKeuangan::create($request->all());

        return response()->json($keuangan, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/keuangan/{id}",
     *     summary="Mengupdate data keuangan",
     *     description="Endpoint ini digunakan untuk mengupdate data keuangan berdasarkan ID.",
     *     tags={"Keuangan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID data keuangan",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="is_pengeluaran", type="boolean", example=true),
     *             @OA\Property(property="tgl_keuangan", type="string", format="date", example="2025-08-20"),
     *             @OA\Property(property="nominal_total", type="number", format="float", example=1000000.00),
     *             @OA\Property(property="dari_tujuan", type="string", example="Pembelian pakan"),
     *             @OA\Property(property="aset_id", type="integer", example=1),
     *             @OA\Property(property="catatan", type="string", example="Pembelian pakan untuk sapi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data keuangan berhasil diupdate",
     *         @OA\JsonContent(ref="#/components/schemas/Keuangan")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data keuangan tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Data keuangan tidak ditemukan")
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
    public function updateKeuangan(Request $request, $id)
    {
        $keuangan = TblKeuangan::find($id);

        if (!$keuangan) {
            return response()->json(['message' => 'Data keuangan tidak ditemukan'], 404);
        }

        $request->validate([
            'is_pengeluaran' => 'nullable|boolean',
            'tgl_keuangan' => 'nullable|date',
            'nominal_total' => 'nullable|numeric',
            'dari_tujuan' => 'nullable|string',
            'aset_id' => 'nullable|exists:m_assets,id',
            'catatan' => 'nullable|string',
        ]);

        $keuangan->update($request->all());

        return response()->json($keuangan);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/keuangan/{id}",
     *     summary="Menghapus data keuangan",
     *     description="Endpoint ini digunakan untuk menghapus data keuangan berdasarkan ID.",
     *     tags={"Keuangan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID data keuangan",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data keuangan berhasil dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Data keuangan berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data keuangan tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Data keuangan tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function destroyKeuangan($id)
    {
        $keuangan = TblKeuangan::find($id);

        if (!$keuangan) {
            return response()->json(['message' => 'Data keuangan tidak ditemukan'], 404);
        }

        $keuangan->delete();

        return response()->json(['message' => 'Data keuangan berhasil dihapus']);
    }
}