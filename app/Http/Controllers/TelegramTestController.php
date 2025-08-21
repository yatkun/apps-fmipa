<?php

namespace App\Http\Controllers;

use App\Services\TelegramNotificationService;
use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TelegramTestController extends Controller
{
    protected $telegramService;

    public function __construct()
    {
        $this->telegramService = new TelegramNotificationService();
    }

    /**
     * Test basic connection
     */
    public function testConnection()
    {
        $result = $this->telegramService->testConnection();
        
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Telegram notification sent successfully!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send Telegram notification.'
            ], 500);
        }
    }

    /**
     * Send daily summary
     */
    public function sendDailySummary()
    {
        $result = $this->telegramService->sendDailySummary();
        
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Daily summary sent successfully!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send daily summary.'
            ], 500);
        }
    }

    /**
     * Test notification for specific letter
     */
    public function testLetterNotification($letterId)
    {
        try {
            $letter = Letter::findByHashedIdOrFail($letterId);
            
            // Test different types of notifications based on letter status
            switch ($letter->status) {
                case 'verification_tendik':
                    $result = $this->telegramService->notifyLetterSubmitted($letter);
                    $message = 'Letter submission notification sent!';
                    break;
                    
                case 'verification_dekan':
                    $result = $this->telegramService->notifyLetterVerifiedByTendik($letter);
                    $message = 'Tendik verification notification sent!';
                    break;
                    
                case 'approved':
                    $result = $this->telegramService->notifyLetterApprovedByDekan($letter);
                    $message = 'Dekan approval notification sent!';
                    break;
                    
                case 'rejected':
                    $result = $this->telegramService->notifyLetterRejected($letter, 'Test');
                    $message = 'Letter rejection notification sent!';
                    break;
                    
                default:
                    return response()->json([
                        'success' => false,
                        'message' => 'Unknown letter status: ' . $letter->status
                    ], 400);
            }
            
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'letter_status' => $letter->status
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send notification.'
                ], 500);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show test interface
     */
    public function index()
    {
        // Get some sample letters for testing
        $letters = Letter::with(['creator', 'template'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('telegram-test', compact('letters'));
    }
}
