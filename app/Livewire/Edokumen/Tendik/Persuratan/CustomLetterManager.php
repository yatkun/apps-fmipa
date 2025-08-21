<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan;

use App\Models\Letter;
use App\Models\Template;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CustomLetterManager extends Component
{
    use WithFileUploads;

    public $waitingLetters = [];
    public $selectedLetter = null;
    public $letterFile;
    public $templateName;
    public $showUploadModal = false;
    public $placeholders = [];
    public $placeholderHints = [];

    protected $listeners = ['closeModal' => 'closeModal'];

    public function mount()
    {
        $this->loadWaitingLetters();
    }

    public function loadWaitingLetters()
    {
        $this->waitingLetters = Letter::where('status', 'waiting_template')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        
        
    }

    public function selectLetter($letterId)
    {
        Log::info('SelectLetter called with ID: ' . $letterId);
        
        try {
            $this->selectedLetter = Letter::with('user')->find($letterId);
            
            if (!$this->selectedLetter) {
                session()->flash('error', 'Surat tidak ditemukan.');
                return;
            }
            
            $this->templateName = $this->selectedLetter->title;
            $this->showUploadModal = true;
            $this->reset(['letterFile', 'placeholders', 'placeholderHints']);
            
            Log::info('Modal opened. Selected letter: ' . $this->selectedLetter->title);
            
            // Emit event to frontend
            $this->dispatch('modal-opened');
            
        } catch (\Exception $e) {
            Log::error('Error in selectLetter: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat membuka modal.');
        }
    }

    public function closeModal()
    {
        Log::info('CloseModal called');
        $this->showUploadModal = false;
        $this->selectedLetter = null;
        $this->reset(['letterFile', 'templateName', 'placeholders', 'placeholderHints']);
        
        // Emit event to frontend
        $this->dispatch('modal-closed');
    }

    public function uploadLetter()
    {
        $this->validate([
            'letterFile' => 'required|file|mimes:pdf,doc,docx|max:10240', // Max 10MB
        ]);

        try {
            // Upload file surat ke storage lokal (bukan Google Drive)
            $fileName = 'surat_custom_' . \Illuminate\Support\Str::slug($this->selectedLetter->title) . '_' . time() . '.' . $this->letterFile->getClientOriginalExtension();
            
            // Simpan ke storage lokal terlebih dahulu
            $outputPathRelative = 'generated_letters/' . $fileName;
            $fullOutputPath = Storage::disk('public')->path($outputPathRelative);

            // Pastikan direktori output ada
            $outputDirectory = dirname($fullOutputPath);
            if (!file_exists($outputDirectory)) {
                mkdir($outputDirectory, 0755, true);
            }

            // Simpan file ke storage lokal
            file_put_contents($fullOutputPath, file_get_contents($this->letterFile->getRealPath()));

            // Update surat dengan file path lokal dan ubah status ke pending (perlu approval)
            $this->selectedLetter->file_path = $outputPathRelative;
            $this->selectedLetter->status = 'verification_tendik'; // Ubah ke verification_tendik untuk alur 3 tahap
            $this->selectedLetter->save();

            // File akan dipindahkan ke Google Drive otomatis ketika surat di-approve melalui ApproveLetters.php

            // Kirim notifikasi ke dosen bahwa surat sudah selesai
            $dosen = $this->selectedLetter->user;

            // Uncomment jika ingin kirim WhatsApp
            // $phone_id = '698591980013677';
            // $recipient = $dosen->phone ?? '628'; // Pastikan ada field phone di user
            // $token = env('META_LONG_LIVED_TOKEN');
            
            // $response = Http::withToken($token)
            //     ->post('https://graph.facebook.com/v22.0/' . $phone_id . '/messages', [
            //         'messaging_product' => 'whatsapp',
            //         'to' => $recipient,
            //         'type' => 'text',
            //         'text' => [
            //             'body' => "✅ *SURAT CUSTOM SELESAI*\n\n" .
            //                     "Yth. {$dosen->name}\n\n" .
            //                     "Surat custom '{$this->selectedLetter->title}' telah selesai dibuat dan telah disetujui.\n\n" .
            //                     "Anda dapat mengunduh surat dari dashboard."
            //         ]
            //     ]);

            $this->closeModal();
            $this->loadWaitingLetters();
            
            session()->flash('success', 'Surat custom berhasil diupload dan menunggu persetujuan Dekan.');

        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengupload surat: ' . $e->getMessage());
        }
    }

    public function rejectCustomLetter($letterId)
    {
        $letter = Letter::find($letterId);
        if ($letter) {
            $letter->status = 'rejected';
            $letter->save();

            // Kirim notifikasi penolakan ke dosen
            $dosen = $letter->user;
            
            // Uncomment jika ingin kirim WhatsApp
            // $phone_id = '698591980013677';
            // $recipient = $dosen->phone ?? '628';
            // $token = env('META_LONG_LIVED_TOKEN');
            
            // $response = Http::withToken($token)
            //     ->post('https://graph.facebook.com/v22.0/' . $phone_id . '/messages', [
            //         'messaging_product' => 'whatsapp',
            //         'to' => $recipient,
            //         'type' => 'text',
            //         'text' => [
            //             'body' => "❌ *SURAT CUSTOM DITOLAK*\n\n" .
            //                     "Yth. {$dosen->name}\n\n" .
            //                     "Maaf, permintaan surat custom '{$letter->title}' tidak dapat diproses.\n\n" .
            //                     "Silahkan hubungi Tendik untuk informasi lebih lanjut."
            //         ]
            //     ]);

            $this->loadWaitingLetters();
            session()->flash('success', 'Surat custom berhasil ditolak.');
        }
    }

    public function render()
    {
        return view('livewire.EDOKUMEN.tendik.persuratan.custom-letter-manager', [
            'waitingLetters' => $this->waitingLetters
        ]);
    }
}
