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

    public $tendikNotes;
    public $rejectionReason;
    public $tendikData = []; // Array untuk data yang diisi Tendik
    public $tendikPlaceholders = []; // Array placeholder khusus Tendik
    public $templateHints = []; // Array hints untuk placeholder



    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

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



        // Inisialisasi data Tendik untuk placeholder yang hanya bisa diisi Tendik
        if ($this->letter->template_id) {
            $template = $this->letter->template;
            if ($template && $template->placeholder_permissions) {
                $permissions = $template->placeholder_permissions;
                $allPlaceholders = array_merge($template->placeholders ?? [], $template->table_placeholders ?? []);

                // Set template hints
                $this->templateHints = $template->placeholder_hints ?? [];

                foreach ($allPlaceholders as $placeholder) {
                    $permission = $permissions[$placeholder] ?? 'dosen';
                    if ($permission === 'tendik') {
                        // Tambahkan ke array tendikPlaceholders
                        $this->tendikPlaceholders[] = $placeholder;

                        // Set nilai dari data_filled jika sudah ada, atau kosong jika belum
                        $this->tendikData[$placeholder] = $dataFilled[$placeholder] ?? '';
                    }
                }
            }
        }
    }

    public function verifyLetter()
    {
        // Dynamic validation rules
        $rules = [

            'tendikNotes' => 'nullable|string|max:1000',
        ];

        // Add validation for tendik data
        foreach ($this->tendikData as $key => $value) {
            $rules["tendikData.{$key}"] = 'required|string|max:255';
        }

        $this->validate($rules, [

            'tendikNotes.max' => 'Catatan maksimal 1000 karakter.',
            'tendikData.*.required' => 'Field ini wajib diisi.',
            'tendikData.*.max' => 'Maksimal 255 karakter.',
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



            // Tambahkan data dari tendikData ke dataFilled
            foreach ($this->tendikData as $key => $value) {
                $dataFilled[$key] = $value;
            }

            // Update data surat untuk verifikasi Tendik
            $this->letter->data_filled = $dataFilled;
            $this->letter->verified_by_tendik_id = Auth::user()->id;
            $this->letter->verified_at_tendik = now();
            $this->letter->tendik_notes = $this->tendikNotes;
            $this->letter->status = 'verification_dekan'; // Lanjut ke tahap verifikasi Dekan
            $this->letter->save();

            Log::info('Letter verified by Tendik', [
                'letter_id' => $this->letter->id,

                'tendik_data' => $this->tendikData,
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

        // Reset pagination when sorting changes
        $this->resetPage();
    }

    public function render()
    {

        return view('livewire.edokumen.tendik.persuratan.verification.verify-by-tendik');
    }
}
