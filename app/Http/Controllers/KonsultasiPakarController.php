<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KonsultasiItem;
use App\Models\KonsultasiKategori;

class KonsultasiPakarController extends Controller
{
    // Mengambil semua kategori konsultasi pakar
    public function allKonsultasi()
    {
        $kategoriKonsultasi = KonsultasiKategori::all();
        return response()->json($kategoriKonsultasi);
    }

    // Mengambil semua konsultasi pakar
    public function allKonsultasiPakar()
    {
        $konsultasiPakar = KonsultasiItem::all();
        return response()->json($konsultasiPakar);
    }

    // Menyimpan konsultasi pakar baru
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

    // Mengupdate konsultasi pakar berdasarkan id
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

    // Menghapus konsultasi pakar berdasarkan id
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
