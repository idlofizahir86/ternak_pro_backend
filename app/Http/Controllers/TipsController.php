<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipsKategori;
use App\Models\TipsItem;

class TipsController extends Controller
{
    // Mengambil semua kategori tips
    public function allKategoriTips()
    {
        $kategoriTips = TipsKategori::all();
        return response()->json($kategoriTips);
    }

    // Mengambil semua tips
    public function allTips()
    {
        $tips = TipsItem::all();
        return response()->json($tips);
    }

    // Mengambil detail tips berdasarkan id
    public function detailTips($id)
    {
        $tips = TipsItem::find($id);

        if ($tips) {
            return response()->json($tips);
        } else {
            return response()->json(['message' => 'Tips tidak ditemukan'], 404);
        }
    }

    // Menyimpan tips baru
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

    // Mengupdate tips berdasarkan id
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

    // Menghapus tips berdasarkan id
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
