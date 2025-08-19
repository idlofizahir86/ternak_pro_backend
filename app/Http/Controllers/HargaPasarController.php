<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HargaPasarItem;

class HargaPasarController extends Controller
{
    // Mengambil semua harga pasar
    public function allHargaPasar()
    {
        $hargaPasar = HargaPasarItem::all();
        return response()->json($hargaPasar);
    }

    // Menyimpan harga pasar baru
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

    // Mengupdate harga pasar berdasarkan id
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

    // Menghapus harga pasar berdasarkan id
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
