<?php

namespace App\Livewire\EDOKUMEN\Tendik\Persuratan\Approved;

use App\Models\Letter;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ListApprovedLettersWithComponent extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    protected $listeners = [
        'searchUpdated' => 'updateSearch',
        'sortUpdated' => 'updateSort',
        'downloadLetter' => 'downloadLetter'
    ];

    public function updateSearch($value)
    {
        $this->search = $value;
        $this->resetPage();
    }

    public function updateSort($field, $direction)
    {
        $this->sortBy = $field;
        $this->sortDir = $direction;
        $this->resetPage();
    }

    public function downloadLetter($letterId)
    {
        try {
            $letter = Letter::find($letterId);
            if (!$letter) {
                session()->flash('error', 'Surat tidak ditemukan.');
                return;
            }

            $filePath = $letter->file_path;
            
            if (str_starts_with($filePath, 'Surat/')) {
                if (Storage::disk('google')->exists($filePath)) {
                    $content = Storage::disk('google')->get($filePath);
                    
                    if (empty($content) || strlen($content) < 100) {
                        session()->flash('error', 'File surat kosong atau rusak.');
                        return;
                    }
                    
                    $zipSignature = substr($content, 0, 4);
                    if ($zipSignature !== "PK\x03\x04" && $zipSignature !== "PK\x05\x06" && $zipSignature !== "PK\x07\x08") {
                        session()->flash('error', 'File bukan format DOCX yang valid.');
                        return;
                    }
                    
                    $fileName = basename($filePath);
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
                if (Storage::disk('public')->exists($filePath)) {
                    $fullPath = Storage::disk('public')->path($filePath);
                    
                    if (!file_exists($fullPath) || !is_readable($fullPath)) {
                        session()->flash('error', 'File tidak dapat dibaca dari storage lokal.');
                        return;
                    }
                    
                    $fileSize = filesize($fullPath);
                    if ($fileSize === false || $fileSize < 100) {
                        session()->flash('error', 'File kosong atau rusak.');
                        return;
                    }
                    
                    $fileName = basename($filePath);
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

    public function render()
    {
        $approvedLetters = Letter::query()
            ->select('letters.*')
            ->join('templates', 'letters.template_id', '=', 'templates.id')
            ->where('status', 'approved')
            ->where('user_id', Auth::user()->id)
            ->with('template', 'approver', 'user')
            ->when($this->search, function ($query, $search) {
                return $query->where('templates.name', 'like', '%' . $search . '%')
                            ->orWhereHas('user', function ($q) use ($search) {
                                $q->where('name', 'like', '%' . $search . '%');
                            });
            })
            ->when($this->sortBy && $this->sortDir, function ($query) {
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
            ->paginate($this->perPage);

        // Konfigurasi untuk component
        $tableConfig = [
            'title' => 'Daftar Surat yang Disetujui',
            'subtitle' => 'Kelola dan unduh surat-surat yang telah disetujui',
            'searchPlaceholder' => 'Cari berdasarkan judul surat, nama pengaju...',
            'rowView' => 'livewire.components.table-rows.approved-letters-row',
            'columns' => [
                [
                    'label' => 'Judul Surat',
                    'field' => 'template_name',
                    'icon' => 'fas fa-file-alt',
                    'sortable' => true,
                    'width' => '40%'
                ],
                [
                    'label' => 'Pengaju',
                    'field' => 'user_name',
                    'icon' => 'fas fa-user',
                    'sortable' => false,
                    'width' => '20%'
                ],
                [
                    'label' => 'Tgl Dibuat',
                    'field' => 'created_at',
                    'icon' => 'fas fa-calendar',
                    'sortable' => true,
                    'width' => '15%'
                ],
                [
                    'label' => 'Tgl Disetujui',
                    'field' => 'approved_at',
                    'icon' => 'fas fa-calendar-check',
                    'sortable' => true,
                    'width' => '15%'
                ],
                [
                    'label' => 'Aksi',
                    'field' => '',
                    'icon' => 'fas fa-cogs',
                    'sortable' => false,
                    'width' => '10%'
                ]
            ],
            'data' => $approvedLetters->items(),
            'emptyStateTitle' => 'Tidak Ada Surat yang Disetujui',
            'emptyStateText' => 'Saat ini tidak ada surat yang telah disetujui.',
            'emptyStateIcon' => 'bx-file-blank',
            'headerActions' => []
        ];

        return view('livewire.edokumen.tendik.persuratan.approved.list-approved-letters-with-component', [
            'approvedLetters' => $approvedLetters,
            'tableConfig' => $tableConfig
        ]);
    }
}
