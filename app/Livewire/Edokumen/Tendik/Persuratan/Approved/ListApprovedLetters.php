<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan\Approved;

use App\Models\Letter;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ListApprovedLetters extends Component
{

    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public function mount()
    {

    
    }


    public function downloadLetter($letterId)
    {
        try {
            // Cari letter berdasarkan ID
            $letter = Letter::find($letterId);
            if (!$letter) {
                session()->flash('error', 'Surat tidak ditemukan.');
                return;
            }

            $filePath = $letter->file_path;
            
            // Cek apakah file di Google Drive (path dimulai dengan "Surat/")
            if (str_starts_with($filePath, 'Surat/')) {
                // File di Google Drive
                if (Storage::disk('google')->exists($filePath)) {
                    // Ambil raw content sebagai binary
                    $content = Storage::disk('google')->get($filePath);
                    
                    // Validasi apakah content adalah file DOCX yang valid
                    if (empty($content) || strlen($content) < 100) {
                        session()->flash('error', 'File surat kosong atau rusak.');
                        return;
                    }
                    
                    // Cek header DOCX (ZIP file signature)
                    $zipSignature = substr($content, 0, 4);
                    if ($zipSignature !== "PK\x03\x04" && $zipSignature !== "PK\x05\x06" && $zipSignature !== "PK\x07\x08") {
                        session()->flash('error', 'File bukan format DOCX yang valid.');
                        return;
                    }
                    
                    $fileName = basename($filePath);
                    
                    // Pastikan filename tidak mengandung karakter khusus untuk header
                    $safeFileName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $fileName);
                    
                    return response($content, 200, [
                        'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'Content-Disposition' => 'attachment; filename="' . $safeFileName . '"',
                        'Content-Length' => strlen($content),
                        'Cache-Control' => 'no-cache, no-store, must-revalidate',
                        'Pragma' => 'no-cache',
                        'Expires' => '0'
                    ]);
                } else {
                    session()->flash('error', 'File surat tidak ditemukan di Google Drive.');
                    return;
                }
            } else {
                // File di storage lokal
                if (Storage::disk('public')->exists($filePath)) {
                    $fullPath = Storage::disk('public')->path($filePath);
                    
                    // Validasi file exists dan readable
                    if (!file_exists($fullPath) || !is_readable($fullPath)) {
                        session()->flash('error', 'File tidak dapat dibaca dari storage lokal.');
                        return;
                    }
                    
                    // Validasi ukuran file
                    $fileSize = filesize($fullPath);
                    if ($fileSize === false || $fileSize < 100) {
                        session()->flash('error', 'File kosong atau rusak.');
                        return;
                    }
                    
                    $fileName = basename($filePath);
                    
                    // Pastikan filename tidak mengandung karakter khusus
                    $safeFileName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $fileName);
                    
                    return response()->download($fullPath, $safeFileName);
                } else {
                    session()->flash('error', 'File surat tidak ditemukan di storage lokal.');
                    return;
                }
            }
        } catch (\Exception $e) {
            Log::error('Error downloading letter file: ' . $e->getMessage(), [
                'letter_id' => $letterId,
                'file_path' => $letter->file_path ?? 'unknown',
                'error_trace' => $e->getTraceAsString()
            ]);
            
            session()->flash('error', 'Gagal mengunduh file: ' . $e->getMessage());
            return;
        }
    }

    /**
     * Debug method untuk cek file info
     */
    public function debugFile($letterId)
    {
        try {
            $letter = Letter::find($letterId);
            if (!$letter) {
                dd('Letter not found');
            }

            $filePath = $letter->file_path;
            
            $debugInfo = [
                'letter_id' => $letter->id,
                'file_path' => $filePath,
                'is_google_drive' => str_starts_with($filePath, 'Surat/'),
            ];

            if (str_starts_with($filePath, 'Surat/')) {
                // Google Drive
                $debugInfo['google_drive_exists'] = Storage::disk('google')->exists($filePath);
                if ($debugInfo['google_drive_exists']) {
                    $content = Storage::disk('google')->get($filePath);
                    $debugInfo['content_length'] = strlen($content);
                    $debugInfo['content_first_10_bytes'] = bin2hex(substr($content, 0, 10));
                    $debugInfo['is_valid_utf8'] = mb_check_encoding($content, 'UTF-8');
                }
            } else {
                // Local storage
                $debugInfo['local_exists'] = Storage::disk('public')->exists($filePath);
                if ($debugInfo['local_exists']) {
                    $fullPath = Storage::disk('public')->path($filePath);
                    $debugInfo['file_exists'] = file_exists($fullPath);
                    $debugInfo['file_size'] = filesize($fullPath);
                    $debugInfo['is_readable'] = is_readable($fullPath);
                    
                    if (file_exists($fullPath)) {
                        $content = file_get_contents($fullPath, false, null, 0, 100);
                        $debugInfo['content_first_10_bytes'] = bin2hex(substr($content, 0, 10));
                    }
                }
            }

            dd($debugInfo);
        } catch (\Exception $e) {
            dd([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function setsortBy($sortByField)
    {

        // Jika field yang sama diklik
        if ($this->sortBy === $sortByField) {
            // Jika saat ini ASC, ubah menjadi DESC
            if ($this->sortDir === 'ASC') {
                $this->sortDir = 'DESC';
            }
            // Jika saat ini DESC, reset ke default
            elseif ($this->sortDir === 'DESC') {
                $this->sortDir = 'ASC';  // null berarti urutan default
                $this->sortBy = 'created_at';  // kembali ke default sorting
            }
            // Jika saat ini null (default), set ke ASC
            else {
                $this->sortDir = 'ASC';
            }
        } else {
            // Jika field yang berbeda diklik, set ke ASC
            $this->sortBy = $sortByField;
            $this->sortDir = 'ASC';
        }
    }
    public function render()
    {
        $approvedLetters = Letter::query()
            ->select('letters.*')
            ->join('templates', 'letters.template_id', '=', 'templates.id')
            ->where('status', 'approved')
            ->where('user_id', Auth::user()->id)
            ->with('template', 'approver')
            ->when($this->sortDir && $this->sortBy, function ($query) {
                if ($this->sortBy === 'template_name') {
                    $query->orderBy('templates.name', $this->sortDir);
                } elseif ($this->sortBy === 'approver_name') {
                    $query->join('users as approvers', 'letters.approver_id', '=', 'approvers.id')
                        ->orderBy('approvers.name', $this->sortDir);
                } else {
                    $query->orderBy($this->sortBy, $this->sortDir);
                }
            }, function ($query) {
                $query->orderBy('created_at', 'DESC');
            })
            ->search($this->search)
            ->paginate($this->perPage);
        return view('livewire.edokumen.tendik.persuratan.approved.list-approved-letters', [
            'approvedLetters' => $approvedLetters,
        ]);
    }
}
