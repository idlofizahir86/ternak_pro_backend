<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipsKategori;
use App\Models\TipsItem;

class TipsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/tips/kategoris",
     *     summary="Mengambil semua kategori tips",
     *     description="Endpoint ini digunakan untuk mengambil semua data kategori tips yang tersedia.",
     *     tags={"Kategori Tips"},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data kategori tips",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TipsKategori")
     *         )
     *     )
     * )
     */
    public function allKategoriTips()
    {
        $kategoriTips = TipsKategori::all();
        return response()->json($kategoriTips);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/tips",
     *     summary="Mengambil semua tips",
     *     description="Endpoint ini digunakan untuk mengambil semua data tips yang tersedia.",
     *     tags={"Tips"},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data tips",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TipsItem")
     *         )
     *     )
     * )
     */
    public function allTips()
    {
        $tips = TipsItem::all();
        return response()->json($tips);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/tips/{id}",
     *     summary="Mengambil detail tips berdasarkan ID",
     *     description="Endpoint ini digunakan untuk mengambil data tips spesifik berdasarkan ID.",
     *     tags={"Tips"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID tips",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data tips",
     *         @OA\JsonContent(ref="#/components/schemas/TipsItem")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tips tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Tips tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function detailTips($id)
    {
        $tips = TipsItem::find($id);

        if ($tips) {
            return response()->json($tips);
        } else {
            return response()->json(['message' => 'Tips tidak ditemukan'], 404);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/tips",
     *     summary="Menyimpan tips baru",
     *     description="Endpoint ini digunakan untuk membuat data tips baru.",
     *     tags={"Tips"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"image_url", "judul", "konten", "kategori"},
     *             @OA\Property(property="image_url", type="string", format="url", example="https://example.com/image.jpg"),
     *             @OA\Property(property="judul", type="string", example="Tips Merawat Sapi"),
     *             @OA\Property(property="konten", type="string", example="Pastikan sapi mendapatkan pakan yang cukup..."),
     *             @OA\Property(property="kategori", type="array", @OA\Items(type="string", example="Perawatan")),
     *             @OA\Property(property="kategori_detail", type="string", example="Detail kategori")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tips berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/TipsItem")
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
    public function storeTips(Request $request)
    {
        $request->validate([
            'image_url' => 'required|url',
            'judul' => 'required|string',
            'konten' => 'required|string',
            'kategori' => 'required|array',
            'kategori_detail' => 'nullable|string',
        ]);

        $tips = TipsItem::create($request->all());

        return response()->json($tips, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/tips/{id}",
     *     summary="Mengupdate data tips",
     *     description="Endpoint ini digunakan untuk mengupdate data tips berdasarkan ID.",
     *     tags={"Tips"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID tips",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="image_url", type="string", format="url", example="https://example.com/image.jpg"),
     *             @OA\Property(property="judul", type="string", example="Tips Merawat Sapi"),
     *             @OA\Property(property="konten", type="string", example="Pastikan sapi mendapatkan pakan yang cukup..."),
     *             @OA\Property(property="kategori", type="array", @OA\Items(type="string", example="Perawatan")),
     *             @OA\Property(property="kategori_detail", type="string", example="Detail kategori")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tips berhasil diupdate",
     *         @OA\JsonContent(ref="#/components/schemas/TipsItem")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tips tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Tips tidak ditemukan")
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
    public function updateTips(Request $request, $id)
    {
        $tips = TipsItem::find($id);

        if (!$tips) {
            return response()->json(['message' => 'Tips tidak ditemukan'], 404);
        }

        $request->validate([
            'image_url' => 'nullable|url',
            'judul' => 'nullable|string',
            'konten' => 'nullable|string',
            'kategori' => 'nullable|array',
            'kategori_detail' => 'nullable|string',
        ]);

        $tips->update($request->all());

        return response()->json($tips);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/tips/{id}",
     *     summary="Menghapus data tips",
     *     description="Endpoint ini digunakan untuk menghapus data tips berdasarkan ID.",
     *     tags={"Tips"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID tips",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tips berhasil dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Tips berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tips tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Tips tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function destroyTips($id)
    {
        $tips = TipsItem::find($id);

        if (!$tips) {
            return response()->json(['message' => 'Tips tidak ditemukan'], 404);
        }

        $tips->delete();

        return response()->json(['message' => 'Tips berhasil dihapus']);
    }
}