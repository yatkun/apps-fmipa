<?php

namespace App\Livewire\EDOKUMEN\Tendik\Persuratan\Approval;

use App\Models\Letter;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ListPendingLettersWithComponent extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    protected $listeners = [
        'searchUpdated' => 'updateSearch',
        'sortUpdated' => 'updateSort'
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

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = $this->sortDir === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortBy = $sortByField;
            $this->sortDir = 'ASC';
        }
        $this->resetPage();
    }

    public function render()
    {
        $pendingLetters = Letter::query()
            ->with(['template', 'user'])
            ->where('status', 'pending')
            ->when(Auth::user()->level !== 'Dosen', function ($query) {
                // Jika bukan dosen, tampilkan semua surat pending
                return $query;
            }, function ($query) {
                // Jika dosen, hanya tampilkan surat milik sendiri
                return $query->where('user_id', Auth::id());
            })
            ->when($this->search, function ($query, $search) {
                return $query->whereHas('template', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })->orWhere('title', 'like', '%' . $search . '%');
            })
            ->when($this->sortBy && $this->sortDir, function ($query) {
                if ($this->sortBy === 'title') {
                    return $query->leftJoin('templates', 'letters.template_id', '=', 'templates.id')
                                 ->orderBy('templates.name', $this->sortDir);
                } else {
                    return $query->orderBy($this->sortBy, $this->sortDir);
                }
            })
            ->paginate($this->perPage);

        // Konfigurasi untuk component
        $tableConfig = [
            'title' => 'Daftar Surat Menunggu Persetujuan',
            'subtitle' => 'Kelola dan review dokumen yang memerlukan persetujuan Anda',
            'searchPlaceholder' => 'Cari berdasarkan nama surat...',
            'rowView' => 'livewire.components.table-rows.pending-letters-row',
            'columns' => [
                [
                    'label' => 'Nama Surat',
                    'field' => 'title',
                    'icon' => 'bx bx-file-blank',
                    'sortable' => true,
                    'width' => '45%'
                ],
                [
                    'label' => 'Tanggal Dibuat',
                    'field' => 'created_at',
                    'icon' => 'bx bx-calendar',
                    'sortable' => true,
                    'width' => '20%'
                ],
                [
                    'label' => 'Status',
                    'field' => 'status',
                    'icon' => 'bx bx-info-circle',
                    'sortable' => true,
                    'width' => '20%'
                ]
            ],
            'data' => $pendingLetters->items(),
            'emptyStateTitle' => 'Tidak Ada Surat Pending',
            'emptyStateText' => 'Saat ini tidak ada surat yang memerlukan persetujuan Anda.',
            'emptyStateIcon' => 'bx-file-blank',
            'headerActions' => []
        ];

        // Tambahkan kolom aksi jika bukan dosen
        if (Auth::user()->level !== 'Dosen') {
            $tableConfig['columns'][] = [
                'label' => 'Aksi',
                'field' => '',
                'icon' => 'bx bx-cog',
                'sortable' => false,
                'width' => '15%'
            ];
        }

        // Tambahkan tombol header action jika dosen
        if (Auth::user()->level == 'Dosen') {
            $tableConfig['headerActions'][] = '<a href="' . route('dosen.persuratan.ajukan-surat') . '" class="btn btn-success">
                <i class="bx bx-plus me-2"></i>
                Ajukan Surat Baru
            </a>';
        }

        return view('livewire.edokumen.tendik.persuratan.approval.list-pending-letters-with-component', [
            'pendingLetters' => $pendingLetters,
            'tableConfig' => $tableConfig
        ]);
    }
}
