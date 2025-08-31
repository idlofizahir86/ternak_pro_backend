<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AIRecommendationController extends Controller
{
    private $pythonServiceUrl;
    
    public function __construct()
    {
        $this->pythonServiceUrl = env('PYTHON_AI_SERVICE_URL', 'http://localhost:5000');
    }
    
    /**
     * Get livestock recommendation
     */
    public function getRecommendation(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'region' => 'required|string|max:100',
            'land_length' => 'required|numeric|min:1|max:1000',
            'land_width' => 'required|numeric|min:1|max:1000',
            'goal' => 'required|string|in:daging,telur,susu,bibit,lainnya',
            'available_feed' => 'required|array',
            'time_availability' => 'required|string|in:pagi,siang,sore,sepanjang_hari',
            'experience' => 'required|string|in:pemula,menengah,ahli'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            // Prepare data untuk Python service
            $inputData = [
                'region' => $request->region,
                'land_size' => $request->land_length * $request->land_width,
                'goal' => $request->goal,
                'available_feed' => implode('_', $request->available_feed),
                'time_availability' => $request->time_availability,
                'experience' => $request->experience
            ];
            
            Log::info('Sending request to Python AI service', ['data' => $inputData]);
            
            // Call Python AI service
            $response = Http::timeout(30)
                ->post($this->pythonServiceUrl . '/recommend', $inputData);
            
            if ($response->successful()) {
                $aiResponse = $response->json();
                
                return response()->json([
                    'success' => true,
                    'data' => $this->formatResponse($aiResponse, $inputData)
                ]);
                
            } else {
                Log::error('Python AI service error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'AI service temporarily unavailable. Please try again later.'
                ], 503);
            }
            
        } catch (\Exception $e) {
            Log::error('Recommendation error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to get recommendation. Please try again.'
            ], 500);
        }
    }
    
    /**
     * Format response untuk frontend
     */
    private function formatResponse(array $aiData, array $inputData): array
    {
        $animalType = $aiData['recommended_animal'];
        $animalDetails = $aiData['animal_details'] ?? [];
        
        return [
            'jenis_hewan' => $animalDetails['name'] ?? $this->getAnimalName($animalType),
            'alasan' => $this->generateExplanation($animalType, $inputData, $aiData),
            'biaya_awal' => $animalDetails['initial_cost'] ?? 0,
            'potensi_keuntungan' => ($animalDetails['initial_cost'] ?? 0) * $aiData['roi'],
            'roi' => round($aiData['roi'] * 100, 2),
            'kesesuaian_kondisi' => round($aiData['success_rate'] * 100, 2),
            'permintaan_pasar' => round($aiData['market_demand'] * 100, 2),
            'deskripsi' => $animalDetails['description'] ?? '',
            'kebutuhan_pakan' => $animalDetails['feed_requirements'] ?? [],
            'resiko_kesehatan' => $animalDetails['health_risks'] ?? [],
            'tips' => $animalDetails['tips'] ?? []
        ];
    }
    
    /**
     * Generate explanation untuk rekomendasi
     */
    private function generateExplanation(string $animalType, array $inputData, array $aiData): string
    {
        $explanations = [
            'ayam_pedaging' => "Ayam pedaging sangat cocok untuk lahan {$inputData['land_size']}m² dengan pengalaman {$inputData['experience']}. Memiliki ROI {$aiData['roi']} dan permintaan pasar yang tinggi.",
            'ayam_petelur' => "Ayam petelur ideal untuk tujuan {$inputData['goal']} dengan kesesuaian kondisi {$aiData['success_rate']}. Memberikan penghasilan rutin dari telur.",
            'sapi_potong' => "Sapi potong direkomendasikan untuk lahan yang luas dengan potensi keuntungan besar. ROI mencapai {$aiData['roi']}%.",
            'kambing' => "Kambing cocok untuk peternak dengan pengalaman menengah. Permintaan pasar stabil dan perawatan relatif mudah.",
            'sapi_perah' => "Sapi perah memberikan keuntungan dari susu dengan permintaan pasar yang konsisten.",
            'default' => "Berdasarkan analisis kondisi Anda, {$animalType} direkomendasikan dengan potensi keuntungan optimal."
        ];
        
        return $explanations[$animalType] ?? $explanations['default'];
    }
    
    /**
     * Get animal name from type
     */
    private function getAnimalName(string $animalType): string
    {
        $names = [
            'ayam_pedaging' => 'Ayam Pedaging',
            'ayam_petelur' => 'Ayam Petelur',
            'sapi_potong' => 'Sapi Potong',
            'kambing' => 'Kambing',
            'sapi_perah' => 'Sapi Perah',
            'bebek' => 'Bebek',
            'domba' => 'Domba'
        ];
        
        return $names[$animalType] ?? 'Ternak';
    }
    
    /**
     * Health check endpoint
     */
    public function healthCheck()
    {
        try {
            $response = Http::timeout(10)->get($this->pythonServiceUrl . '/health');
            
            return response()->json([
                'laravel' => 'healthy',
                'python_ai_service' => $response->successful() ? 'healthy' : 'unhealthy',
                'python_response' => $response->json()
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'laravel' => 'healthy',
                'python_ai_service' => 'unhealthy',
                'error' => $e->getMessage()
            ], 503);
        }
    }
}