<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuplierItem;
use App\Models\SuplierKategori;

class SuplierPakanController extends Controller
{
    // Mengambil semua kategori supplier pakan
    public function allKategoriSuplierPakan()
    {
        $kategoriSuplier = SuplierKategori::all();
        return response()->json($kategoriSuplier);
    }

    // Mengambil semua supplier pakan
    public function allSuplierPakan()
    {
        $suplierPakan = SuplierItem::all();
        return response()->json($suplierPakan);
    }

    // Menyimpan supplier pakan baru
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

    // Mengupdate supplier pakan berdasarkan id
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

    // Menghapus supplier pakan berdasarkan id
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
