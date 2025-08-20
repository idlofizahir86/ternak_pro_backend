<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuplierItem;
use App\Models\SuplierKategori;

class SuplierPakanController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/suplier-pakan/kategoris",
     *     summary="Mengambil semua kategori supplier pakan",
     *     description="Endpoint ini digunakan untuk mengambil semua data kategori supplier pakan yang tersedia.",
     *     tags={"Kategori Supplier Pakan"},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data kategori supplier pakan",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/SuplierKategori")
     *         )
     *     )
     * )
     */
    public function allKategoriSuplierPakan()
    {
        $kategoriSuplier = SuplierKategori::all();
        return response()->json($kategoriSuplier);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/suplier-pakan",
     *     summary="Mengambil semua supplier pakan",
     *     description="Endpoint ini digunakan untuk mengambil semua data supplier pakan yang tersedia.",
     *     tags={"Supplier Pakan"},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data supplier pakan",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/SuplierItem")
     *         )
     *     )
     * )
     */
    public function allSuplierPakan()
    {
        $suplierPakan = SuplierItem::all();
        return response()->json($suplierPakan);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/suplier-pakan",
     *     summary="Menyimpan supplier pakan baru",
     *     description="Endpoint ini digunakan untuk membuat data supplier pakan baru.",
     *     tags={"Supplier Pakan"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"image_url", "judul", "detail", "khasiat", "kategori_id", "is_stok", "harga", "no_tlp", "alamat"},
     *             @OA\Property(property="image_url", type="array", @OA\Items(type="string", format="url", example="https://example.com/image.jpg")),
     *             @OA\Property(property="judul", type="string", example="Pakan Sapi Premium"),
     *             @OA\Property(property="detail", type="string", example="Pakan berkualitas tinggi untuk sapi perah"),
     *             @OA\Property(property="khasiat", type="string", example="Meningkatkan produksi susu"),
     *             @OA\Property(property="kategori_id", type="integer", example=1),
     *             @OA\Property(property="is_stok", type="boolean", example=true),
     *             @OA\Property(property="harga", type="number", format="float", example=100000.00),
     *             @OA\Property(property="no_tlp", type="string", example="08123456789"),
     *             @OA\Property(property="alamat_overview", type="string", example="Toko Pakan XYZ"),
     *             @OA\Property(property="alamat", type="string", example="Jl. Raya No. 123, Jakarta"),
     *             @OA\Property(property="maps_link", type="string", format="url", example="https://maps.google.com/?q=loc:123,456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Supplier pakan berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/SuplierItem")
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
    public function storeSuplierPakan(Request $request)
    {
        $request->validate([
            'image_url' => 'required|array',
            'judul' => 'required|string',
            'detail' => 'required|string',
            'khasiat' => 'required|string',
            'kategori_id' => 'required|exists:suplier_kategoris,id',
            'is_stok' => 'required|boolean',
            'harga' => 'required|numeric',
            'no_tlp' => 'required|string',
            'alamat_overview' => 'nullable|string',
            'alamat' => 'required|string',
            'maps_link' => 'nullable|url',
        ]);

        $suplierPakan = SuplierItem::create($request->all());

        return response()->json($suplierPakan, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/suplier-pakan/{id}",
     *     summary="Mengupdate data supplier pakan",
     *     description="Endpoint ini digunakan untuk mengupdate data supplier pakan berdasarkan ID.",
     *     tags={"Supplier Pakan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID supplier pakan",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="image_url", type="array", @OA\Items(type="string", format="url", example="https://example.com/image.jpg")),
     *             @OA\Property(property="judul", type="string", example="Pakan Sapi Premium"),
     *             @OA\Property(property="detail", type="string", example="Pakan berkualitas tinggi untuk sapi perah"),
     *             @OA\Property(property="khasiat", type="string", example="Meningkatkan produksi susu"),
     *             @OA\Property(property="kategori_id", type="integer", example=1),
     *             @OA\Property(property="is_stok", type="boolean", example=true),
     *             @OA\Property(property="harga", type="number", format="float", example=100000.00),
     *             @OA\Property(property="no_tlp", type="string", example="08123456789"),
     *             @OA\Property(property="alamat_overview", type="string", example="Toko Pakan XYZ"),
     *             @OA\Property(property="alamat", type="string", example="Jl. Raya No. 123, Jakarta"),
     *             @OA\Property(property="maps_link", type="string", format="url", example="https://maps.google.com/?q=loc:123,456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Supplier pakan berhasil diupdate",
     *         @OA\JsonContent(ref="#/components/schemas/SuplierItem")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Supplier pakan tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Supplier Pakan tidak ditemukan")
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
    public function updateSuplierPakan(Request $request, $id)
    {
        $suplierPakan = SuplierItem::find($id);

        if (!$suplierPakan) {
            return response()->json(['message' => 'Supplier Pakan tidak ditemukan'], 404);
        }

        $request->validate([
            'image_url' => 'nullable|array',
            'judul' => 'nullable|string',
            'detail' => 'nullable|string',
            'khasiat' => 'nullable|string',
            'kategori_id' => 'nullable|exists:suplier_kategoris,id',
            'is_stok' => 'nullable|boolean',
            'harga' => 'nullable|numeric',
            'no_tlp' => 'nullable|string',
            'alamat_overview' => 'nullable|string',
            'alamat' => 'nullable|string',
            'maps_link' => 'nullable|url',
        ]);

        $suplierPakan->update($request->all());

        return response()->json($suplierPakan);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/suplier-pakan/{id}",
     *     summary="Menghapus data supplier pakan",
     *     description="Endpoint ini digunakan untuk menghapus data supplier pakan berdasarkan ID.",
     *     tags={"Supplier Pakan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID supplier pakan",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Supplier pakan berhasil dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Supplier Pakan berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Supplier pakan tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Supplier Pakan tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function destroySuplierPakan($id)
    {
        $suplierPakan = SuplierItem::find($id);

        if (!$suplierPakan) {
            return response()->json(['message' => 'Supplier Pakan tidak ditemukan'], 404);
        }

        $suplierPakan->delete();

        return response()->json(['message' => 'Supplier Pakan berhasil dihapus']);
    }
}