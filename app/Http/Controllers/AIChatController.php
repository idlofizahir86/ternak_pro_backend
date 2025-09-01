<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr; // Helper Laravel untuk array

class AIChatController extends Controller
{
    private $apiKey;
    private $searchApiKey;
    private $searchCx;
    private $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent';

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
        $this->searchApiKey = env('GOOGLE_SEARCH_API_KEY');
        $this->searchCx = env('GOOGLE_SEARCH_CX');
    }

    /**
     * Send message to AI and get response, with Search capability (Function Calling).
     */
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,uid',
            'message' => 'required|string',
            'conversation_id' => 'nullable|exists:conversations,id'
        ]);

        try {
            // Get or create conversation
            if (empty($validated['conversation_id'])) {
                $conversation = Conversation::create([
                    'user_id' => $validated['user_id'],
                    'title' => substr($validated['message'], 0, 50) . '...'
                ]);
            } else {
                $conversation = Conversation::findOrFail($validated['conversation_id']);
            }

            // Save user message
            Message::create([
                'conversation_id' => $conversation->id,
                'role' => 'user',
                'content' => $validated['message']
            ]);

            // Get recent messages for context
            $recentMessages = $conversation->recentMessages()->orderBy('created_at', 'asc')->get();
            $geminiMessages = $this->prepareMessagesForGemini($recentMessages);

            // 1. Definisikan "Tool" yang bisa digunakan Gemini untuk mencari di web
            $tools = [
                [
                    'function_declarations' => [
                        [
                            'name' => 'search_web',
                            'description' => 'Mencari informasi faktual, terkini, atau spesifik dari internet jika pertanyaan tidak bisa dijawab dari pengetahuan internal.',
                            'parameters' => [
                                'type' => 'OBJECT',
                                'properties' => [
                                    'query' => [
                                        'type' => 'STRING',
                                        'description' => 'Kata kunci pencarian yang relevan dan spesifik untuk Google.'
                                    ]
                                ],
                                'required' => ['query']
                            ]
                        ]
                    ]
                ]
            ];

            // 2. Kirim request pertama ke Gemini dengan tool yang sudah didefinisikan
            $response = Http::timeout(60)->post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => $geminiMessages,
                'tools' => $tools,
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 1500,
                ]
            ]);

            $responseData = $response->json();

            // 3. Cek apakah Gemini meminta kita untuk memanggil fungsi (melakukan search)
            $functionCall = Arr::get($responseData, 'candidates.0.content.parts.0.functionCall');

            // Inisialisasi $aiResponse di sini
            $aiResponse = Arr::get($responseData, 'candidates.0.content.parts.0.text', 'Maaf, saya tidak bisa memberikan jawaban saat ini. Coba tanyakan hal lain.');
            $firstCallTokenCount = Arr::get($responseData, 'usageMetadata.totalTokenCount', 0);
            $totalTokenUsage = $firstCallTokenCount; // Mulai dengan token dari panggilan pertama

            if ($functionCall && $functionCall['name'] === 'search_web') {
                // Gemini meminta kita untuk mencari sesuatu!
                $searchQuery = $functionCall['args']['query'];
                Log::info('Gemini requested a search with query: ' . $searchQuery);
                
                $searchResults = $this->performGoogleSearch($searchQuery);

                // Tambahkan histori "permintaan" dari Gemini dan "jawaban" dari tool kita
                $geminiMessages[] = ['role' => 'model', 'parts' => [['functionCall' => $functionCall]]];
                $geminiMessages[] = [
                    'role' => 'function',
                    'parts' => [[
                        'functionResponse' => [
                            'name' => 'search_web',
                            'response' => ['content' => $searchResults]
                        ]
                    ]]
                ];

                // 4. Kirim request kedua ke Gemini, kali ini dengan hasil pencarian
                $response = Http::timeout(60)->post($this->apiUrl . '?key=' . $this->apiKey, [
                    'contents' => $geminiMessages,
                    'tools' => $tools, // Penting: Tetap sertakan tools pada panggilan kedua!
                ]);
                $responseData = $response->json();

                // Perbarui $aiResponse dan $tokenUsage dari respons kedua
                $aiResponse = Arr::get($responseData, 'candidates.0.content.parts.0.text', 'Maaf, saya tidak bisa memberikan jawaban saat ini. Coba tanyakan hal lain.');
                
                 // Tambahkan token dari panggilan kedua ke total
                $secondCallTokenCount = Arr::get($responseData, 'usageMetadata.totalTokenCount', 0);
                $totalTokenUsage += $secondCallTokenCount;
            }

            // 5. Proses jawaban final dari Gemini (sudah diperbarui jika ada functionCall)
            if ($response->successful()) {
                // $aiResponse dan $tokenUsage sudah diatur dengan benar di atas
                
                // Save AI response
                Message::create([
                    'conversation_id' => $conversation->id,
                    'role' => 'assistant',
                    'content' => $aiResponse,
                    'token_usage' => $totalTokenUsage // Gunakan total token usage jika dihitung
                ]);

                return response()->json([
                    'conversation_id' => $conversation->id,
                    'response' => $aiResponse,
                    'usage' => $totalTokenUsage // Ini mungkin hanya usage dari panggilan terakhir
                ]);

            } else {
                Log::error('Gemini API Error: ' . $response->body());
                return response()->json([
                    'error' => 'AI service temporarily unavailable',
                    'message' => $response->json()['error']['message'] ?? 'Please try again later'
                ], 503);
            }

        } catch (\Exception $e) {
            Log::error('Chat Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            return response()->json(['error' => 'An unexpected error occurred.', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Start new conversation
     */
    public function startNewConversation(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,uid',
        ]);

        $conversation = Conversation::create([
            'user_id' => $validated['user_id'],
            'title' => 'Percakapan Baru'
        ]);

        return response()->json([
            'conversation_id' => $conversation->id,
            'title' => $conversation->title
        ]);
    }

    /**
     * Get user's conversations
     */
    public function getConversations(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,uid',
        ]);

        $conversations = Conversation::where('user_id', $validated['user_id'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()->json($conversations);
    }

    /**
     * Get specific conversation with messages
     */
    public function getConversation($userId, $conversationId)
    {
        $conversation = Conversation::where('user_id', $userId)
            ->with(['messages' => function($query) {
                $query->orderBy('created_at', 'asc');
            }])
            ->findOrFail($conversationId);

        return response()->json($conversation);
    }

    /**
     * Delete conversation
     */
    public function deleteConversation($userId, $conversationId)
    {
        $conversation = Conversation::where('user_id', $userId)
            ->findOrFail($conversationId);

        $conversation->delete();

        return response()->json(['message' => 'Conversation deleted']);
    }

    // ===================================================================
    // HELPER FUNCTIONS
    // ===================================================================

    /**
     * Helper function to perform search using Google Custom Search API.
     */
    private function performGoogleSearch(string $query): string
    {
        if (empty($this->searchApiKey) || empty($this->searchCx)) {
            Log::warning('Google Search API key or CX is not set.');
            return "Pencarian tidak dapat dilakukan karena konfigurasi API tidak lengkap.";
        }

        $searchUrl = "https://www.googleapis.com/customsearch/v1";

        try {
            $response = Http::get($searchUrl, [
                'key' => $this->searchApiKey,
                'cx' => $this->searchCx,
                'q' => $query,
                'num' => 3 // Ambil 3 hasil teratas saja
            ]);

            if ($response->successful()) {
                $results = $response->json();
                $snippets = [];
                if (empty($results['items'])) {
                    return "Tidak ditemukan hasil pencarian yang relevan untuk: " . $query;
                }
                foreach ($results['items'] as $item) {
                    $snippets[] = $item['title'] . ": " . ($item['snippet'] ?? 'Tidak ada deskripsi.');
                }
                return implode("\n\n", $snippets);
            }
            Log::error('Google Search API request failed: ' . $response->body());
            return "Pencarian gagal dengan status: " . $response->status();
        } catch (\Exception $e) {
            Log::error('Google Search API connection error: ' . $e->getMessage());
            return "Gagal terhubung ke layanan pencarian.";
        }
    }
    
    /**
     * Helper to prepare messages from DB to Gemini API format.
     */
    private function prepareMessagesForGemini($messages)
    {
        $geminiMessages = [];
        // System prompt disimulasikan sebagai pesan pertama dari user dan dijawab oleh model
        $geminiMessages[] = ['role' => 'user', 'parts' => [['text' => $this->getSystemPrompt()]]];
        $geminiMessages[] = ['role' => 'model', 'parts' => [['text' => 'Baik, saya mengerti. Saya adalah asisten ahli peternakan untuk aplikasi TernakPro. Saya siap membantu.']]];

        foreach ($messages as $msg) {
            // Konversi role 'assistant' di database menjadi 'model' untuk API
            $role = ($msg->role === 'assistant') ? 'model' : 'user';
            $geminiMessages[] = [
                'role' => $role,
                'parts' => [['text' => $msg->content]]
            ];
        }
        return $geminiMessages;
    }

    /**
     * System prompt for AI
     */
    private function getSystemPrompt()
    {
        return "Anda adalah asisten virtual ahli peternakan untuk aplikasi TernakPro bernama SITERNAK. 
        Berikan jawaban yang akurat, informatif, dan mudah dipahami tentang peternakan.
        
        Aturan:
        1. Gunakan bahasa Indonesia yang jelas dan santun
        2. Fokus pada topik peternakan saja
        3. Berikan jawaban praktis dan aplikatif
        4. Jika tidak tahu, jangan mengada-ada. Minta pengguna untuk bertanya dengan lebih spesifik.
        5. Jika Anda memerlukan data terkini atau fakta spesifik (seperti harga, regulasi, berita wabah), gunakan fungsi pencarian yang tersedia. Jangan berasumsi.
        6. Jawaban harus ringkas dan jelas, maksimal 3-4 paragraf.
        
        Topik yang dikuasai:
        - Ayam (petelur, pedaging, kampung)
        - Sapi (perah, potong)
        - Kambing, domba
        - Pakan dan nutrisi
        - Kesehatan ternak dan penyakit umum
        - Manajemen kandang
        - Bisnis dan analisis usaha peternakan";
    }
}