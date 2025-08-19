<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblTernak;
use App\Models\MTujuanTernak;

class TernakController extends Controller
{
    // Mengambil semua ternak
    public function allTernak()
    {
        $ternak = TblTernak::all();
        return response()->json($ternak);
    }

    // Mengambil semua ternak berdasarkan user_id
    public function ternakUserAll($user_id)
    {
        $ternak = TblTernak::where('user_id', $user_id)->get();
        return response()->json($ternak);
    }

    // Mengambil ternak berdasarkan user_id dan id
    public function ternakUser($user_id, $id)
    {
        $ternak = TblTernak::where('user_id', $user_id)->where('id', $id)->first();

        if ($ternak) {
            return response()->json($ternak);
        } else {
            return response()->json(['message' => 'Ternak tidak ditemukan'], 404);
        }
    }

    // Menyimpan ternak baru
    public function storeTernak(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,uid',
            'nama_ternak' => 'required|string',
            'tgl_mulai' => 'required|date',
            'hewan_id' => 'required|exists:m_hewan,id',
            'ras_id' => 'required|exists:m_ras,id',
            'tujuan_ternak_id' => 'required|exists:m_tujuan_ternak,id',
            'usia' => 'required|integer',
            'kondisi_ternak' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'berat' => 'required|numeric',
            'catatan' => 'nullable|string',
        ]);

        $ternak = TblTernak::create($request->all());

        return response()->json($ternak, 201);
    }

    // Mengupdate ternak berdasarkan user_id dan id
    public function updateTernak(Request $request, $user_id, $id)
    {
        $ternak = TblTernak::where('user_id', $user_id)->where('id', $id)->first();

        if (!$ternak) {
            return response()->json(['message' => 'Ternak tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_ternak' => 'nullable|string',
            'tgl_mulai' => 'nullable|date',
            'hewan_id' => 'nullable|exists:m_hewan,id',
            'ras_id' => 'nullable|exists:m_ras,id',
            'tujuan_ternak_id' => 'nullable|exists:m_tujuan_ternak,id',
            'usia' => 'nullable|integer',
            'kondisi_ternak' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string',
            'berat' => 'nullable|numeric',
            'catatan' => 'nullable|string',
        ]);

        $ternak->update($request->all());

        return response()->json($ternak);
    }

    // Menghapus ternak berdasarkan user_id dan id
    public function destroyTernak($user_id, $id)
    {
        $ternak = TblTernak::where('user_id', $user_id)->where('id', $id)->first();

        if (!$ternak) {
            return response()->json(['message' => 'Ternak tidak ditemukan'], 404);
        }

        $ternak->delete();

        return response()->json(['message' => 'Ternak berhasil dihapus']);
    }

    // Mengambil tujuan ternak berdasarkan user_id
    public function getTujuanTernak($user_id)
    {
        $tujuanTernak = MTujuanTernak::where('user_id', $user_id)->get();
        return response()->json($tujuanTernak);
    }

    // Menyimpan tujuan ternak baru berdasarkan user_id
    public function storeTujuanTernak(Request $request, $user_id)
    {
        $request->validate([
            'nama' => 'required|string',
        ]);

        $tujuanTernak = new MTujuanTernak();
        $tujuanTernak->user_id = $user_id;
        $tujuanTernak->nama = $request->nama;
        $tujuanTernak->save();

        return response()->json($tujuanTernak, 201);
    }

    // Mengupdate tujuan ternak berdasarkan user_id
    public function updateTujuanTernak(Request $request, $user_id)
    {
        $tujuanTernak = MTujuanTernak::where('user_id', $user_id)->first();

        if (!$tujuanTernak) {
            return response()->json(['message' => 'Tujuan Ternak tidak ditemukan'], 404);
        }

        $request->validate([
            'nama' => 'nullable|string',
        ]);

        $tujuanTernak->update($request->all());

        return response()->json($tujuanTernak);
    }

    // Menghapus tujuan ternak berdasarkan user_id
    public function destroyTujuanTernak($user_id)
    {
        $tujuanTernak = MTujuanTernak::where('user_id', $user_id)->first();

        if (!$tujuanTernak) {
            return response()->json(['message' => 'Tujuan Ternak tidak ditemukan'], 404);
        }

        $tujuanTernak->delete();

        return response()->json(['message' => 'Tujuan Ternak berhasil dihapus']);
    }
}
