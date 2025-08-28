<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIChatController extends Controller
{
    private $apiKey;
    private $apiUrl = 'https://api.deepseek.com/v1/chat/completions';
    
    public function __construct()
    {
        $this->apiKey = env('DEEPSEEK_API_KEY');
    }
    
    /**
     * Send message to AI and get response
     */
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,uid',
            'message' => 'required|string',
            'conversation_id' => 'nullable|exists:conversations,id'
        ]);
        
        try {
            $user = auth()->user();
            
            // Get or create conversation
            if (empty($validated['conversation_id'])) {
                $conversation = Conversation::create([
                    'user_id' => $validated['user_id'],
                    'title' => substr($validated['message'], 0, 50) . '...'
                ]);
            } else {
                $conversation = Conversation::where('user_id', $user->id)
                    ->findOrFail($validated['conversation_id']);
            }
            
            // Save user message
            $userMessage = Message::create([
                'conversation_id' => $conversation->id,
                'role' => 'user',
                'content' => $validated['message']
            ]);
            
            // Get last 5 messages for context
            $recentMessages = $conversation->recentMessages()
                ->orderBy('created_at', 'asc')
                ->get();
            
            // Prepare messages for AI
            $messages = [
                ['role' => 'system', 'content' => $this->getSystemPrompt()]
            ];
            
            foreach ($recentMessages as $msg) {
                $messages[] = [
                    'role' => $msg->role,
                    'content' => $msg->content
                ];
            }
            
            // Call DeepSeek API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($this->apiUrl, [
                'model' => 'deepseek-chat',
                'messages' => $messages,
                'temperature' => 0.7,
                'max_tokens' => 1000,
                'stream' => false
            ]);
            
            if ($response->successful()) {
                $responseData = $response->json();
                $aiResponse = $responseData['choices'][0]['message']['content'];
                $tokenUsage = $responseData['usage']['total_tokens'];
                
                // Save AI response
                $aiMessage = Message::create([
                    'conversation_id' => $conversation->id,
                    'role' => 'assistant',
                    'content' => $aiResponse,
                    'token_usage' => $tokenUsage
                ]);
                
                return response()->json([
                    'conversation_id' => $conversation->id,
                    'response' => $aiResponse,
                    'usage' => $responseData['usage']
                ]);
                
            } else {
                Log::error('DeepSeek API Error: ' . $response->body());
                return response()->json([
                    'error' => 'AI service temporarily unavailable',
                    'message' => 'Please try again later'
                ], 503);
            }
            
        } catch (\Exception $e) {
            Log::error('Chat Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Chat service unavailable',
                'message' => $e->getMessage()
            ], 503);
        }
    }
    
    /**
     * Start new conversation
     */
    public function startNewConversation(Request $request)
    {
        $user = auth()->user();
        
        $conversation = Conversation::create([
            'user_id' => $user->id,
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
    public function getConversations()
    {
        $user = auth()->user();
        
        $conversations = Conversation::where('user_id', $user->id)
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
    public function deleteConversation($conversationId)
    {
        $user = auth()->user();
        
        $conversation = Conversation::where('user_id', $user->id)
            ->findOrFail($conversationId);
        
        $conversation->delete();
        
        return response()->json(['message' => 'Conversation deleted']);
    }
    
    /**
     * System prompt for AI
     */
    private function getSystemPrompt()
    {
        return "Anda adalah asisten virtual ahli peternakan untuk aplikasi TernakPro. 
        Berikan jawaban yang akurat, informatif, dan mudah dipahami tentang peternakan.
        
        Aturan:
        1. Gunakan bahasa Indonesia yang jelas dan santun
        2. Fokus pada topik peternakan saja
        3. Berikan jawaban praktis dan aplikatif
        4. Jika tidak tahu, jangan mengada-ada
        5. Maximum 3 paragraf per jawaban
        
        Topik yang dikuasai:
        - Ayam (petelur, pedaging, kampung)
        - Sapi (perah, potong)
        - Kambing, domba
        - Bebek, itik
        - Pakan dan nutrisi
        - Kesehatan ternak
        - Manajemen kandang
        - Bisnis peternakan";
    }
}