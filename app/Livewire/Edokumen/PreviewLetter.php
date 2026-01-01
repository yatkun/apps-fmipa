<?php

namespace App\Livewire\Edokumen;

use App\Models\Letter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class PreviewLetter extends Component
{
    public $hashedId;
    
    public function mount($hashed_id)
    {
        
        $this->hashedId = $hashed_id;
        
        // Langsung trigger preview saat component di-mount
        return $this->preview();
    }
    
    public function preview()
    {
        try {
            // Find letter by hashed ID
            $letter = Letter::findByHashedIdOrFail($this->hashedId);
          
            // Check permission - hanya creator atau admin/tendik/dekan yang bisa akses
            if (Auth::id() !== $letter->user_id && !in_array(Auth::user()->level, ['Admin', 'Tendik', 'Dekan'])) {
                abort(403, 'Anda tidak memiliki akses untuk melihat surat ini.');
            }
            
            $filePath = $letter->file_path;
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            $contentType = $extension === 'pdf' ? 'application/pdf' : 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            
            // Langsung ambil file dari Google Drive tanpa cache
            $fileContent = Storage::disk('google')->get($filePath);
            
            // Return response dengan file content langsung
            return response($fileContent)
                ->header('Content-Type', $contentType)
                ->header('Content-Disposition', 'inline')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
            
        } catch (\Exception $e) {
            Log::error('Preview error in PreviewLetter: ' . $e->getMessage(), [
                'hashed_id' => $this->hashedId,
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);
            
            abort(404, 'File tidak ditemukan atau gagal diambil dari Google Drive.');
        }
    }
    
    public function render()
    {
        // View ini tidak akan ter-render karena preview langsung di-trigger
        return view('livewire.edokumen.preview-letter');
    }
}
