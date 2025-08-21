<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan\Approval;

use App\Models\Letter;

use Livewire\Component;



use Endroid\QrCode\QrCode;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Writer\PngWriter;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\ErrorCorrectionLevel;
use PhpOffice\PhpWord\TemplateProcessor;
use Endroid\QrCode\Encoding\Encoding; // Ditambahkan
use Endroid\QrCode\RoundBlockSizeMode; // Ditambahkan
use Endroid\QrCode\Label\Label; // Ditambahkan (walaupun tidak akan digunakan secara default)
use Endroid\QrCode\Logo\Logo;   // Ditambahkan (walaupun tidak akan digunakan secara default)

// Cloudmersive API Client
use Swagger\Client\Configuration;
use Swagger\Client\Api\ConvertDocumentApi;
use GuzzleHttp\Client as GuzzleHttpClient;

// Telegram Notification Service
use App\Services\TelegramNotificationService;

class ApproveLetters extends Component
{
    public $letterId;
    public $letter;
    public $rejectionReason;
    public $approvalNotes;

    protected $telegramService;

    public function boot()
    {
        $this->telegramService = new TelegramNotificationService();
    }

    public function mount($letterId)
    {
        $this->letterId = $letterId;
        $this->letter = Letter::findByHashedIdOrFail($letterId);
        
        // Ensure telegram service is initialized
        if (!$this->telegramService) {
            $this->telegramService = new TelegramNotificationService();
        }

        // Pastikan hanya surat 'verification_dekan' yang bisa disetujui/ditolak oleh Dekan
        if ($this->letter->status !== 'verification_dekan') {
            session()->flash('error', 'Surat ini sudah diproses atau bukan dalam tahap verifikasi Dekan.');
            return redirect()->route('list.verification.dekan');
        }

        // Validasi akses: hanya Dekan yang bisa approve
        if (Auth::user()->level !== 'Dosen' || !Auth::user()->is_dekan) {
            session()->flash('error', 'Anda tidak memiliki akses untuk menyetujui surat ini.');
            return redirect()->route('dashboard');
        }
    }

    public function approveLetter()
    {
        try {
            // Lakukan validasi tambahan jika diperlukan
            if ($this->letter->status !== 'verification_dekan') {
                session()->flash('error', 'Surat ini sudah tidak dalam tahap verifikasi Dekan.');
                return;
            }

            // Panggil method untuk menyisipkan TTD/Barcode
            $this->insertDigitalSignatureOrBarcode();

            // Setelah berhasil menambahkan TTD/Barcode, pindahkan ke Google Drive
            $this->moveToGoogleDrive();

            $this->letter->status = 'approved';
            $this->letter->verified_by_dekan_id = Auth::user()->id;
            $this->letter->verified_at_dekan = now();
            $this->letter->approved_by_user_id = Auth::user()->id;
            $this->letter->approved_at = now();
            
            // Save approval notes if provided
            if (!empty($this->approvalNotes)) {
                $this->letter->dekan_notes = $this->approvalNotes;
            }
            
            $this->letter->save();

            // Ambil nomor WA dosen dari relasi user
            $dosen = $this->letter->creator; // Ambil data user (dosen) dari surat
            // $nomorWA = $dosen->nomor_wa; // Field nomor_wa sudah tidak digunakan lagi

            // WhatsApp Business API Meta - kirim pesan pakai template hello_world sesuai curl user
            // Feature WhatsApp notification telah dinonaktifkan karena field nomor_wa dihapus

            // Send Telegram notification
            if ($this->telegramService) {
                $this->telegramService->notifyLetterApprovedByDekan($this->letter);
            } else {
                Log::warning('Telegram service not available for notification', [
                    'letter_id' => $this->letter->id
                ]);
            }
        
           
            session()->flash('message', 'Surat berhasil disetujui dan ditandatangani!');
            return redirect()->route('list.verification.dekan');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyetujui surat: ' . $e->getMessage());
        }
    }

    public function rejectLetter()
    {
        $this->validate([
            'rejectionReason' => 'required|string|min:10', // Alasan penolakan wajib diisi
        ]);

        try {
            if ($this->letter->status !== 'verification_dekan') {
                session()->flash('error', 'Surat ini sudah tidak dalam tahap verifikasi Dekan.');
                return;
            }

            $this->letter->status = 'rejected';
            $this->letter->rejection_reason = $this->rejectionReason;
            $this->letter->verified_by_dekan_id = Auth::user()->id;
            $this->letter->verified_at_dekan = now();
            $this->letter->approved_by_user_id = Auth::user()->id; // Asumsi user yang login adalah penolak
            $this->letter->approved_at = now(); // Waktu penolakan
            $this->letter->save();

            // Send Telegram notification
            if ($this->telegramService) {
                $this->telegramService->notifyLetterRejected($this->letter, 'Dekan');
            } else {
                Log::warning('Telegram service not available for notification', [
                    'letter_id' => $this->letter->id
                ]);
            }

            session()->flash('success', 'Surat berhasil ditolak.');
            return redirect()->route('list.verification.dekan');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menolak surat: ' . $e->getMessage());
        }
    }

    /**
     * Metode untuk menyisipkan TTD atau Barcode ke dokumen Word.
     * Ini adalah bagian yang paling kompleks dan mungkin memerlukan library tambahan.
     * Contoh ini akan menyisipkan Barcode QR.
     */
    // ... (property, mount, approveLetter, rejectLetter methods tetap sama) ...

    /**
     * Metode untuk menyisipkan TTD atau Barcode ke dokumen Word.
     * Menggunakan Endroid\QrCode.
     */
    private function insertDigitalSignatureOrBarcode()
    {
        // Pastikan dokumen asli ada di storage lokal
        $filePath = $this->letter->file_path;
        
        // Validasi file path
        if (empty($filePath)) {
            throw new \Exception("File path surat kosong.");
        }
        
        $originalFilePath = Storage::disk('public')->path($filePath);
        
        // Validasi file exists
        if (!file_exists($originalFilePath)) {
            throw new \Exception("File surat asli tidak ditemukan: " . $originalFilePath);
        }
        
        // Validasi file readable
        if (!is_readable($originalFilePath)) {
            throw new \Exception("File surat tidak dapat dibaca: " . $originalFilePath);
        }
       
        // Buat salinan untuk dimodifikasi agar tidak merusak file asli
        $modifiedFilePath = str_replace('.docx', '_approved.docx', $originalFilePath);
        
        // Pastikan direktori output ada
        $outputDirectory = dirname($modifiedFilePath);
        if (!file_exists($outputDirectory)) {
            mkdir($outputDirectory, 0755, true);
        }
        
        // Copy file asli ke file baru
        if (!copy($originalFilePath, $modifiedFilePath)) {
            throw new \Exception("Gagal menyalin file untuk modifikasi.");
        }

        try {
            // Inisialisasi TemplateProcessor
            $templateProcessor = new TemplateProcessor($modifiedFilePath);

            // Cek apakah ini surat custom (tidak memiliki template_id)
            $isCustomLetter = is_null($this->letter->template_id);
            
            // Cek placeholder yang tersedia di template
            $templateVariables = $templateProcessor->getVariables();
            
            // Untuk surat custom, cek juga apakah ada text ${qr_code} di dokumen
            $hasQrCodeText = false;
            if ($isCustomLetter) {
                $hasQrCodeText = $this->checkForQrCodePlaceholder($modifiedFilePath);
            }
            
            Log::info('Template analysis', [
                'letter_id' => $this->letter->id,
                'is_custom_letter' => $isCustomLetter,
                'available_variables' => $templateVariables,
                'has_qr_code_text' => $hasQrCodeText,
                'template_id' => $this->letter->template_id
            ]);

            // --- Logika untuk menyisipkan QR Code menggunakan Endroid\QrCode ---
            $qrPlaceholder = 'qr_code'; // Nama placeholder di template Anda untuk QR Code
            $signaturePlaceholder = 'tanda_tangan_dekan'; // Nama placeholder di template Anda untuk TTD
      
            // Data yang akan di-encode di QR Code (URL ke detail surat ini)
            $qrData = url('/surat/' . $this->letter->hashed_id . '/detail'); // URL ke detail surat ini, misalnya: /surat/12345/detail
            
            // Log untuk debugging
            Log::info('Generating QR Code', [
                'letter_id' => $this->letter->id,
                'qr_data' => $qrData,
                'placeholder' => $qrPlaceholder
            ]);

            // Inisialisasi Writer
            $writer = new PngWriter();

            // Buat QR code dengan named arguments
            $qrCode = new QrCode(
                data: $qrData,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::High,
                size: 300, // Ukuran diperbesar untuk clarity
                margin: 15,
                roundBlockSizeMode: RoundBlockSizeMode::Margin,
                foregroundColor: new Color(0, 0, 0),
                backgroundColor: new Color(255, 255, 255)
            );

            // Logo handling (optional)
            $logo = null;
            $logoPath = public_path('assets/images/logo_usb.png');
            if (file_exists($logoPath)) {
                $logo = new Logo(
                    path: $logoPath,
                    resizeToWidth: 60,
                    punchoutBackground: true
                );
                Log::info('Logo found and will be added to QR code', ['logo_path' => $logoPath]);
            } else {
                Log::warning('Logo not found', ['logo_path' => $logoPath]);
            }

            // Label handling (optional)
            $label = new Label(
                text: 'FMIPA UNSULBAR',
                textColor: new Color(0, 0, 0)
            );

            // Generate QR Code
            $result = $writer->write($qrCode, $logo, $label);
            $qrCodeImageContent = $result->getString();
            
            // Validasi QR code content
            if (empty($qrCodeImageContent)) {
                throw new \Exception("QR Code generation failed - empty content");
            }

            // Simpan QR Code sementara dengan nama yang unik
            $qrCodeTempPath = storage_path('app/public/temp_qr_' . $this->letter->hashed_id . '_' . time() . '.png');
            
            if (file_put_contents($qrCodeTempPath, $qrCodeImageContent) === false) {
                throw new \Exception("Gagal menyimpan QR Code ke file sementara");
            }
            
            // Validasi file QR code berhasil dibuat
            if (!file_exists($qrCodeTempPath) || filesize($qrCodeTempPath) < 100) {
                throw new \Exception("File QR Code tidak valid atau kosong");
            }
            
            Log::info('QR Code file created successfully', [
                'file_path' => $qrCodeTempPath,
                'file_size' => filesize($qrCodeTempPath)
            ]);

            // Cek apakah perlu menyisipkan QR Code
            $shouldInsertQrCode = false;
            
            // Untuk template dengan placeholder normal
            if (in_array($qrPlaceholder, $templateVariables)) {
                $shouldInsertQrCode = true;
                
                try {
                    $templateProcessor->setImageValue($qrPlaceholder, [
                        'path' => $qrCodeTempPath,
                        'width' => 120, // Ukuran tampilan di Word diperbesar
                        'height' => 120,
                        'ratio' => true,
                    ]);
                    
                    Log::info('QR Code inserted into template successfully via placeholder');
                } catch (\Exception $e) {
                    Log::error('Failed to insert QR code into template', [
                        'error' => $e->getMessage(),
                        'placeholder' => $qrPlaceholder,
                        'qr_file' => $qrCodeTempPath
                    ]);
                    throw new \Exception("Gagal menyisipkan QR Code ke template: " . $e->getMessage());
                }
            }
            
            // Untuk surat custom dengan text ${qr_code}
            elseif ($isCustomLetter && $hasQrCodeText) {
                $shouldInsertQrCode = true;
                
                try {
                    // Ganti text ${qr_code} dengan QR Code image
                    $this->replaceQrCodeTextWithImage($templateProcessor, $qrCodeTempPath);
                    
                    Log::info('QR Code inserted into custom letter successfully via text replacement');
                } catch (\Exception $e) {
                    Log::error('Failed to replace ${qr_code} text with QR code image', [
                        'error' => $e->getMessage(),
                        'qr_file' => $qrCodeTempPath
                    ]);
                    throw new \Exception("Gagal mengganti text \${qr_code} dengan QR Code: " . $e->getMessage());
                }
            }
            
            if (!$shouldInsertQrCode) {
                Log::info('QR Code insertion skipped', [
                    'placeholder_found' => in_array($qrPlaceholder, $templateVariables),
                    'is_custom_letter' => $isCustomLetter,
                    'has_qr_code_text' => $hasQrCodeText,
                    'available_variables' => $templateVariables
                ]);
            }

            // --- Logika untuk menyisipkan TTD (jika ada dan placeholder tersedia) ---
            $signatureImagePath = public_path('images/ttd_dekan.png');
            if (file_exists($signatureImagePath) && in_array($signaturePlaceholder, $templateVariables)) {
                try {
                    $templateProcessor->setImageValue($signaturePlaceholder, [
                        'path' => $signatureImagePath,
                        'width' => 150,
                        'height' => 80,
                        'ratio' => true,
                    ]);
                    Log::info('Digital signature inserted successfully');
                } catch (\Exception $e) {
                    Log::warning('Failed to insert digital signature', [
                        'error' => $e->getMessage(),
                        'signature_path' => $signatureImagePath
                    ]);
                }
            } else {
                if (!file_exists($signatureImagePath)) {
                    Log::warning('Digital signature file not found', ['path' => $signatureImagePath]);
                }
                if (!in_array($signaturePlaceholder, $templateVariables)) {
                    Log::info('Digital signature placeholder not found in template - skipping signature insertion', [
                        'placeholder' => $signaturePlaceholder,
                        'available_variables' => $templateVariables
                    ]);
                }
            }

            // Simpan dokumen yang sudah dimodifikasi
            try {
                $templateProcessor->saveAs($modifiedFilePath);
                
                // Validasi file berhasil disimpan
                if (!file_exists($modifiedFilePath) || filesize($modifiedFilePath) < 1000) {
                    throw new \Exception("File approved tidak berhasil disimpan atau corrupt");
                }
                
                Log::info('Modified document saved successfully', [
                    'file_path' => $modifiedFilePath,
                    'file_size' => filesize($modifiedFilePath)
                ]);
                
            } catch (\Exception $e) {
                throw new \Exception("Gagal menyimpan dokumen yang sudah dimodifikasi: " . $e->getMessage());
            }

            // Update path di database ke file yang sudah disetujui
            $relativePath = str_replace(Storage::disk('public')->path(''), '', $modifiedFilePath);
            $this->letter->file_path = $relativePath;
            $this->letter->save();
            
            Log::info('Letter file path updated in database', [
                'old_path' => $filePath,
                'new_path' => $relativePath
            ]);

            // Hapus file QR Code sementara
            if (file_exists($qrCodeTempPath)) {
                unlink($qrCodeTempPath);
                Log::info('Temporary QR code file deleted');
            }
            
        } catch (\Exception $e) {
            // Cleanup jika terjadi error
            if (isset($qrCodeTempPath) && file_exists($qrCodeTempPath)) {
                unlink($qrCodeTempPath);
            }
            
            Log::error('Error in insertDigitalSignatureOrBarcode', [
                'letter_id' => $this->letter->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new \Exception("Gagal menyisipkan TTD/Barcode ke surat. Error: " . $e->getMessage());
        }
    }

    /**
     * Method untuk testing QR Code generation terpisah
     */
    public function testQrCode()
    {
        try {
            $qrData = url('/surat/approved/' . $this->letter->hashed_id);
            
            $writer = new PngWriter();
            $qrCode = new QrCode(
                data: $qrData,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::High,
                size: 300,
                margin: 15,
                roundBlockSizeMode: RoundBlockSizeMode::Margin,
                foregroundColor: new Color(0, 0, 0),
                backgroundColor: new Color(255, 255, 255)
            );

            $result = $writer->write($qrCode);
            $qrCodeImageContent = $result->getString();
            
            // Simpan untuk testing
            $testPath = storage_path('app/public/test_qr_' . $this->letter->id . '.png');
            file_put_contents($testPath, $qrCodeImageContent);
            
            session()->flash('message', 'QR Code test berhasil dibuat: ' . $testPath);
            
        } catch (\Exception $e) {
            session()->flash('error', 'QR Code test gagal: ' . $e->getMessage());
        }
    }

    /**
     * Method untuk mengecek apakah file docx mengandung text ${qr_code}
     */
    private function checkForQrCodePlaceholder($filePath)
    {
        try {
            // Baca content dari file docx menggunakan ZipArchive
            $zip = new \ZipArchive();
            
            if ($zip->open($filePath) === TRUE) {
                // Cek file document.xml yang berisi konten utama
                $documentXml = $zip->getFromName('word/document.xml');
                
                if ($documentXml !== false) {
                    // Cek berbagai variasi placeholder QR Code
                    $qrCodePatterns = [
                        '${qr_code}',
                        '$qr_code',
                        '${QR_CODE}',
                        '$QR_CODE',
                        'qr_code',
                        'QR_CODE',
                        '${barcode}',
                        '$barcode',
                        'barcode'
                    ];
                    
                    $hasQrCode = false;
                    $foundPattern = null;
                    
                    foreach ($qrCodePatterns as $pattern) {
                        if (strpos($documentXml, $pattern) !== false) {
                            $hasQrCode = true;
                            $foundPattern = $pattern;
                            break;
                        }
                    }
                    
                    $zip->close();
                    
                    Log::info('Checking for QR Code placeholder in custom letter', [
                        'file_path' => $filePath,
                        'has_qr_code_placeholder' => $hasQrCode,
                        'found_pattern' => $foundPattern,
                        'document_xml_length' => strlen($documentXml),
                        'checked_patterns' => $qrCodePatterns
                    ]);
                    
                    return $hasQrCode;
                }
                
                $zip->close();
            }
            
            return false;
            
        } catch (\Exception $e) {
            Log::error('Error checking for QR code placeholder', [
                'file_path' => $filePath,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Method untuk mengganti text ${qr_code} dengan gambar QR Code
     */
    private function replaceQrCodeTextWithImage($templateProcessor, $qrCodeImagePath)
    {
        try {
            // Coba beberapa variasi placeholder yang mungkin ada
            $possiblePlaceholders = [
                'qr_code',      // Yang paling umum untuk PhpWord
                'QR_CODE',
                'barcode',
                'BARCODE'
            ];
            
            $replacementMade = false;
            
            // Coba ganti menggunakan setImageValue untuk setiap kemungkinan placeholder
            foreach ($possiblePlaceholders as $placeholder) {
                try {
                    $templateProcessor->setImageValue($placeholder, [
                        'path' => $qrCodeImagePath,
                        'width' => 120,
                        'height' => 120,
                        'ratio' => true,
                    ]);
                    
                    $replacementMade = true;
                    Log::info('Successfully replaced placeholder with QR code image', [
                        'placeholder' => $placeholder
                    ]);
                    
                    break; // Keluar dari loop jika berhasil
                    
                } catch (\Exception $e) {
                    // Lanjutkan ke placeholder berikutnya
                    Log::debug('Failed to replace image placeholder, trying next', [
                        'placeholder' => $placeholder,
                        'error' => $e->getMessage()
                    ]);
                    continue;
                }
            }
            
            // Jika setImageValue gagal, coba dengan setValue untuk mengganti text
            if (!$replacementMade) {
                $textPlaceholders = [
                    '${qr_code}',
                    '$qr_code',
                    '${QR_CODE}',
                    '$QR_CODE',
                    '${barcode}',
                    '$barcode'
                ];
                
                foreach ($textPlaceholders as $textPlaceholder) {
                    try {
                        // Ganti text dengan placeholder untuk image
                        $templateProcessor->setValue($textPlaceholder, '${qr_code_image}');
                        
                        // Kemudian ganti placeholder image dengan QR code
                        $templateProcessor->setImageValue('qr_code_image', [
                            'path' => $qrCodeImagePath,
                            'width' => 120,
                            'height' => 120,
                            'ratio' => true,
                        ]);
                        
                        $replacementMade = true;
                        Log::info('Successfully replaced text placeholder with QR code', [
                            'text_placeholder' => $textPlaceholder
                        ]);
                        
                        break;
                        
                    } catch (\Exception $e) {
                        Log::debug('Failed to replace text placeholder, trying next', [
                            'text_placeholder' => $textPlaceholder,
                            'error' => $e->getMessage()
                        ]);
                        continue;
                    }
                }
            }
            
            if (!$replacementMade) {
                Log::warning('No QR code placeholder could be replaced');
                // Tetap lanjutkan tanpa throw error karena mungkin tidak ada placeholder
            }
            
        } catch (\Exception $e) {
            Log::error('Error in replaceQrCodeTextWithImage', [
                'error' => $e->getMessage(),
                'qr_image_path' => $qrCodeImagePath
            ]);
            throw $e;
        }
    }

    /**
     * Method untuk menyisipkan QR Code secara manual ke dokumen
     */
    private function manuallyInsertQrCode($templateProcessor, $qrCodeImagePath)
    {
        try {
            // Sebagai fallback, tambahkan QR code di akhir dokumen
            // Ini memerlukan manipulasi XML langsung yang lebih kompleks
            
            Log::info('Attempting manual QR code insertion');
            
            // Untuk sekarang, buat placeholder sementara dan ganti
            $tempPlaceholder = '___QR_CODE_PLACEHOLDER___';
            
            // Tambahkan placeholder di akhir jika belum ada
            $templateProcessor->setValue($tempPlaceholder, '');
            
            // Ganti dengan image
            $templateProcessor->setImageValue($tempPlaceholder, [
                'path' => $qrCodeImagePath,
                'width' => 120,
                'height' => 120,
                'ratio' => true,
            ]);
            
            Log::info('Manual QR code insertion completed');
            
        } catch (\Exception $e) {
            Log::warning('Manual QR code insertion failed', [
                'error' => $e->getMessage()
            ]);
            // Tidak throw error karena ini adalah fallback
        }
    }

    /**
     * Method untuk download file surat (mendukung PDF dan DOCX dengan fallback)
     */
    public function downloadLetter()
    {
        try {
            $filePath = $this->letter->file_path;
            
            // Cek apakah file di Google Drive (path dimulai dengan "Surat/")
            if (str_starts_with($filePath, 'Surat/')) {
                // File di Google Drive
                if (Storage::disk('google')->exists($filePath)) {
                    $content = Storage::disk('google')->get($filePath);
                    $fileName = basename($filePath);
                    
                    // Tentukan content type berdasarkan ekstensi file
                    $contentType = 'application/octet-stream'; // Default
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    
                    switch ($fileExtension) {
                        case 'pdf':
                            $contentType = 'application/pdf';
                            break;
                        case 'docx':
                            $contentType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                            break;
                        case 'doc':
                            $contentType = 'application/msword';
                            break;
                    }
                    
                    Log::info('Downloading file from Google Drive', [
                        'file_path' => $filePath,
                        'file_name' => $fileName,
                        'content_type' => $contentType,
                        'file_size' => strlen($content),
                        'file_extension' => $fileExtension
                    ]);
                    
                    return response($content)
                        ->header('Content-Type', $contentType)
                        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
                } else {
                    // Jika file PDF tidak ada, coba cari file DOCX
                    $alternativeFilePath = str_replace('.pdf', '.docx', $filePath);
                    
                    if (Storage::disk('google')->exists($alternativeFilePath)) {
                        $content = Storage::disk('google')->get($alternativeFilePath);
                        $fileName = basename($alternativeFilePath);
                        $contentType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                        
                        Log::info('PDF not found, downloading DOCX fallback from Google Drive', [
                            'original_pdf_path' => $filePath,
                            'fallback_docx_path' => $alternativeFilePath,
                            'file_name' => $fileName,
                            'file_size' => strlen($content)
                        ]);
                        
                        return response($content)
                            ->header('Content-Type', $contentType)
                            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
                    }
                }
            } else {
                // File di storage lokal
                if (Storage::disk('public')->exists($filePath)) {
                    $fullPath = Storage::disk('public')->path($filePath);
                    $fileName = basename($filePath);
                    
                    Log::info('Downloading file from local storage', [
                        'file_path' => $fullPath,
                        'file_name' => $fileName
                    ]);
                    
                    return response()->download($fullPath, $fileName);
                }
            }
            
            session()->flash('error', 'File surat tidak ditemukan.');
            return;
            
        } catch (\Exception $e) {
            Log::error('Download file error', [
                'letter_id' => $this->letter->id,
                'file_path' => $this->letter->file_path,
                'error' => $e->getMessage()
            ]);
            
            session()->flash('error', 'Gagal mengunduh file: ' . $e->getMessage());
            return;
        }
    }

    /**
     * Method untuk konversi dokumen Word ke PDF menggunakan Cloudmersive API
     * Jika gagal, akan throw exception untuk fallback ke DOCX upload
     */
    private function convertDocxToPdf($docxFilePath)
    {
        try {
            Log::info('Starting DOCX to PDF conversion', [
                'docx_file' => $docxFilePath,
                'file_exists' => file_exists($docxFilePath),
                'file_size' => file_exists($docxFilePath) ? filesize($docxFilePath) : 0
            ]);

            // Validasi file exists
            if (!file_exists($docxFilePath)) {
                throw new \Exception("File DOCX tidak ditemukan: " . $docxFilePath);
            }

            // Validasi file readable
            if (!is_readable($docxFilePath)) {
                throw new \Exception("File DOCX tidak dapat dibaca: " . $docxFilePath);
            }

            // Konfigurasi Cloudmersive API
            $config = Configuration::getDefaultConfiguration()->setApiKey('Apikey', env('CLOUDMERSIVE_API_KEY'));

            // Inisialisasi API client
            $apiInstance = new ConvertDocumentApi(
                new GuzzleHttpClient(),
                $config
            );

            // Create SplFileObject untuk input file
            $inputFile = new \SplFileObject($docxFilePath, 'r');

           

            // Panggil API konversi
            $result = $apiInstance->convertDocumentDocxToPdf($inputFile);

            // Validasi hasil konversi
            if (empty($result)) {
                throw new \Exception("Hasil konversi PDF kosong");
            }

            // Generate path untuk file PDF
            $pdfFilePath = str_replace('.docx', '.pdf', $docxFilePath);
            
            // Simpan file PDF
            if (file_put_contents($pdfFilePath, $result) === false) {
                throw new \Exception("Gagal menyimpan file PDF: " . $pdfFilePath);
            }

            // Validasi file PDF berhasil dibuat
            if (!file_exists($pdfFilePath) || filesize($pdfFilePath) < 1000) {
                throw new \Exception("File PDF tidak valid atau kosong");
            }

            Log::info('PDF conversion successful', [
                'docx_file' => $docxFilePath,
                'pdf_file' => $pdfFilePath,
                'pdf_size' => filesize($pdfFilePath)
            ]);

            return $pdfFilePath;

        } catch (\Exception $e) {
            Log::error('PDF conversion failed', [
                'docx_file' => $docxFilePath,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new \Exception("Gagal konversi ke PDF: " . $e->getMessage());
        }
    }

    /**
     * Method untuk memindahkan file yang sudah disetujui ke Google Drive
     * Prioritas: PDF jika konversi berhasil, fallback ke DOCX jika gagal
     */
    private function moveToGoogleDrive()
    {
        try {
            // Path file yang sudah disetujui di storage lokal (DOCX)
            $localDocxPath = Storage::disk('public')->path($this->letter->file_path);
            
            if (!file_exists($localDocxPath)) {
                throw new \Exception("File surat DOCX tidak ditemukan di storage lokal.");
            }

            Log::info('Starting conversion and upload process', [
                'letter_id' => $this->letter->id,
                'docx_path' => $localDocxPath,
                'docx_size' => filesize($localDocxPath)
            ]);

            // Setup folder structure di Google Drive
            $user = $this->letter->creator; // Ambil user yang membuat surat
            $username = $user->username ?? 'unknown';
            $userName = $user->name ?? 'unknown';
            $googleFolder = "Surat/Surat-keluar/{$username}-{$userName}";
            
            // Buat folder jika belum ada
            if (!Storage::disk('google')->exists($googleFolder)) {
                Storage::disk('google')->makeDirectory($googleFolder);
                Log::info('Created Google Drive folder', ['folder' => $googleFolder]);
            }

            $originalFileName = pathinfo($this->letter->file_path, PATHINFO_FILENAME);
            $localPdfPath = null;
            $uploadedFilePath = null;

            // Coba konversi ke PDF terlebih dahulu
            try {
                $localPdfPath = $this->convertDocxToPdf($localDocxPath);
                
                // Jika konversi PDF berhasil, upload PDF
                $pdfFileName = $originalFileName . '.pdf';
                $googlePdfPath = $googleFolder . '/' . $pdfFileName;
                
                $pdfContent = file_get_contents($localPdfPath);
                Storage::disk('google')->put($googlePdfPath, $pdfContent);
                
                $uploadedFilePath = $googlePdfPath;
                
                Log::info('PDF conversion and upload successful', [
                    'local_pdf_path' => $localPdfPath,
                    'google_pdf_path' => $googlePdfPath,
                    'pdf_size' => strlen($pdfContent)
                ]);

                // Cleanup: Hapus file PDF lokal setelah berhasil upload
                if (file_exists($localPdfPath)) {
                    unlink($localPdfPath);
                    Log::info('Local PDF file deleted after successful upload');
                }
                
            } catch (\Exception $pdfError) {
                // Jika konversi PDF gagal, fallback ke upload DOCX
                Log::warning('PDF conversion failed, falling back to DOCX upload', [
                    'letter_id' => $this->letter->id,
                    'pdf_error' => $pdfError->getMessage()
                ]);
                
                // Upload file DOCX asli ke Google Drive
                $docxFileName = $originalFileName . '.docx';
                $googleDocxPath = $googleFolder . '/' . $docxFileName;
                
                $docxContent = file_get_contents($localDocxPath);
                Storage::disk('google')->put($googleDocxPath, $docxContent);
                
                $uploadedFilePath = $googleDocxPath;
                
                Log::info('DOCX fallback upload successful', [
                    'local_docx_path' => $localDocxPath,
                    'google_docx_path' => $googleDocxPath,
                    'docx_size' => strlen($docxContent)
                ]);
                
                // Cleanup: Hapus file PDF lokal jika ada
                if ($localPdfPath && file_exists($localPdfPath)) {
                    unlink($localPdfPath);
                    Log::info('Local PDF file deleted after fallback to DOCX');
                }
            }

            // Update path di database ke Google Drive path
            $this->letter->file_path = $uploadedFilePath;
            $this->letter->save();

            Log::info('Letter file path updated in database', [
                'letter_id' => $this->letter->id,
                'new_file_path' => $uploadedFilePath,
                'file_type' => pathinfo($uploadedFilePath, PATHINFO_EXTENSION)
            ]);
            
        } catch (\Exception $e) {
            // Log error dan stop proses approval
            Log::error('Failed to upload file to Google Drive: ' . $e->getMessage(), [
                'letter_id' => $this->letter->id,
                'file_path' => $this->letter->file_path,
                'error_trace' => $e->getTraceAsString()
            ]);
            
            // Cleanup: Hapus file PDF lokal jika ada
            if (isset($localPdfPath) && $localPdfPath && file_exists($localPdfPath)) {
                unlink($localPdfPath);
                Log::info('Local PDF file deleted after upload error');
            }
            
            // Throw exception agar proses approval berhenti jika upload gagal
            throw new \Exception('Gagal upload file ke Google Drive: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.edokumen.tendik.persuratan.approval.approve-letters');
    }

    /**
     * Method debug untuk test QR Code pada surat custom
     */
    public function debugCustomLetter()
    {
        try {
            Log::info('=== DEBUG CUSTOM LETTER START ===', [
                'letter_id' => $this->letter->id,
                'letter_title' => $this->letter->title,
                'file_path' => $this->letter->file_path,
                'template_id' => $this->letter->template_id,
                'is_custom' => is_null($this->letter->template_id)
            ]);

            // Cek file exists
            $filePath = Storage::disk('public')->path($this->letter->file_path);
            if (!file_exists($filePath)) {
                session()->flash('error', 'File tidak ditemukan: ' . $filePath);
                return;
            }

            // Cek apakah ada placeholder QR Code
            $hasQrCode = $this->checkForQrCodePlaceholder($filePath);
            
            // Cek variables yang tersedia di template
            $templateProcessor = new TemplateProcessor($filePath);
            $variables = $templateProcessor->getVariables();

            Log::info('=== DEBUG CUSTOM LETTER RESULTS ===', [
                'file_exists' => file_exists($filePath),
                'file_size' => filesize($filePath),
                'has_qr_code_placeholder' => $hasQrCode,
                'template_variables' => $variables
            ]);

            session()->flash('message', 'Debug selesai. Cek log untuk detail. Has QR placeholder: ' . ($hasQrCode ? 'YES' : 'NO') . '. Variables: ' . implode(', ', $variables));

        } catch (\Exception $e) {
            Log::error('Debug error: ' . $e->getMessage());
            session()->flash('error', 'Debug error: ' . $e->getMessage());
        }
    }

    /**
     * Method untuk test konversi PDF dengan fallback
     */
    public function testPdfConversionWithFallback()
    {
        try {
            Log::info('=== TEST PDF CONVERSION WITH FALLBACK START ===', [
                'letter_id' => $this->letter->id,
                'file_path' => $this->letter->file_path
            ]);

            // Cek file exists
            $filePath = Storage::disk('public')->path($this->letter->file_path);
            if (!file_exists($filePath)) {
                session()->flash('error', 'File tidak ditemukan: ' . $filePath);
                return;
            }

            $testResults = [
                'docx_path' => $filePath,
                'docx_size' => filesize($filePath),
                'pdf_conversion_success' => false,
                'pdf_path' => null,
                'pdf_size' => 0,
                'fallback_to_docx' => false,
                'error_message' => null
            ];

            // Test konversi PDF
            try {
                $pdfPath = $this->convertDocxToPdf($filePath);
                $testResults['pdf_conversion_success'] = true;
                $testResults['pdf_path'] = $pdfPath;
                $testResults['pdf_size'] = file_exists($pdfPath) ? filesize($pdfPath) : 0;
                
                // Cleanup test PDF
                if (file_exists($pdfPath)) {
                    unlink($pdfPath);
                }
                
            } catch (\Exception $pdfError) {
                $testResults['pdf_conversion_success'] = false;
                $testResults['fallback_to_docx'] = true;
                $testResults['error_message'] = $pdfError->getMessage();
            }

            Log::info('=== TEST PDF CONVERSION WITH FALLBACK RESULTS ===', $testResults);

            $message = $testResults['pdf_conversion_success'] 
                ? 'Konversi PDF berhasil! File akan diupload sebagai PDF.' 
                : 'Konversi PDF gagal. File akan diupload sebagai DOCX. Error: ' . $testResults['error_message'];
                
            session()->flash('message', $message);

        } catch (\Exception $e) {
            Log::error('PDF conversion with fallback test error: ' . $e->getMessage());
            session()->flash('error', 'Test konversi PDF dengan fallback gagal: ' . $e->getMessage());
        }
    }

    /**
     * Method untuk test upload dengan fallback scenario
     */
    public function testUploadWithFallback()
    {
        try {
            Log::info('=== TEST UPLOAD WITH FALLBACK START ===', [
                'letter_id' => $this->letter->id,
                'file_path' => $this->letter->file_path
            ]);

            // Backup original file path
            $originalFilePath = $this->letter->file_path;
            
            // Test upload process
            $this->moveToGoogleDrive();
            
            $message = 'Upload test berhasil! File diupload sebagai: ' . pathinfo($this->letter->file_path, PATHINFO_EXTENSION);
            session()->flash('message', $message);
            
            // Restore original file path (untuk testing)
            $this->letter->file_path = $originalFilePath;
            $this->letter->save();

        } catch (\Exception $e) {
            Log::error('Upload with fallback test error: ' . $e->getMessage());
            session()->flash('error', 'Test upload dengan fallback gagal: ' . $e->getMessage());
        }
    }

    /**
     * Method untuk test pengiriman dokumen ke Telegram
     */
    public function testTelegramDocumentSend()
    {
        try {
            Log::info('=== TEST TELEGRAM DOCUMENT SEND START ===', [
                'letter_id' => $this->letter->id,
                'file_path' => $this->letter->file_path
            ]);

            if (!$this->letter->file_path) {
                session()->flash('error', 'File surat tidak ditemukan.');
                return;
            }

            $success = false;
            $errorMessage = null;

            // Test document send based on file location
            if (str_starts_with($this->letter->file_path, 'Surat/')) {
                // File is in Google Drive
                Log::info('Testing document send from Google Drive');
                
                $caption = "📄 *Test Dokumen dari Google Drive*\n";
                $caption .= "🏷️ {$this->letter->title}\n";
                $caption .= "📅 " . now()->format('d M Y H:i:s');
                
                $success = $this->telegramService->sendDocumentFromGoogleDrive(
                    $this->letter->file_path, 
                    $caption
                );
                
                if (!$success) {
                    $errorMessage = 'Gagal mengirim dokumen dari Google Drive ke Telegram';
                }
                
            } else {
                // File is in local storage
                $localFilePath = Storage::disk('public')->path($this->letter->file_path);
                
                if (!file_exists($localFilePath)) {
                    session()->flash('error', 'File tidak ditemukan di storage lokal: ' . $localFilePath);
                    return;
                }
                
                Log::info('Testing document send from local storage');
                
                $caption = "📄 *Test Dokumen dari Storage Lokal*\n";
                $caption .= "🏷️ {$this->letter->title}\n";
                $caption .= "📅 " . now()->format('d M Y H:i:s');
                
                $success = $this->telegramService->sendDocument($localFilePath, $caption);
                
                if (!$success) {
                    $errorMessage = 'Gagal mengirim dokumen dari storage lokal ke Telegram';
                }
            }

            Log::info('=== TEST TELEGRAM DOCUMENT SEND RESULTS ===', [
                'success' => $success,
                'error_message' => $errorMessage,
                'file_location' => str_starts_with($this->letter->file_path, 'Surat/') ? 'Google Drive' : 'Local Storage'
            ]);

            if ($success) {
                session()->flash('message', 'Test pengiriman dokumen ke Telegram berhasil! Cek chat Telegram untuk melihat dokumen.');
            } else {
                session()->flash('error', 'Test pengiriman dokumen ke Telegram gagal: ' . $errorMessage);
            }

        } catch (\Exception $e) {
            Log::error('Telegram document send test error: ' . $e->getMessage());
            session()->flash('error', 'Test pengiriman dokumen ke Telegram gagal: ' . $e->getMessage());
        }
    }
}
