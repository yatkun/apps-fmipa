<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan;

use App\Models\Letter;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.auth')]
class LetterDetailViewer extends Component
{
    public $letter;
    public $letterId;
    public $isPublicAccess = false;

    // Metode mount akan dipanggil saat komponen diinisialisasi
    public function mount($letterId)
    {
        $this->letterId = $letterId;
        
        // Cek apakah ini akses public (dari QR code)
        $this->isPublicAccess = request()->routeIs('letters.approved.public');
        
        try {
            // Decode hashed ID terlebih dahulu
            $realId = Letter::decodeHashedId($letterId);
            
            if (!$realId) {
                abort(404, 'Surat tidak ditemukan');
            }
            
            // Memuat letter dengan relasi yang diperlukan
            $this->letter = Letter::with(['template', 'approver', 'creator'])
                                  ->findOrFail($realId);
            
            // Untuk akses public, pastikan surat sudah approved
            if ($this->isPublicAccess && $this->letter->status !== 'approved') {
                abort(404, 'Surat belum disetujui atau tidak tersedia untuk akses publik');
            }
                                  
        } catch (\Exception $e) {
            abort(404, 'Surat tidak ditemukan');
        }
    }

    // Metode untuk mengunduh file surat (mendukung PDF dan DOCX dengan fallback)
    public function downloadLetter()
    {
        try {
            if (!$this->letter || !$this->letter->file_path) {
                session()->flash('error', 'File surat tidak ditemukan.');
                return;
            }

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
                    
                    return response()->download($fullPath, $fileName);
                }
            }
            
            session()->flash('error', 'File surat tidak ditemukan di storage.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengunduh file: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.edokumen.tendik.persuratan.letter-detail-viewer');
    }
}
