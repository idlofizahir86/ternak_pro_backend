<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblKeuangan;

class KeuanganController extends Controller
{
    // Mengambil total keuangan berdasarkan tipe dan user_id
    public function totalKeuangan($tipe, $user_id)
    {
        $keuangan = TblKeuangan::where('user_id', $user_id)
                               ->where('is_pengeluaran', $tipe === 'pengeluaran' ? true : false)
                               ->sum('nominal_total');
        return response()->json(['total_keuangan' => $keuangan]);
    }

    // Mengambil data keuangan berdasarkan tipe dan user_id
    public function dataKeuanganUser($tipe, $user_id)
    {
        $keuangan = TblKeuangan::where('user_id', $user_id)
                               ->where('is_pengeluaran', $tipe === 'pengeluaran' ? true : false)
                               ->get();
        return response()->json($keuangan);
    }

    // Menyimpan data keuangan baru
    public function storeKeuangan(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,uid',
            'is_pengeluaran' => 'required|boolean',
            'tgl_keuangan' => 'required|date',
            'nominal_total' => 'required|numeric',
            'dari_tujuan' => 'nullable|string',
            'aset_id' => 'nullable|exists:m_assets,id',
            'catatan' => 'nullable|string',
        ]);

        $keuangan = TblKeuangan::create($request->all());

        return response()->json($keuangan, 201);
    }

    // Mengupdate data keuangan berdasarkan id
    public function updateKeuangan(Request $request, $id)
    {
        $keuangan = TblKeuangan::find($id);

        if (!$keuangan) {
            return response()->json(['message' => 'Data keuangan tidak ditemukan'], 404);
        }

        $request->validate([
            'is_pengeluaran' => 'nullable|boolean',
            'tgl_keuangan' => 'nullable|date',
            'nominal_total' => 'nullable|numeric',
            'dari_tujuan' => 'nullable|string',
            'aset_id' => 'nullable|exists:m_assets,id',
            'catatan' => 'nullable|string',
        ]);

        $keuangan->update($request->all());

        return response()->json($keuangan);
    }

    // Menghapus data keuangan berdasarkan id
    public function destroyKeuangan($id)
    {
        $keuangan = TblKeuangan::find($id);

        if (!$keuangan) {
            return response()->json(['message' => 'Data keuangan tidak ditemukan'], 404);
        }

        $keuangan->delete();

        return response()->json(['message' => 'Data keuangan berhasil dihapus']);
    }
}
