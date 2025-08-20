<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MAsset;

class AssetController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/asset/{user_id}",
     *     summary="Mengambil asset berdasarkan user_id",
     *     description="Endpoint ini digunakan untuk mengambil semua data asset berdasarkan ID pengguna.",
     *     tags={"Asset"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data asset",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/MAsset")
     *         )
     *     )
     * )
     */
    public function getAsset($user_id)
    {
        $assets = MAsset::where('user_id', $user_id)->get();
        return response()->json($assets);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/asset/{user_id}",
     *     summary="Menyimpan asset baru",
     *     description="Endpoint ini digunakan untuk membuat data asset baru untuk pengguna tertentu.",
     *     tags={"Asset"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama"},
     *             @OA\Property(property="nama", type="string", example="Sapi Holstein")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Asset berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/MAsset")
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
    public function storeAsset(Request $request, $user_id)
    {
        $request->validate([
            'nama' => 'required|string',
        ]);

        $asset = new MAsset();
        $asset->user_id = $user_id;
        $asset->nama = $request->nama;
        $asset->save();

        return response()->json($asset, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/asset/{user_id}",
     *     summary="Mengupdate data asset",
     *     description="Endpoint ini digunakan untuk mengupdate data asset berdasarkan ID pengguna.",
     *     tags={"Asset"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama", type="string", example="Sapi Holstein")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Asset berhasil diupdate",
     *         @OA\JsonContent(ref="#/components/schemas/MAsset")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Asset tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Asset tidak ditemukan")
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
    public function updateAsset(Request $request, $user_id)
    {
        $request->validate([
            'nama' => 'nullable|string',
        ]);

        $asset = MAsset::where('user_id', $user_id)->first();

        if (!$asset) {
            return response()->json(['message' => 'Asset tidak ditemukan'], 404);
        }

        $asset->update($request->only(['nama']));

        return response()->json($asset);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/asset/{user_id}",
     *     summary="Menghapus data asset",
     *     description="Endpoint ini digunakan untuk menghapus data asset berdasarkan ID pengguna.",
     *     tags={"Asset"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="ID pengguna",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Asset berhasil dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Asset berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Asset tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Asset tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function destroyAsset($user_id)
    {
        $asset = MAsset::where('user_id', $user_id)->first();

        if (!$asset) {
            return response()->json(['message' => 'Asset tidak ditemukan'], 404);
        }

        $asset->delete();

        return response()->json(['message' => 'Asset berhasil dihapus']);
    }
}