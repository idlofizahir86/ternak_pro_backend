<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KonsultasiItem;
use App\Models\KonsultasiKategori;

class KonsultasiPakarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/konsultasi-pakar/kategoris",
     *     summary="Mengambil semua kategori konsultasi pakar",
     *     description="Endpoint ini digunakan untuk mengambil semua data kategori konsultasi pakar yang tersedia.",
     *     tags={"Kategori Konsultasi Pakar"},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data kategori konsultasi pakar",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/KonsultasiKategori")
     *         )
     *     )
     * )
     */
    public function allKonsultasi()
    {
        $kategoriKonsultasi = KonsultasiKategori::all();
        return response()->json($kategoriKonsultasi);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/konsultasi-pakar",
     *     summary="Mengambil semua konsultasi pakar",
     *     description="Endpoint ini digunakan untuk mengambil semua data konsultasi pakar yang tersedia.",
     *     tags={"Konsultasi Pakar"},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data konsultasi pakar",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/KonsultasiItem")
     *         )
     *     )
     * )
     */
    public function allKonsultasiPakar()
    {
        $konsultasiPakar = KonsultasiItem::all();
        return response()->json($konsultasiPakar);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/konsultasi-pakar",
     *     summary="Menyimpan konsultasi pakar baru",
     *     description="Endpoint ini digunakan untuk membuat data konsultasi pakar baru.",
     *     tags={"Konsultasi Pakar"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"image_url", "nama", "kategori_id", "harga", "durasi", "no_tlp", "spesialis", "lokasi_praktik", "pukul_mulai", "pukul_akhir"},
     *             @OA\Property(property="image_url", type="string", format="url", example="https://example.com/image.jpg"),
     *             @OA\Property(property="nama", type="string", example="Dr. John Doe"),
     *             @OA\Property(property="kategori_id", type="integer", example=1),
     *             @OA\Property(property="harga", type="number", format="float", example=500000.00),
     *             @OA\Property(property="durasi", type="string", example="1 jam"),
     *             @OA\Property(property="no_tlp", type="string", example="08123456789"),
     *             @OA\Property(property="spesialis", type="string", example="Dokter Hewan"),
     *             @OA\Property(property="lokasi_praktik", type="string", example="Jakarta"),
     *             @OA\Property(property="pukul_mulai", type="string", format="time", example="08:00:00"),
     *             @OA\Property(property="pukul_akhir", type="string", format="time", example="17:00:00"),
     *             @OA\Property(property="pendidikan", type="array", @OA\Items(type="string", example="S1 Kedokteran Hewan")),
     *             @OA\Property(property="pengalaman", type="string", example="5 tahun di klinik hewan"),
     *             @OA\Property(property="fokus_konsultasi", type="string", example="Kesehatan sapi perah")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Konsultasi pakar berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/KonsultasiItem")
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
    public function storeKonsultasiPakar(Request $request)
    {
        $request->validate([
            'image_url' => 'required|url',
            'nama' => 'required|string',
            'kategori_id' => 'required|exists:konsultasi_kategoris,id',
            'harga' => 'required|numeric',
            'durasi' => 'required|string',
            'no_tlp' => 'required|string',
            'spesialis' => 'required|string',
            'lokasi_praktik' => 'required|string',
            'pukul_mulai' => 'required|date_format:H:i:s',
            'pukul_akhir' => 'required|date_format:H:i:s',
            'pendidikan' => 'nullable|array',
            'pengalaman' => 'nullable|string',
            'fokus_konsultasi' => 'nullable|string',
        ]);

        $konsultasiPakar = KonsultasiItem::create($request->all());

        return response()->json($konsultasiPakar, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/konsultasi-pakar/{id}",
     *     summary="Mengupdate data konsultasi pakar",
     *     description="Endpoint ini digunakan untuk mengupdate data konsultasi pakar berdasarkan ID.",
     *     tags={"Konsultasi Pakar"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID konsultasi pakar",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="image_url", type="string", format="url", example="https://example.com/image.jpg"),
     *             @OA\Property(property="nama", type="string", example="Dr. John Doe"),
     *             @OA\Property(property="kategori_id", type="integer", example=1),
     *             @OA\Property(property="harga", type="number", format="float", example=500000.00),
     *             @OA\Property(property="durasi", type="string", example="1 jam"),
     *             @OA\Property(property="no_tlp", type="string", example="08123456789"),
     *             @OA\Property(property="spesialis", type="string", example="Dokter Hewan"),
     *             @OA\Property(property="lokasi_praktik", type="string", example="Jakarta"),
     *             @OA\Property(property="pukul_mulai", type="string", format="time", example="08:00:00"),
     *             @OA\Property(property="pukul_akhir", type="string", format="time", example="17:00:00"),
     *             @OA\Property(property="pendidikan", type="array", @OA\Items(type="string", example="S1 Kedokteran Hewan")),
     *             @OA\Property(property="pengalaman", type="string", example="5 tahun di klinik hewan"),
     *             @OA\Property(property="fokus_konsultasi", type="string", example="Kesehatan sapi perah")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Konsultasi pakar berhasil diupdate",
     *         @OA\JsonContent(ref="#/components/schemas/KonsultasiItem")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Konsultasi pakar tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Konsultasi Pakar tidak ditemukan")
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
    public function updateKonsultasiPakar(Request $request, $id)
    {
        $konsultasiPakar = KonsultasiItem::find($id);

        if (!$konsultasiPakar) {
            return response()->json(['message' => 'Konsultasi Pakar tidak ditemukan'], 404);
        }

        $request->validate([
            'image_url' => 'nullable|url',
            'nama' => 'nullable|string',
            'kategori_id' => 'nullable|exists:konsultasi_kategoris,id',
            'harga' => 'nullable|numeric',
            'durasi' => 'nullable|string',
            'no_tlp' => 'nullable|string',
            'spesialis' => 'nullable|string',
            'lokasi_praktik' => 'nullable|string',
            'pukul_mulai' => 'nullable|date_format:H:i:s',
            'pukul_akhir' => 'nullable|date_format:H:i:s',
            'pendidikan' => 'nullable|array',
            'pengalaman' => 'nullable|string',
            'fokus_konsultasi' => 'nullable|string',
        ]);

        $konsultasiPakar->update($request->all());

        return response()->json($konsultasiPakar);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/konsultasi-pakar/{id}",
     *     summary="Menghapus data konsultasi pakar",
     *     description="Endpoint ini digunakan untuk menghapus data konsultasi pakar berdasarkan ID.",
     *     tags={"Konsultasi Pakar"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID konsultasi pakar",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Konsultasi pakar berhasil dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Konsultasi Pakar berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Konsultasi pakar tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Konsultasi Pakar tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function destroyKonsultasiPakar($id)
    {
        $konsultasiPakar = KonsultasiItem::find($id);

        if (!$konsultasiPakar) {
            return response()->json(['message' => 'Konsultasi Pakar tidak ditemukan'], 404);
        }

        $konsultasiPakar->delete();

        return response()->json(['message' => 'Konsultasi Pakar berhasil dihapus']);
    }
}