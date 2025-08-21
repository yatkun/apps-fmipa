@push('styles')
    <style>
        .modern-datatable {
            background: white;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            overflow: hidden;
        }

        .search-controls {
            background: #f8f9fa;
            padding: 1rem;
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
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 0.75rem;
            font-weight: 600;
            color: #495057;
            font-size: 0.875rem;
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
            font-size: 0.875rem;
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

@section('title', 'Daftar Surat Menunggu Persetujuan')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="mb-4 row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        {{-- <div>
                            <h1 class="page-title">
                               
                                
                               
                            </h1>
                            <p class="page-subtitle">
                                Kelola dan review dokumen yang memerlukan persetujuan Anda
                            </p>
                        </div> --}}
                       
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="page-title-box" style="padding-bottom: 0px !important;">
                                
                                <h4 class="mb-sm-0 font-size-18">Daftar Surat Menunggu Persetujuan</h4>
                            </div>

                        </div>
                        @if (Auth::user()->level == 'Dosen')
                            <div>
                                <a href="{{ route('dosen.persuratan.ajukan-surat') }}" class="btn btn-success">
                                    <i class="bx bx-plus me-2"></i>
                                    Ajukan Surat Baru
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="row">
                <div class="col-12">
                    <div class="modern-datatable">
                        <!-- Search and Filter Controls -->
                        <div class="search-controls">
                            <div class="row align-items-center">
                                <div class="col-lg-11">
                                    <div class="search-box">
                                        <input type="search" wire:model.live.debounce.300ms="search"
                                            class="form-control"
                                            placeholder="Cari berdasarkan nama surat...">
                                        <i class="bx bx-search s-icon"></i>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="d-flex align-items-center justify-content-end">

                                        <select class="form-select " wire:model.live='perPage'>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                </div>

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
                                                        <h6 class="mb-0">
                                                            {{ $letter->template->name ?? $letter->title }}</h6>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted fs-6">

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search input loading indicator
            const searchInput = document.querySelector('input[wire\\:model\\.live\\.debounce\\.300ms="search"]');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchBox = this.closest('.search-box');
                    const icon = searchBox.querySelector('.search-icon');

                    // Show loading
                    icon.className = 'bx bx-loader-alt bx-spin search-icon';

                    // Reset after delay
                    setTimeout(() => {
                        icon.className = 'bx bx-search search-icon';
                    }, 500);
                });
            }
        });

        // Livewire event listeners
        document.addEventListener('livewire:init', function() {
            // Pagination loading
            Livewire.hook('message.sent', () => {
                const container = document.querySelector('#pagination-container');
                if (container) {
                    container.style.opacity = '0.6';
                    container.style.pointerEvents = 'none';
                }

                // Add loading overlay to table
                const tableContainer = document.querySelector('.table-responsive');
                if (tableContainer && !tableContainer.querySelector('.loading-overlay')) {
                    const loadingOverlay = document.createElement('div');
                    loadingOverlay.className = 'loading-overlay';
                    loadingOverlay.innerHTML = `
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="spinner-border text-primary me-2" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span class="text-muted">Memuat data...</span>
                    </div>
                `;
                    tableContainer.style.position = 'relative';
                    tableContainer.appendChild(loadingOverlay);
                }
            });

            Livewire.hook('message.processed', () => {
                const container = document.querySelector('#pagination-container');
                if (container) {
                    container.style.opacity = '1';
                    container.style.pointerEvents = 'auto';
                }

                // Remove loading overlay
                const loadingOverlay = document.querySelector('.loading-overlay');
                if (loadingOverlay) {
                    loadingOverlay.remove();
                }
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.querySelector(
                'input[wire\\:model\\.live\\.debounce\\.300ms="search"]');
                if (searchInput) {
                    searchInput.focus();
                    searchInput.select();
                }
            }
        });
    </script>
@endpush
