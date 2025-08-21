<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan\Verification;

use App\Models\Letter;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\TelegramNotificationService;

class VerifyByTendik extends Component
{
    public $letterId;
    public $letter;
    public $letterNumber;
    public $tendikNotes;
    public $rejectionReason;

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

        // Pastikan hanya surat 'verification_tendik' yang bisa diverifikasi
        if ($this->letter->status !== 'verification_tendik') {
            session()->flash('error', 'Surat ini sudah diproses atau bukan dalam tahap verifikasi Tendik.');
            return redirect()->route('list.verification.tendik');
        }

        // Validasi akses: hanya Tendik yang bisa verifikasi
        if (Auth::user()->level !== 'Tendik') {
            session()->flash('error', 'Anda tidak memiliki akses untuk verifikasi ini.');
            return redirect()->route('dashboard');
        }

        // Set nomor surat dari data_filled jika sudah ada
        $dataFilled = is_string($this->letter->data_filled) 
            ? json_decode($this->letter->data_filled, true) 
            : $this->letter->data_filled;
        
        $this->letterNumber = $dataFilled['no_surat'] ?? '';
    }

    public function verifyLetter()
    {
        $this->validate([
            'letterNumber' => 'required|string|max:255',
            'tendikNotes' => 'nullable|string|max:1000',
        ], [
            'letterNumber.required' => 'Nomor surat wajib diisi.',
            'letterNumber.max' => 'Nomor surat maksimal 255 karakter.',
            'tendikNotes.max' => 'Catatan maksimal 1000 karakter.',
        ]);

        try {
            if ($this->letter->status !== 'verification_tendik') {
                session()->flash('error', 'Surat ini sudah tidak dalam tahap verifikasi Tendik.');
                return;
            }

            // Update nomor surat di data_filled
            $dataFilled = is_string($this->letter->data_filled) 
                ? json_decode($this->letter->data_filled, true) 
                : $this->letter->data_filled;
            
            $dataFilled['no_surat'] = $this->letterNumber;
            
            // Update data surat untuk verifikasi Tendik
            $this->letter->data_filled = $dataFilled;
            $this->letter->verified_by_tendik_id = Auth::user()->id;
            $this->letter->verified_at_tendik = now();
            $this->letter->tendik_notes = $this->tendikNotes;
            $this->letter->status = 'verification_dekan'; // Lanjut ke tahap verifikasi Dekan
            $this->letter->save();

            Log::info('Letter verified by Tendik', [
                'letter_id' => $this->letter->id,
                'letter_number' => $this->letterNumber,
                'verified_by' => Auth::user()->id,
                'notes' => $this->tendikNotes
            ]);

            // Send Telegram notification
            if ($this->telegramService) {
                $this->telegramService->notifyLetterVerifiedByTendik($this->letter);
            } else {
                Log::warning('Telegram service not available for notification', [
                    'letter_id' => $this->letter->id
                ]);
            }

            session()->flash('message', 'Surat berhasil diverifikasi dan diteruskan ke Dekan untuk persetujuan!');
            return redirect()->route('list.verification.tendik');
        } catch (\Exception $e) {
            Log::error('Error verifying letter by Tendik', [
                'letter_id' => $this->letter->id,
                'error' => $e->getMessage()
            ]);
            session()->flash('error', 'Gagal memverifikasi surat: ' . $e->getMessage());
        }
    }

    public function rejectLetter()
    {
        $this->validate([
            'rejectionReason' => 'required|string|min:10|max:1000',
        ], [
            'rejectionReason.required' => 'Alasan penolakan wajib diisi.',
            'rejectionReason.min' => 'Alasan penolakan minimal 10 karakter.',
            'rejectionReason.max' => 'Alasan penolakan maksimal 1000 karakter.',
        ]);

        try {
            if ($this->letter->status !== 'verification_tendik') {
                session()->flash('error', 'Surat ini sudah tidak dalam tahap verifikasi Tendik.');
                return;
            }

            $this->letter->status = 'rejected';
            $this->letter->rejection_reason = $this->rejectionReason;
            $this->letter->verified_by_tendik_id = Auth::user()->id;
            $this->letter->verified_at_tendik = now();
            $this->letter->save();

            Log::info('Letter rejected by Tendik', [
                'letter_id' => $this->letter->id,
                'rejected_by' => Auth::user()->id,
                'reason' => $this->rejectionReason
            ]);

            // Send Telegram notification
            if ($this->telegramService) {
                $this->telegramService->notifyLetterRejected($this->letter, 'Tendik');
            } else {
                Log::warning('Telegram service not available for notification', [
                    'letter_id' => $this->letter->id
                ]);
            }

            session()->flash('success', 'Surat berhasil ditolak.');
            return redirect()->route('list.verification.tendik');
        } catch (\Exception $e) {
            Log::error('Error rejecting letter by Tendik', [
                'letter_id' => $this->letter->id,
                'error' => $e->getMessage()
            ]);
            session()->flash('error', 'Gagal menolak surat: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.edokumen.tendik.persuratan.verification.verify-by-tendik');
    }
}
