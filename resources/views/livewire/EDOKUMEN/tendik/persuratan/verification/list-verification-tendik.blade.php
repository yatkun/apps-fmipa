@push('styles')
    <style>
        /* Modal Styles */
        .modal.show {
            display: block !important;
        }

        .modal-backdrop {
            z-index: 1040;
        }

        .modal {
            z-index: 1050;
        }

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

        .search-box i{
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
                min-width: 800px; /* Ensure table has minimum width on mobile */
            }

            .modern-table thead th,
            .modern-table tbody td {
                padding: 0.75rem;
                white-space: normal; /* Allow text to wrap */
                min-width: 120px; /* Minimum width for columns */
            }

            .modern-table th:nth-child(1) { /* Nama Surat column */
                width: 35%;
                min-width: 200px;
            }

            .modern-table th:nth-child(2) { /* Pengaju column */
                width: 25%;
                min-width: 180px;
            }

            .modern-table th:nth-child(3) { /* Waktu Pengajuan column */
                width: 20%;
                min-width: 150px;
            }

            .modern-table th:nth-child(4) { /* Aksi column */
                width: 20%;
                min-width: 150px;
            }

            .table-responsive {
                margin: 0;
                padding: 0;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .btn-group {
                flex-wrap: nowrap;
            }

            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }

            .page-title {
                font-size: 1.25rem;
            }
        }
    </style>
@endpush

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
           

            <div class="row">
                <div class="col-12">
                    <div class="modern-datatable">
                        <div class="px-3 pt-3 align-items-center d-flex justify-content-between">
                            <div class=" judul-card">Menunggu Persetujuan Tendik</div>

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


                            </div>

                        </div>
                        <!-- Data Table -->
                        <div class="table-responsive">
                            <table class="table modern-table" wire:key="{{ uniqid() }}">
                                <thead>
                                    <tr>
                                        <th wire:click="setsortBy('title')" class="sortable-column">
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

                                        <th wire:click="setsortBy('creator_name')" class="sortable-column">
                                            <div class="d-flex align-items-center">
                                                <i class="bx bx-info-circle me-2 text-muted"></i>
                                                Pengaju
                                                @if ($sortBy === 'creator_name')
                                                    <i
                                                        class="bx bx-{{ $sortDir === 'ASC' ? 'up' : 'down' }}-arrow-alt sort-icon active"></i>
                                                @else
                                                    <i class="bx bx-sort-alt-2 sort-icon"></i>
                                                @endif
                                            </div>
                                        </th>
                                        <th wire:click="setsortBy('created_at')" class="sortable-column"
                                            >
                                            <div class="d-flex align-items-center">
                                                <i class="bx bx-info-circle me-2 text-muted"></i>
                                                Waktu Pengajuan
                                                @if ($sortBy === 'created_at')
                                                    <i
                                                        class="bx bx-{{ $sortDir === 'ASC' ? 'up' : 'down' }}-arrow-alt sort-icon active"></i>
                                                @else
                                                    <i class="bx bx-sort-alt-2 sort-icon"></i>
                                                @endif
                                            </div>
                                        </th>
                                        <th>Aksi</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($verificationLetters as $index => $letter)
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
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">
                                                        <div class="text-white bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                            style="width: 32px; height: 32px; font-size: 12px;">
                                                            {{ strtoupper(substr($letter->creator->name ?? 'U', 0, 1)) }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="fw-medium">
                                                            {{ $letter->creator->name ?? 'Unknown' }}</div>
                                                        <small
                                                            class="text-muted">{{ $letter->creator->level ?? 'N/A' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-nowrap">
                                                    <div class="fw-medium">
                                                        {{ $letter->created_at->format('d M Y') }}
                                                    </div>
                                                    <small class="text-muted">
                                                        {{ $letter->created_at->format('H:i') }}
                                                    </small>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if ($letter->status === 'waiting_template')
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        wire:click="selectLetter({{ $letter->id }})"
                                                        wire:loading.attr="disabled" wire:loading.class="disabled"
                                                        title="Upload Surat">
                                                        <i class="fas fa-upload"></i> Upload Surat
                                                    </button>
                                                @endif
                                                @if ($letter->status === 'verification_tendik')
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('verify.by.tendik', $letter->hashed_id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="fas fa-check me-1"></i>
                                                            Verifikasi
                                                        </a>
                                                        <a href="{{ route('letters.show', $letter->hashed_id) }}"
                                                            class="btn btn-sm btn-outline-secondary" target="_blank">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
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
                        @if ($verificationLetters->hasPages())
                            <div class="p-3 d-flex justify-content-between align-items-center bg-light border-top">
                                <div class="text-muted">
                                    <small>
                                        <i class="bx bx-info-circle me-1"></i>
                                        Menampilkan {{ $verificationLetters->firstItem() ?? 0 }} -
                                        {{ $verificationLetters->lastItem() ?? 0 }}
                                        dari {{ $verificationLetters->total() }} surat
                                    </small>
                                </div>
                                <div class="gap-3 d-flex align-items-center">
                                    <!-- Page Size Info -->
                                    <small class="text-muted d-none d-md-block">
                                        {{ $perPage }} per halaman
                                    </small>
                                    <!-- Pagination Links -->
                                    <div id="pagination-container">
                                        {{ $verificationLetters->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="p-3 text-center bg-light border-top">
                                <small class="text-muted">
                                    <i class="bx bx-info-circle me-1"></i>
                                    {{ $verificationLetters->total() }} surat ditemukan
                                </small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Upload Modal -->
    <div class="modal @if ($showUploadModal && $selectedLetter) show d-block @else d-none @endif" tabindex="-1"
        style="background-color: rgba(0,0,0,0.5); z-index: 1050;" id="uploadModal"
        wire:key="modal-{{ $selectedLetter ? $selectedLetter->id : 'none' }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-file-upload me-2"></i>
                        Upload Surat Custom
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                </div>
                @if ($selectedLetter)
                    <div class="modal-body">
                        <!-- Info Surat -->
                        <div class="mb-4 card">
                            <div class="card-body">
                                <h6 class="card-title">Detail Permintaan Surat</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Dosen:</strong> {{ $selectedLetter->user->name }}<br>
                                        <strong>Judul:</strong> {{ $selectedLetter->title }}<br>
                                        <strong>Tanggal:</strong> {{ $selectedLetter->created_at->format('d/m/Y H:i') }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Isi Surat:</strong><br>
                                        <div class="p-2 rounded bg-light">
                                            {{ $selectedLetter->data_filled['custom_content'] ?? 'Tidak ada isi' }}
                                        </div>
                                    </div>
                                </div>
                                @if (!empty($selectedLetter->data_filled['catatan']))
                                    <div class="mt-2">
                                        <strong>Catatan:</strong><br>
                                        <div class="p-2 rounded bg-warning bg-opacity-10">
                                            {{ $selectedLetter->data_filled['catatan'] }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Form Upload -->
                        <form wire:submit="uploadLetter">
                            <div class="mb-3">
                                <label for="letterFile" class="form-label">File Surat (.docx)</label>
                                <input type="file" class="form-control @error('letterFile') is-invalid @enderror"
                                    id="letterFile" wire:model="letterFile" accept=".docx">

                                <div wire:loading wire:target="letterFile" class="mt-2">
                                    <div class="d-flex align-items-center text-primary">
                                        <div class="spinner-border spinner-border-sm me-2" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <small>Sedang mengupload file...</small>
                                    </div>
                                </div>

                                @error('letterFile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Upload surat yang sudah selesai dibuat untuk permintaan surat custom ini
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <small>
                                    <i class="fas fa-lightbulb me-1"></i>
                                    <strong>Petunjuk:</strong> Upload file surat yang sudah selesai dibuat berdasarkan
                                    permintaan dosen.
                                    Setelah upload, surat akan diteruskan ke Dekan untuk ditanda tangan.
                                </small>
                            </div>

                            <div class="gap-2 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary" wire:click="closeModal">
                                    <i class="fas fa-times me-1"></i>
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-success" 
                                    wire:loading.attr="disabled"
                                    wire:target="letterFile,uploadLetter"
                                    @if(!$letterFile || $errors->has('letterFile')) disabled @endif>
                                    <span wire:loading.remove wire:target="uploadLetter">
                                        <i class="fas fa-upload me-1"></i>
                                        Upload Surat
                                    </span>
                                    <span wire:loading wire:target="uploadLetter">
                                        <i class="fas fa-spinner fa-spin me-1"></i>
                                        Mengupload...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', function() {
                Livewire.on('modal-opened', function() {
                    document.body.style.overflow = 'hidden';
                });

                Livewire.on('modal-closed', function() {
                    document.body.style.overflow = 'auto';
                });
            });
        </script>
    @endpush
</div>
