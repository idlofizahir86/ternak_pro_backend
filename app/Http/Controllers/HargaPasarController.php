<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HargaPasarItem;

class HargaPasarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/harga-pasar",
     *     summary="Mengambil semua data harga pasar",
     *     description="Endpoint ini digunakan untuk mengambil semua data harga pasar yang tersedia.",
     *     tags={"Harga Pasar"},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data harga pasar",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/HargaPasarItem")
     *         )
     *     )
     * )
     */
    public function allHargaPasar()
    {
        $hargaPasar = HargaPasarItem::all();
        return response()->json($hargaPasar);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/harga-pasar",
     *     summary="Menyimpan harga pasar baru",
     *     description="Endpoint ini digunakan untuk membuat data harga pasar baru.",
     *     tags={"Harga Pasar"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"image_url", "nama", "harga_kg", "kondisi", "lokasi"},
     *             @OA\Property(property="image_url", type="string", format="url", example="https://example.com/image.jpg"),
     *             @OA\Property(property="nama", type="string", example="Sapi Holstein"),
     *             @OA\Property(property="harga_kg", type="number", format="float", example=50000.00),
     *             @OA\Property(property="kondisi", type="string", example="Sehat"),
     *             @OA\Property(property="lokasi", type="string", example="Jakarta")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Harga pasar berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/HargaPasarItem")
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
    public function storeHargaPasar(Request $request)
    {
        $request->validate([
            'image_url' => 'required|url',
            'nama' => 'required|string',
            'harga_kg' => 'required|numeric',
            'kondisi' => 'required|string',
            'lokasi' => 'required|string',
        ]);

        $hargaPasar = HargaPasarItem::create($request->all());

        return response()->json($hargaPasar, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/harga-pasar/{id}",
     *     summary="Mengupdate data harga pasar",
     *     description="Endpoint ini digunakan untuk mengupdate data harga pasar berdasarkan ID.",
     *     tags={"Harga Pasar"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID harga pasar",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="image_url", type="string", format="url", example="https://example.com/image.jpg"),
     *             @OA\Property(property="nama", type="string", example="Sapi Holstein"),
     *             @OA\Property(property="harga_kg", type="number", format="float", example=50000.00),
     *             @OA\Property(property="kondisi", type="string", example="Sehat"),
     *             @OA\Property(property="lokasi", type="string", example="Jakarta")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Harga pasar berhasil diupdate",
     *         @OA\JsonContent(ref="#/components/schemas/HargaPasarItem")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Harga pasar tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Harga Pasar tidak ditemukan")
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
    public function updateHargaPasar(Request $request, $id)
    {
        $hargaPasar = HargaPasarItem::find($id);

        if (!$hargaPasar) {
            return response()->json(['message' => 'Harga Pasar tidak ditemukan'], 404);
        }

        $request->validate([
            'image_url' => 'nullable|url',
            'nama' => 'nullable|string',
            'harga_kg' => 'nullable|numeric',
            'kondisi' => 'nullable|string',
            'lokasi' => 'nullable|string',
        ]);

        $hargaPasar->update($request->all());

        return response()->json($hargaPasar);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/harga-pasar/{id}",
     *     summary="Menghapus data harga pasar",
     *     description="Endpoint ini digunakan untuk menghapus data harga pasar berdasarkan ID.",
     *     tags={"Harga Pasar"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID harga pasar",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Harga pasar berhasil dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Harga Pasar berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Harga pasar tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Harga Pasar tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function destroyHargaPasar($id)
    {
        $hargaPasar = HargaPasarItem::find($id);

        if (!$hargaPasar) {
            return response()->json(['message' => 'Harga Pasar tidak ditemukan'], 404);
        }

        $hargaPasar->delete();

        return response()->json(['message' => 'Harga Pasar berhasil dihapus']);
    }
}