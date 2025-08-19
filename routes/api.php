<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\TernakController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\HargaPasarController;
use App\Http\Controllers\SuplierPakanController;
use App\Http\Controllers\KonsultasiPakarController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\AssetController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/hello', function (Request $request) {
    return response()->json([
        'message' => 'Hello, this is a simple inline GET API!',
        'status' => 'success',
        'data' => [
            'id' => 1,
            'name' => 'John Doe'
        ]
    ], 200);
});

// Example protected route (requires authentication)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {

    // Endpoint Tugas
    Route::get('/tugas', [TugasController::class, 'allTugas']);
    Route::get('/tugas/{user_id}', [TugasController::class, 'tugasUserAll']);
    Route::get('/tugas/{user_id}/{id}', [TugasController::class, 'tugasUser']);
    Route::post('/tugas', [TugasController::class, 'storeTugas']);
    Route::put('/tugas/{user_id}/{id}', [TugasController::class, 'updateTugas']);
    Route::delete('/tugas/{user_id}/{id}', [TugasController::class, 'destroyTugas']);

    // TODO: <MASIH DIPIKIRAN DULU>
    // Endpoint Tugas Pengulangan
    // Route::get('/tugas/pengulangan/{user_id}/{tugas_id}/{id}', [DummyController::class, 'pengulanganTugasUser']);
    // Route::post('/tugas', [DummyController::class, 'storeTugas']);
    // Route::put('/tugas/pengulangan/{user_id}/{tugas_id}/{id}', [DummyController::class, 'updatePengulanganTugas']);
    // Route::delete('/tugas/{user_id}/{id}', [DummyController::class, 'destroyTugas']);

    // Endpoint Ternak
    Route::get('/ternak', [TernakController::class, 'allTernak']);
    Route::get('/ternak/{user_id}', [TernakController::class, 'ternakUserAll']);
    Route::get('/ternak/{user_id}/{id}', [TernakController::class, 'ternakUser']);
    Route::post('/ternak', [TernakController::class, 'storeTernak']);
    Route::put('/ternak/{user_id}/{id}', [TernakController::class, 'updateTernak']);
    Route::delete('/ternak/{user_id}/{id}', [TernakController::class, 'destroyTernak']);

    // Endpoint Tips
    Route::get('/tips/kategoris', [TipsController::class, 'allKategoriTips']);
    Route::get('/tips', [TipsController::class, 'allTips']);
    Route::get('/tips/{id}', [TipsController::class, 'detailTips']);
    Route::post('/tips', [TipsController::class, 'storeTips']);
    Route::put('/tips/{id}', [TipsController::class, 'updateTips']);
    Route::delete('/tips/{id}', [TipsController::class, 'destroyTips']);

    // Endpoint Harga Pasar
    Route::get('/harga-pasar', [HargaPasarController::class, 'allHargaPasar']);
    Route::post('/harga-pasar', [HargaPasarController::class, 'storeHargaPasar']);
    Route::put('/harga-pasar/{id}', [HargaPasarController::class, 'updateHargaPasar']);
    Route::delete('/harga-pasar/{id}', [HargaPasarController::class, 'destroyHargaPasar']);

    // Endpoint Suplier Pakan
    Route::get('/suplier-pakan/kategoris', [SuplierPakanController::class, 'allKategoriSuplierPakan']);
    Route::get('/suplier-pakan', [SuplierPakanController::class, 'allSuplierPakan']);
    Route::post('/suplier-pakan', [SuplierPakanController::class, 'storeSuplierPakan']);
    Route::put('/suplier-pakan/{id}', [SuplierPakanController::class, 'updateSuplierPakan']);
    Route::delete('/suplier-pakan/{id}', [SuplierPakanController::class, 'destroySuplierPakan']);


    // Endpoint Konsultasi Pakar
    Route::get('/konsultasi-pakar/kategoris', [KonsultasiPakarController::class, 'allKonsultasi']);
    Route::get('/konsultasi-pakar', [KonsultasiPakarController::class, 'allKonsultasiPakar']);
    Route::post('/konsultasi-pakar', [KonsultasiPakarController::class, 'storeKonsultasiPakar']);
    Route::put('/konsultasi-pakar/{id}', [KonsultasiPakarController::class, 'updateKonsultasiPakar']);
    Route::delete('/konsultasi-pakar/{id}', [KonsultasiPakarController::class, 'destroyKonsultasiPakar']);

    // Endpoint Keuangan
    Route::get('/keuangan/{tipe}/total/{user_id}', [KeuanganController::class, 'totalKeuangan']);
    Route::get('/keuangan/{tipe}/{user_id}', [KeuanganController::class, 'dataKeuanganUser']);
    Route::post('/keuangan', [KeuanganController::class, 'storeKeuangan']);
    Route::put('/keuangan/{id}', [KeuanganController::class, 'updateKeuangan']);
    Route::delete('/keuangan/{id}', [KeuanganController::class, 'destroyKeuangan']);

    // Endpoint Asset
    Route::get('/asset/{user_id}', [AssetController::class, 'getAsset']);
    Route::post('/asset/{user_id}', [AssetController::class, 'storeAsset']);
    Route::put('/asset/{user_id}', [AssetController::class, 'updateAsset']);
    Route::delete('/asset/{user_id}', [AssetController::class, 'destroyAsset']);

    // Endpoint Tipe Tugas
    Route::get('/tugas/jenis/{user_id}', [TugasController::class, 'getJenisTugas']);
    Route::post('/tugas/jenis/{user_id}', [TugasController::class, 'storeJenisTugas']);
    Route::put('/tugas/jenis/{user_id}', [TugasController::class, 'updateJenisTugas']);
    Route::delete('/tugas/jenis/{user_id}', [TugasController::class, 'destroyJenisTugas']);

    // Endpoint Tujuan Ternak
    Route::get('/ternak/tujuan/{user_id}', [TernakController::class, 'getTujuanTernak']);
    Route::post('/ternak/tujuan/{user_id}', [TernakController::class, 'storeTujuanTernak']);
    Route::put('/ternak/tujuan/{user_id}', [TernakController::class, 'updateTujuanTernak']);
    Route::delete('/ternak/tujuan/{user_id}', [TernakController::class, 'destroyTujuanTernak']);
    
});
