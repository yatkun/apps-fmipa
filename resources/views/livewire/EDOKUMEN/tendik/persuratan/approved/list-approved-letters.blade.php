@push('styles')
    <style>
        .modern-datatable {
            background: white;
            border-radius: 8px;

            overflow: hidden;
        }

        .search-controls {
            background: #fff;
            padding-right: 1rem;
            padding-left: 1rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #dee2e6;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding-left: 2.5rem;
        }

        .search-box .s-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1rem;
        }

        .modern-table {
            margin: 0;
            font-size: 0.875rem;
        }

        .modern-table thead th {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 0.75rem;
            font-weight: 500;
            color: #495057;
            font-size: 0.8rem;
            vertical-align: middle;
            cursor: pointer;
        }

        .modern-table thead th:hover {
            background: #e9ecef;
        }

        .modern-table tbody td {
            padding: 0.75rem;
            border-bottom: 1px solid #efefef;
            vertical-align: middle;
            font-size: 0.8rem;
        }

        .modern-table tbody tr:hover {
            background: #f8f9fa;
        }

        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-pending {
            background: #ffc107;
            color: #212529;
        }

        .status-approved {
            background: #198754;
            color: white;
        }

        .status-rejected {
            background: #dc3545;
            color: white;
        }

        .ava-sm {
            height: 2rem;
            width: 2rem;
        }

        .action-btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .btn-view {
            background: #0d6efd;
            color: white;
            border: 1px solid #0d6efd;
        }

        .btn-view:hover {
            background: #0b5ed7;
            color: white;
        }

        .sortable-column {
            user-select: none;
        }

        .sort-icon {
            margin-left: 0.5rem;
            opacity: 0.5;
            font-size: 0.875rem;
        }

        .sort-icon.active {
            opacity: 1;
            color: #0d6efd;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #6c757d;
        }

        .empty-state-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #dee2e6;
        }

        .empty-state-icon i {
            font-size: 1.5rem;
            color: #6c757d;
        }

        .empty-state-title {
            color: #495057;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.125rem;
        }

        .empty-state-text {
            color: #6c757d;
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 1rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .page-title {
            color: #212529;
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }

        .page-subtitle {
            color: #6c757d;
            font-size: 0.875rem;
            margin-bottom: 0;
        }

        .badge-info-modern {
            background: #0d6efd;
            color: white;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }

        /* Custom Pagination Styles */
        .pagination {
            margin: 0;
        }

        .pagination .page-item {
            margin: 0;
        }

        .pagination .page-link {
            color: #6c757d;
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
        }

        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #fff;
            border-color: #dee2e6;
        }

        /* Loading overlay */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            border-radius: 8px;
        }

        .judul-card {
            font-weight: 600;
            font-size: 15px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .search-controls {
                padding: 0.75rem;
            }

            .search-controls .row>div {
                margin-bottom: 0.75rem;
            }

            .modern-table {
                font-size: 0.8125rem;
            }

            .modern-table thead th,
            .modern-table tbody td {
                padding: 0.5rem;
            }

            .page-title {
                font-size: 1.25rem;
            }
        }
    </style>
@endpush

@section('title', 'Daftar Surat yang Disetujui')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Main Content -->
            <div class="row">
                <div class="col-12">
                    <div class="modern-datatable fade-in">
                        <!-- Search Controls -->
                        <div class="search-controls">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="search-box">
                                        <input type="search" 
                                               wire:model.live.debounce.300ms="search" 
                                               class="form-control"
                                               placeholder="Cari berdasarkan judul surat, nama pengaju...">
                                        <i class="bx bx-search-alt search-icon"></i>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" wire:model.live='perPage'>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                                <div class="mt-2 col-md-3 text-md-end mt-md-0">
                                    <span class="table-info">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Menampilkan {{ $approvedLetters->count() }} dari {{ $approvedLetters->total() }} surat
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table modern-table">
                                <thead>
                                    <tr>
                                        <th style="width: 40%;">
                                            <i class="fas fa-file-alt me-1"></i>
                                            Judul Surat
                                        </th>
                                        <th style="width: 20%;">
                                            <i class="fas fa-user me-1"></i>
                                            Pengaju
                                        </th>
                                        <th style="width: 15%;">
                                            <i class="fas fa-calendar me-1"></i>
                                            Tgl Dibuat
                                        </th>
                                        <th style="width: 15%;">
                                            <i class="fas fa-calendar-check me-1"></i>
                                            Tgl Disetujui
                                        </th>
                                        <th style="width: 10%;" class="text-center">
                                            <i class="fas fa-cogs me-1"></i>
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($approvedLetters as $letter)
                                        <tr>
                                            <td>
                                                <div class="fw-medium text-dark">
                                                    {{ $letter->template->name ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted">
                                                    {{ $letter->user->name ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted">
                                                    {{ $letter->created_at->format('d M Y') }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted">
                                                    {{ $letter->approved_at ? $letter->approved_at->format('d M Y') : 'N/A' }}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button wire:click="downloadLetter({{ $letter->id }})"
                                                        wire:loading.attr="disabled"
                                                        wire:target="downloadLetter({{ $letter->id }})"
                                                        class="action-btn action-btn-success">
                                                    <span wire:loading.remove wire:target="downloadLetter({{ $letter->id }})">
                                                        <i class="fas fa-download"></i> Unduh
                                                    </span>
                                                    <span wire:loading wire:target="downloadLetter({{ $letter->id }})">
                                                        <i class="fas fa-spinner fa-spin"></i> Mengunduh...
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-4 text-center">
                                                <div class="text-muted">
                                                    <i class="mb-2 fas fa-inbox fa-2x d-block"></i>
                                                    Tidak ada surat yang telah disetujui
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-wrapper">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="table-info">
                                    Menampilkan {{ $approvedLetters->firstItem() ?? 0 }} - {{ $approvedLetters->lastItem() ?? 0 }} 
                                    dari {{ $approvedLetters->total() }} data
                                </div>
                                <div>
                                    {{ $approvedLetters->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="modern-datatable">
                        <div class="px-3 pt-3 align-items-center d-flex justify-content-between">
                            <div class=" judul-card">Daftar Surat Disetujui</div>

                        </div>
                        <!-- Search and Filter Controls -->
                        <div class="mt-2 search-controls">
                            <div class="gap-3 d-flex">
                                <div class="search-box flex-grow-1">
                                    <input type="search" wire:model.live.debounce.300ms="search" class="form-control"
                                        placeholder="Cari berdasarkan nama surat...">
                                    <i class="bx bx-search s-icon"></i>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">

                                    <select class="form-select " wire:model.live='perPage'>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                                @if (Auth::user()->level == 'Dosen')
                                    <div>
                                        <a href="{{ route('dosen.persuratan.ajukan-surat') }}" class="btn btn-success">
                                            <i class="bx bx-plus me-2"></i>
                                            Ajukan Surat
                                        </a>
                                    </div>
                                @endif

                            </div>
                           
                        </div>
                        <!-- Data Table -->
                        <div class="table-responsive">
                            <table class="table modern-table" wire:key="{{ uniqid() }}">
                                <thead>
                                    <tr>
                                        <th wire:click="setsortBy('title')" class="sortable-column" style="width: 45%">
                                            <div class="d-flex align-items-center">
                                                <i class="bx bx-file-blank me-2 text-muted"></i>
                                                Nama Surat
                                                @if ($sortBy === 'title')
                                                    <i
                                                        class="bx bx-{{ $sortDir === 'ASC' ? 'up' : 'down' }}-arrow-alt sort-icon active"></i>
                                                @else
                                                    <i class="bx bx-sort-alt-2 sort-icon"></i>
                                                @endif
                                            </div>
                                        </th>
                                        <th wire:click="setsortBy('created_at')" class="sortable-column"
                                            style="width: 20%">
                                            <div class="d-flex align-items-center">
                                                <i class="bx bx-calendar me-2 text-muted"></i>
                                                Tanggal Dibuat
                                                @if ($sortBy === 'created_at')
                                                    <i
                                                        class="bx bx-{{ $sortDir === 'ASC' ? 'up' : 'down' }}-arrow-alt sort-icon active"></i>
                                                @else
                                                    <i class="bx bx-sort-alt-2 sort-icon"></i>
                                                @endif
                                            </div>
                                        </th>
                                        <th wire:click="setsortBy('status')" class="sortable-column" style="width: 20%">
                                            <div class="d-flex align-items-center">
                                                <i class="bx bx-info-circle me-2 text-muted"></i>
                                                Status
                                                @if ($sortBy === 'status')
                                                    <i
                                                        class="bx bx-{{ $sortDir === 'ASC' ? 'up' : 'down' }}-arrow-alt sort-icon active"></i>
                                                @else
                                                    <i class="bx bx-sort-alt-2 sort-icon"></i>
                                                @endif
                                            </div>
                                        </th>
                                        @if (Auth::user()->level !== 'Dosen')
                                            <th style="width: 15%">
                                                <div class="d-flex align-items-center">
                                                    <i class="bx bx-cog me-2 text-muted"></i>
                                                    Aksi
                                                </div>
                                            </th>
                                        @else
                                            <th style="width: 10%">
                                                <div class="d-flex align-items-center">
                                                    <i class="bx bx-cog me-2 text-muted"></i>
                                                    Aksi
                                                </div>
                                            </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pendingLetters as $letter)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div
                                                            class="rounded ava-sm bg-light d-flex align-items-center justify-content-center">
                                                            <i class="bx bx-file text-primary"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="mb-0">
                                                            {{ $letter->template->name ?? $letter->title }}</div>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted">

                                                    {{ $letter->created_at->format('d M Y') }}

                                                </div>
                                            </td>
                                            <td>



                                                <span class="badge rounded-pill bg-warning">{{ $letter->status }}</span>
                                            </td>
                                            @if (Auth::user()->level !== 'Dosen')
                                                <td>
                                                    <div class="gap-2 d-flex">
                                                        <a wire:navigate
                                                            href="{{ route('approve.letter', $letter->hashed_id) }}"
                                                            class="action-btn btn-view" title="Lihat & Review Surat">
                                                            <i class="bx bx-show"></i>
                                                            <span class="d-none d-sm-inline">Review</span>
                                                        </a>
                                                    </div>
                                                </td>
                                            @else
                                                <td>
                                                    <div class="gap-2 d-flex">
                                                        <a wire:navigate
                                                            href="{{ route('dosen.persuratan.detail-surat', $letter->hashed_id) }}"
                                                            class="btn btn-sm btn-outline-info waves-effect waves-light">Detail</a>

                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ Auth::user()->level !== 'Dosen' ? '4' : '3' }}"
                                                class="py-5 text-center">
                                                <div class="empty-state">
                                                    <div class="empty-state-icon">
                                                        @if ($search)
                                                            <i class="bx bx-search-alt-2"></i>
                                                        @else
                                                            <i class="bx bx-file-blank"></i>
                                                        @endif
                                                    </div>
                                                    <h5 class="empty-state-title">
                                                        @if ($search)
                                                            Pencarian Tidak Ditemukan
                                                        @else
                                                            Tidak Ada Surat Pending
                                                        @endif
                                                    </h5>
                                                    <p class="empty-state-text">
                                                        @if ($search)
                                                            Tidak ada surat yang cocok dengan
                                                            "<strong>{{ $search }}</strong>".
                                                            <br>Coba kata kunci lain atau hapus filter pencarian.
                                                        @else
                                                            Saat ini tidak ada surat yang memerlukan persetujuan Anda.
                                                            <br>Surat baru akan muncul di sini ketika ada yang perlu
                                                            direview.
                                                            @if (Auth::user()->level == 'Dosen')
                                                                <br><small class="text-muted">Mulai dengan mengajukan
                                                                    surat baru.</small>
                                                            @endif
                                                        @endif
                                                    </p>
                                                    @if ($search)
                                                        <button class="mt-3 btn btn-outline-primary btn-sm"
                                                            wire:click="$set('search', '')">
                                                            <i class="bx bx-x me-1"></i>
                                                            Hapus Pencarian
                                                        </button>
                                                    @elseif(Auth::user()->level == 'Dosen')
                                                        <a href="{{ route('dosen.persuratan.ajukan-surat') }}"
                                                            class="mt-3 btn btn-success btn-sm">
                                                            <i class="bx bx-plus me-1"></i>
                                                            Ajukan Surat Baru
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($pendingLetters->hasPages())
                            <div class="p-3 d-flex justify-content-between align-items-center bg-light border-top">
                                <div class="text-muted">
                                    <small>
                                        <i class="bx bx-info-circle me-1"></i>
                                        Menampilkan {{ $pendingLetters->firstItem() ?? 0 }} -
                                        {{ $pendingLetters->lastItem() ?? 0 }}
                                        dari {{ $pendingLetters->total() }} surat
                                    </small>
                                </div>
                                <div class="gap-3 d-flex align-items-center">
                                    <!-- Page Size Info -->
                                    <small class="text-muted d-none d-md-block">
                                        {{ $perPage }} per halaman
                                    </small>
                                    <!-- Pagination Links -->
                                    <div id="pagination-container">
                                        {{ $pendingLetters->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="p-3 text-center bg-light border-top">
                                <small class="text-muted">
                                    <i class="bx bx-info-circle me-1"></i>
                                    {{ $pendingLetters->total() }} surat ditemukan
                                </small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Script untuk Handle Notifikasi dan Loading -->


@push('scripts')
    {{-- Livewire script sudah diload di layout --}}
@endpush
