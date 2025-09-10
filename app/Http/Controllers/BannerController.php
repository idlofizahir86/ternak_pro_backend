<?php

namespace App\Http\Controllers;

use App\Models\TBanner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Get active banners
     */
    public function getActiveBanners()
    {
        // Ambil semua banner dengan is_aktif = 1, urutkan berdasarkan created_at DESC
        $banners = TBanner::where('is_aktif', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // Cek apakah ada data
        if ($banners->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No active banners found'
            ], 404);
        }

        // Mengembalikan response JSON
        return response()->json([
            'success' => true,
            'data' => $banners
        ]);
    }
}
