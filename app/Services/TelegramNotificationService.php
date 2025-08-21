<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Letter;

class TelegramNotificationService
{
    private $botToken;
    private $defaultChatId; // Rename untuk clarity

    public function __construct()
    {
        $this->botToken = env('TELEGRAM_BOT_TOKEN');
       
    }

    public function sendMessage($message, $parseMode = 'Markdown', $customChatId = null)
    {
        try {
            $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";
            $chatId = $customChatId ?? $this->defaultChatId; // Gunakan default jika tidak ada custom
            
            $response = Http::post($url, [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => $parseMode,
                'disable_web_page_preview' => true
            ]);

            if ($response->successful()) {
                Log::info('Telegram notification sent successfully', [
                    'chat_id' => $chatId,
                    'custom_chat' => $customChatId ? true : false
                ]);
                return true;
            } else {
                Log::error('Failed to send Telegram notification', [
                    'chat_id' => $chatId,
                    'response' => $response->json()
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Telegram notification error: ' . $e->getMessage());
            return false;
        }
    }

    public function sendDocument($filePath, $caption = '', $parseMode = 'Markdown', $customChatId = null)
    {
        try {
            $url = "https://api.telegram.org/bot{$this->botToken}/sendDocument";
            $chatId = $customChatId ?? $this->defaultChatId; // Gunakan default jika tidak ada custom
            
            // Validasi file exists
            if (!file_exists($filePath)) {
                Log::error('File not found for Telegram document send', ['file_path' => $filePath]);
                return false;
            }

            // Validasi ukuran file (max 50MB untuk Telegram)
            $fileSize = filesize($filePath);
            if ($fileSize > 50 * 1024 * 1024) {
                Log::error('File too large for Telegram (max 50MB)', [
                    'file_path' => $filePath,
                    'file_size' => $fileSize
                ]);
                return false;
            }

            // Kirim dokumen menggunakan multipart
            $response = Http::attach(
                'document', file_get_contents($filePath), basename($filePath)
            )->post($url, [
                'chat_id' => $chatId,
                'caption' => $caption,
                'parse_mode' => $parseMode
            ]);

            if ($response->successful()) {
                Log::info('Telegram document sent successfully', [
                    'chat_id' => $chatId,
                    'file_path' => $filePath,
                    'file_size' => $fileSize,
                    'custom_chat' => $customChatId ? true : false
                ]);
                return true;
            } else {
                Log::error('Failed to send Telegram document', [
                    'chat_id' => $chatId,
                    'file_path' => $filePath,
                    'response' => $response->json()
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Telegram document send error: ' . $e->getMessage(), [
                'file_path' => $filePath
            ]);
            return false;
        }
    }

    public function sendDocumentFromGoogleDrive($googleDrivePath, $caption = '', $parseMode = 'Markdown', $customChatId = null)
    {
        try {
            // Download file from Google Drive to temporary location
            if (!Storage::disk('google')->exists($googleDrivePath)) {
                Log::error('File not found in Google Drive', ['path' => $googleDrivePath]);
                return false;
            }

            $content = Storage::disk('google')->get($googleDrivePath);
            
            // Create temporary file
            $tempFileName = 'temp_telegram_' . time() . '_' . basename($googleDrivePath);
            $tempFilePath = storage_path('app/temp/' . $tempFileName);
            
            // Ensure temp directory exists
            if (!file_exists(dirname($tempFilePath))) {
                mkdir(dirname($tempFilePath), 0755, true);
            }
            
            // Save content to temp file
            if (file_put_contents($tempFilePath, $content) === false) {
                Log::error('Failed to create temporary file for Telegram send');
                return false;
            }

            // Send document
            $result = $this->sendDocument($tempFilePath, $caption, $parseMode, $customChatId);
            
            // Cleanup temporary file
            if (file_exists($tempFilePath)) {
                unlink($tempFilePath);
            }
            
            return $result;
            
        } catch (\Exception $e) {
            Log::error('Telegram Google Drive document send error: ' . $e->getMessage(), [
                'google_drive_path' => $googleDrivePath
            ]);
            return false;
        }
    }

    public function notifyNewSubmission(Letter $letter)
    {
        // Get user's telegram chat ID
        $userChatId = $letter->creator->telegram_chat_id;
        
        $message = "📝 *SURAT BARU DIAJUKAN*\n\n";
        $message .= "📄 *Judul:* {$letter->title}\n";
        $message .= "👤 *Pengaju:* {$letter->creator->name}\n";
        $message .= "📅 *Tanggal Pengajuan:* " . $letter->created_at->format('d M Y H:i') . "\n";
        $message .= "🔄 *Status:* Menunggu Verifikasi Tendik\n\n";
        $message .= "🔗 [Lihat Detail Surat](" . route('verify.by.tendik', $letter->hashed_id) . ")";

        // Kirim ke chat pribadi user jika ada chat ID, jika tidak kirim ke grup monitoring
        $targetChatId = $userChatId ?: null;
        $result = $this->sendMessage($message, 'Markdown', $targetChatId);
        
        // Kirim notifikasi ke grup monitoring juga (untuk Tendik)
        $groupMessage = "📢 *NOTIFIKASI GRUP - SURAT BARU*\n\n";
        $groupMessage .= "📄 *Judul:* {$letter->title}\n";
        $groupMessage .= "👤 *Pengaju:* {$letter->creator->name}\n";
        $groupMessage .= "📅 *Tanggal:* " . $letter->created_at->format('d M Y H:i') . "\n";
        $groupMessage .= "🔄 *Status:* Menunggu Verifikasi Tendik\n";
        $groupMessage .= "🔗 [Verifikasi Sekarang](" . route('verify.by.tendik', $letter->hashed_id) . ")";
        $this->sendMessage($groupMessage); // Kirim ke grup default
        
        return $result;
    }

    public function notifyLetterSubmitted(Letter $letter)
    {
        return $this->notifyNewSubmission($letter);
    }

    public function notifyLetterVerifiedByTendik(Letter $letter)
    {
        $dataFilled = is_string($letter->data_filled) 
            ? json_decode($letter->data_filled, true) 
            : $letter->data_filled;
        $noSurat = $dataFilled['no_surat'] ?? 'Belum ada nomor';
        
        // Get user's telegram chat ID
        $userChatId = $letter->creator->telegram_chat_id;
        
        $message = "✅ *SURAT DIVERIFIKASI TENDIK*\n\n";
        $message .= "📄 *Judul:* {$letter->title}\n";
        $message .= "📋 *No. Surat:* `{$noSurat}`\n";
        $message .= "👤 *Pengaju:* {$letter->creator->name}\n";
        $message .= "🛡️ *Diverifikasi oleh:* {$letter->tendikVerifier->name}\n";
        
        if ($letter->tendik_notes) {
            $message .= "📝 *Catatan:* {$letter->tendik_notes}\n";
        }
        
        $message .= "📅 *Tanggal Verifikasi:* " . $letter->verified_at_tendik->format('d M Y H:i') . "\n";
        $message .= "⏳ *Status:* Menunggu Persetujuan Dekan\n\n";
        $message .= "🔗 [Lihat Detail Surat](" . route('letters.show', $letter->hashed_id) . ")";

        // Kirim ke chat pribadi user jika ada chat ID, jika tidak kirim ke grup monitoring
        $targetChatId = $userChatId ?: null;
        $result = $this->sendMessage($message, 'Markdown', $targetChatId);
        
        // Kirim notifikasi ke grup monitoring juga (untuk Dekan)
        if ($userChatId) {
            $groupMessage = "📢 *NOTIFIKASI GRUP - SURAT DIVERIFIKASI*\n\n";
            $groupMessage .= "✅ Surat telah diverifikasi Tendik\n";
            $groupMessage .= "👤 *Pengaju:* {$letter->creator->name}\n";
            $groupMessage .= "📄 *Judul:* {$letter->title}\n";
            $groupMessage .= "📋 *No. Surat:* `{$noSurat}`\n";
            $groupMessage .= "⏳ Menunggu persetujuan Dekan\n";
            $this->sendMessage($groupMessage); // Kirim ke grup default
        }
        
        return $result;
    }

    public function notifyLetterApprovedByDekan(Letter $letter)
    {
        $dataFilled = is_string($letter->data_filled) 
            ? json_decode($letter->data_filled, true) 
            : $letter->data_filled;
        $noSurat = $dataFilled['no_surat'] ?? 'Belum ada nomor';
        
        // Get user's telegram chat ID
        $userChatId = $letter->creator->telegram_chat_id;
        
        // Send notification message first
        $message = "🎉 *SURAT DISETUJUI DEKAN*\n\n";
        $message .= "📄 *Judul:* {$letter->title}\n";
        $message .= "📋 *No. Surat:* `{$noSurat}`\n";
        $message .= "👤 *Pengaju:* {$letter->creator->name}\n";
        $message .= "👨‍💼 *Disetujui oleh:* {$letter->dekanVerifier->name}\n";
        
        if ($letter->dekan_notes) {
            $message .= "📝 *Catatan:* {$letter->dekan_notes}\n";
        }
        
        $message .= "📅 *Tanggal Persetujuan:* " . $letter->verified_at_dekan->format('d M Y H:i') . "\n";
        $message .= "✅ *Status:* DISETUJUI\n\n";
        $message .= "📄 Dokumen surat akan dikirim berikutnya...";

        // Send to user's personal chat if available, otherwise send to default group
        $targetChatId = $userChatId ?: null;
        $messageResult = $this->sendMessage($message, 'Markdown', $targetChatId);
        
        // Also send to default group chat for monitoring
        if ($userChatId) {
            $groupMessage = "📢 *NOTIFIKASI GRUP*\n\n";
            $groupMessage .= "🎉 Surat telah disetujui Dekan dan dikirim ke pengguna\n";
            $groupMessage .= "👤 *Pengguna:* {$letter->creator->name}\n";
            $groupMessage .= "📄 *Judul:* {$letter->title}\n";
            $groupMessage .= "📋 *No. Surat:* `{$noSurat}`\n";
            $this->sendMessage($groupMessage);
        }
        
        // Try to send the document
        $documentResult = false;
        if ($letter->file_path) {
            // Prepare document caption
            $documentCaption = "📄 *Surat Disetujui*\n";
            $documentCaption .= "🏷️ {$letter->title}\n";
            $documentCaption .= "📋 No: `{$noSurat}`\n";
            $documentCaption .= "👤 {$letter->creator->name}\n";
            $documentCaption .= "📅 " . $letter->verified_at_dekan->format('d M Y');
            
            // Check if file is in Google Drive or local storage
            if (str_starts_with($letter->file_path, 'Surat/')) {
                // File is in Google Drive
                Log::info('Sending document from Google Drive', [
                    'letter_id' => $letter->id,
                    'file_path' => $letter->file_path,
                    'target_chat_id' => $targetChatId
                ]);
                $documentResult = $this->sendDocumentFromGoogleDrive($letter->file_path, $documentCaption, 'Markdown', $targetChatId);
            } else {
                // File is in local storage
                $localFilePath = Storage::disk('public')->path($letter->file_path);
                if (file_exists($localFilePath)) {
                    Log::info('Sending document from local storage', [
                        'letter_id' => $letter->id,
                        'file_path' => $localFilePath,
                        'target_chat_id' => $targetChatId
                    ]);
                    $documentResult = $this->sendDocument($localFilePath, $documentCaption, 'Markdown', $targetChatId);
                } else {
                    Log::warning('Local file not found for document send', [
                        'letter_id' => $letter->id,
                        'file_path' => $localFilePath
                    ]);
                }
            }
            
            // Send fallback message if document send failed
            if (!$documentResult) {
                $fallbackMessage = "⚠️ Dokumen tidak dapat dikirim otomatis.\n";
                $fallbackMessage .= "🔗 [Unduh Surat](" . route('letters.show', $letter->hashed_id) . ")";
                $this->sendMessage($fallbackMessage, 'Markdown', $targetChatId);
            }
        }

        return $messageResult;
    }

    public function notifyLetterRejected(Letter $letter, $rejectedBy = 'Tendik')
    {
        // Get user's telegram chat ID
        $userChatId = $letter->creator->telegram_chat_id;
        
        $message = "❌ *SURAT DITOLAK*\n\n";
        $message .= "📄 *Judul:* {$letter->title}\n";
        $message .= "👤 *Pengaju:* {$letter->creator->name}\n";
        $message .= "🚫 *Ditolak oleh:* {$rejectedBy}\n";
        
        if ($letter->rejection_reason) {
            $message .= "📝 *Alasan Penolakan:* {$letter->rejection_reason}\n";
        }
        
        $message .= "📅 *Tanggal Penolakan:* " . now()->format('d M Y H:i') . "\n";
        $message .= "🔄 *Status:* DITOLAK\n\n";
        $message .= "🔗 [Lihat Detail Surat](" . route('letters.show', $letter->hashed_id) . ")";

        // Kirim ke chat pribadi user jika ada chat ID, jika tidak kirim ke grup monitoring
        $targetChatId = $userChatId ?: null;
        $result = $this->sendMessage($message, 'Markdown', $targetChatId);
        
        // Kirim notifikasi ke grup monitoring juga
        if ($userChatId) {
            $groupMessage = "📢 *NOTIFIKASI GRUP - SURAT DITOLAK*\n\n";
            $groupMessage .= "❌ Surat telah ditolak oleh {$rejectedBy}\n";
            $groupMessage .= "👤 *Pengaju:* {$letter->creator->name}\n";
            $groupMessage .= "📄 *Judul:* {$letter->title}\n";
            if ($letter->rejection_reason) {
                $groupMessage .= "📝 *Alasan:* {$letter->rejection_reason}\n";
            }
            $this->sendMessage($groupMessage); // Kirim ke grup default
        }
        
        return $result;
    }

    public function sendDailySummary()
    {
        $today = now()->format('Y-m-d');
        
        $pendingTendik = Letter::where('status', 'verification_tendik')->count();
        $pendingDekan = Letter::where('status', 'verification_dekan')->count();
        $approvedToday = Letter::where('status', 'approved')
            ->whereDate('verified_at_dekan', $today)
            ->count();
        $rejectedToday = Letter::where('status', 'rejected')
            ->whereDate('updated_at', $today)
            ->count();

        $message = "📊 *RINGKASAN HARIAN SURAT*\n";
        $message .= "📅 " . now()->format('d M Y') . "\n\n";
        $message .= "⏳ *Menunggu Verifikasi Tendik:* {$pendingTendik}\n";
        $message .= "⏳ *Menunggu Persetujuan Dekan:* {$pendingDekan}\n";
        $message .= "✅ *Disetujui Hari Ini:* {$approvedToday}\n";
        $message .= "❌ *Ditolak Hari Ini:* {$rejectedToday}\n\n";
        $message .= "📈 *Total Pending:* " . ($pendingTendik + $pendingDekan);

        return $this->sendMessage($message);
    }

    public function testConnection()
    {
        $message = "🤖 *Test Koneksi Bot*\n\n";
        $message .= "✅ Bot berfungsi dengan baik!\n";
        $message .= "📅 " . now()->format('d M Y H:i:s');

        return $this->sendMessage($message);
    }
}