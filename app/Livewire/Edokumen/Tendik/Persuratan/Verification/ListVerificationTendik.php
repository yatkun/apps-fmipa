<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan\Verification;

use App\Models\Letter;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ListVerificationTendik extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public $letter;
    public $showUploadModal = false;
    public $selectedLetter = null;
    public $letterFile = null;
    public $previewUrl;
    public $verificationNote = '';
    public $rejectionNote = '';
    public $templateHints = [];
    public $tendikData = [];
    public $dok_ulang = null;
    public $newDocument;

    public $tendikPlaceholders = [];

    public function mount()
    {
        // Validasi akses hanya untuk Tendik
        if (Auth::user()->level !== 'Tendik') {
            session()->flash('error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('dashboard');
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

    

    public function preview($letterId)
    {
        try {
            $this->letter = Letter::with('template')->findOrFail($letterId);

            
            $this->selectedLetter = $this->letter;

            $dataFilled = is_string($this->letter->data_filled)
                ? json_decode($this->letter->data_filled, true)
                : $this->letter->data_filled;

            
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
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memuat preview dokumen: ' . $e->getMessage());
        }
    }

    public function resetPreview()
    {
        $this->previewUrl = null;
        $this->selectedLetter = null;
        $this->verificationNote = '';
        $this->rejectionNote = '';
        $this->tendikData = [];
        $this->tendikPlaceholders = [];
        $this->templateHints = [];
    }

    public function verifyLetter()
    {
       
        $this->selectedLetter->verified_by_tendik_id = Auth::id();
        $this->selectedLetter->verified_at_tendik = now();
        $this->selectedLetter->tendik_notes = $this->verificationNote;
        $this->selectedLetter->status = 'verification_dekan';
        $this->selectedLetter->save();
        dd('ok');
        
        
        // try {
          

        //     $this->selectedLetter->verified_by_tendik_id = Auth::id();

        //     $this->selectedLetter->verified_at_tendik = now();
        //     $this->selectedLetter->verification_note_tendik = $this->verificationNote;
        //     $this->selectedLetter->status = 'verification_dekan';
        //     $this->selectedLetter->save();
         
        //     session()->flash('success', 'Surat berhasil diverifikasi.');
        //     $this->resetPreview();
        //     $this->dispatch('close-modal');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     session()->flash('error', 'Gagal memverifikasi surat: ' . $e->getMessage());
        // }
    }

    public function rejectLetter()
    {
        if (!$this->selectedLetter) {
            session()->flash('error', 'Surat tidak ditemukan.');
            return;
        }

      
        try {
            $this->selectedLetter->verified_by_tendik_id = Auth::id();
            $this->selectedLetter->verified_at_tendik = now();
            $this->selectedLetter->rejection_reason = $this->rejectionNote;
           
            $this->selectedLetter->status = 'rejected';
           
        
            $this->selectedLetter->save();

            session()->flash('success', 'Surat berhasil ditolak.');
            $this->resetPreview();
            $this->dispatch('close-modal');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menolak surat: ' . $e->getMessage());
        }
    }

    public function selectLetter($letterId)
    {
        $this->selectedLetter = Letter::find($letterId);
        $this->showUploadModal = true;
        $this->letterFile = null; // Reset file input
        $this->dispatch('modal-opened');
    }

    public function closeModal()
    {
        $this->showUploadModal = false;
        $this->selectedLetter = null;
        $this->letterFile = null;
        $this->dispatch('modal-closed');
    }

    protected $rules = [
        'letterFile' => 'required|file|mimes:pdf,doc,docx|max:10240', // max 10MB
        'rejectionNote' => 'required|string|min:10|max:1000',
    ];

    public function updatedLetterFile()
    {
        $this->validateOnly('letterFile');
    }

    public function uploadLetter()
    {



        $this->validate($this->rules);

        try {

            // Create unique filename
            $fileName = 'surat_custom_' . \Illuminate\Support\Str::slug($this->selectedLetter->title) . '_' . time() . '.' . $this->letterFile->getClientOriginalExtension();

            // Set relative path for storage
            $outputPathRelative = 'generated_letters/' . $fileName;
            $fullOutputPath = Storage::disk('public')->path($outputPathRelative);

            // Ensure output directory exists
            $outputDirectory = dirname($fullOutputPath);
            if (!file_exists($outputDirectory)) {
                mkdir($outputDirectory, 0755, true);
            }

            // Save file to local storage
            file_put_contents($fullOutputPath, file_get_contents($this->letterFile->getRealPath()));


            $this->selectedLetter->file_path = $outputPathRelative;
            $this->selectedLetter->verified_by_tendik_id = Auth::user()->id;
            $this->selectedLetter->verified_at_tendik = now();
            $this->selectedLetter->status = 'verification_dekan';
            $this->selectedLetter->save();



            session()->flash('success', 'Surat berhasil diupload dan disetujui.');

            // Reset component state
            $this->letterFile = null;
            $this->showUploadModal = false;
            $this->selectedLetter = null;

            // Emit event for modal closure
            $this->dispatch('modal-closed');

            // Force a component refresh
            $this->dispatch('refresh');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error uploading verified letter', [
                'letter_id' => isset($letter) ? $letter->id : ($this->selectedLetter->id ?? null),
                'error' => $e->getMessage()
            ]);

            session()->flash('error', 'Gagal mengupload surat: ' . $e->getMessage());
        }
    }

    public function download()
    {
      
        //download document selectedLetter->file_path
        return response()->download(storage_path('app/public/' . $this->selectedLetter->file_path));
    }

    public function uploadulang()
    {
        //get data from wire:model newDocument
        $this->dok_ulang = $this->newDocument;
        
        //replace file selectedLetter->file_path with newDocument with custom name_file
        $this->selectedLetter->file_path = $this->dok_ulang->storeAs('generated_letters', 'surat_perbaikan_' . \Illuminate\Support\Str::slug($this->selectedLetter->title) . '_' . time() . '.' . $this->dok_ulang->getClientOriginalExtension(), 'public');
        $this->selectedLetter->save();  




    }
    public function render()
    {
        $verificationLetters = Letter::query()
            ->select('letters.*')
            ->leftJoin('templates', 'letters.template_id', '=', 'templates.id')
            ->whereIn('letters.status', ['verification_tendik', 'waiting_template'])
            ->with(['template', 'creator', 'tendikVerifier'])
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('letters.title', 'like', '%' . $this->search . '%')
                        ->orWhere('letters.data_filled', 'like', '%"no_surat":"' . $this->search . '%')
                        ->orWhereHas('creator', function ($userQuery) {
                            $userQuery->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('template', function ($templateQuery) {
                            $templateQuery->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->sortBy && $this->sortDir, function ($query) {
                if ($this->sortBy === 'template_name') {
                    $query->orderBy('templates.name', $this->sortDir);
                } elseif ($this->sortBy === 'creator_name') {
                    $query->join('users as creators', 'letters.user_id', '=', 'creators.id')
                        ->orderBy('creators.name', $this->sortDir);
                } else {
                    $query->orderBy('letters.' . $this->sortBy, $this->sortDir);
                }
            })
            ->paginate($this->perPage);

        return view('livewire.edokumen.tendik.persuratan.verification.list-verification-tendik', [
            'verificationLetters' => $verificationLetters,
        ]);
    }
}
