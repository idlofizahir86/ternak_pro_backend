<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MAsset;

class AssetController extends Controller
{
    // Mengambil asset berdasarkan user_id
    public function getAsset($user_id)
    {
        $assets = MAsset::where('user_id', $user_id)->get();
        return response()->json($assets);
    }

    // Menyimpan asset baru
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

    // Mengupdate asset berdasarkan user_id
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

    // Menghapus asset berdasarkan user_id
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
