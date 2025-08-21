@push('styles')
@endpush

@section('title', 'Kelola Surat Custom')

<div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Kelola Surat Custom</h4>
                            <div class="page-title-right">
                                <ol class="m-0 breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Persuratan</a></li>
                                    <li class="breadcrumb-item active">Surat Custom</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="fas fa-file-upload me-2"></i>
                                    Kelola Surat Custom
                                </h4>
                                <p class="mb-0 card-description">
                                    Daftar permintaan surat custom yang perlu dibuatkan dan diupload suratnya
                                </p>
                            </div>
                            <div class="card-body">
                                <!-- Debug info -->
                                @if (config('app.debug'))
                                    <div class="alert alert-info">
                                        <small>
                                            Debug Info: showUploadModal = {{ $showUploadModal ? 'true' : 'false' }},
                                            selectedLetter = {{ $selectedLetter ? $selectedLetter->id : 'null' }},
                                            waitingLetters count = {{ $waitingLetters->count() }}
                                        </small>
                                        <button type="button" class="btn btn-sm btn-warning" onclick="testModal()">Test
                                            Modal</button>
                                        <button type="button" class="btn btn-sm btn-info"
                                            wire:click="loadWaitingLetters">Refresh Data</button>
                                    </div>
                                @endif

                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fas fa-check-circle me-2"></i>
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                @if (session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                @if ($waitingLetters->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tanggal Pengajuan</th>
                                                    <th>Nama Dosen</th>
                                                    <th>Judul Surat</th>
                                                    <th>Isi Surat</th>
                                                    <th>Catatan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($waitingLetters as $index => $letter)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            <small class="text-muted">
                                                                {{ $letter->created_at->format('d/m/Y H:i') }}
                                                            </small>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar avatar-sm me-2">
                                                                    <div
                                                                        class="text-white avatar-initial bg-primary rounded-circle">
                                                                        {{ substr($letter->user->name, 0, 1) }}
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="fw-semibold">{{ $letter->user->name }}
                                                                    </div>
                                                                    <small
                                                                        class="text-muted">{{ $letter->user->email }}</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge bg-info text-dark">{{ $letter->title }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="text-truncate" style="max-width: 200px;"
                                                                title="{{ $letter->data_filled['custom_content'] ?? '' }}">
                                                                {{ $letter->data_filled['custom_content'] ?? 'Tidak ada isi' }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-truncate" style="max-width: 150px;"
                                                                title="{{ $letter->data_filled['catatan'] ?? '' }}">
                                                                {{ $letter->data_filled['catatan'] ?? '-' }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-success btn-sm"
                                                                    wire:click="selectLetter({{ $letter->id }})"
                                                                    wire:loading.attr="disabled"
                                                                    wire:loading.class="disabled" title="Upload Surat"
                                                                    onclick="console.log('Button clicked for letter {{ $letter->id }}')">
                                                                    <span wire:loading.remove
                                                                        wire:target="selectLetter">
                                                                        <i class="fas fa-upload"></i>
                                                                        Upload Surat
                                                                    </span>
                                                                    <span wire:loading wire:target="selectLetter">
                                                                        <i class="fas fa-spinner fa-spin"></i>
                                                                        Loading...
                                                                    </span>
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    wire:click="rejectCustomLetter({{ $letter->id }})"
                                                                    onclick="return confirm('Yakin ingin menolak surat custom ini?')"
                                                                    title="Tolak Permintaan">
                                                                    <i class="fas fa-times"></i>
                                                                    Tolak
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="py-5 text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-inbox fa-3x text-muted"></i>
                                        </div>
                                        <h5 class="text-muted">Tidak ada permintaan surat custom</h5>
                                        <p class="text-muted">Semua permintaan surat custom sudah diproses</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <form wire:submit.prevent="uploadLetter">
                        <div class="mb-3">
                            <label for="letterFile" class="form-label">File Surat (.pdf, .doc, .docx)</label>
                            <input type="file" class="form-control @error('letterFile') is-invalid @enderror"
                                id="letterFile" wire:model="letterFile" accept=".pdf,.doc,.docx">

                            <!-- Loading indicator for file upload -->
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
                                Setelah upload, surat akan otomatis disetujui dan dosen dapat mengunduhnya.
                            </small>
                        </div>

                        <div class="gap-2 d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">
                                <i class="fas fa-times me-1"></i>
                                Batal
                            </button>
                            <button type="submit" class="btn btn-success" wire:loading.attr="disabled"
                                wire:target="letterFile,uploadLetter">
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
</div>

<!-- Modal Upload Surat -->



@push('styles')
    <style>
        .avatar {
            width: 32px;
            height: 32px;
        }

        .avatar-initial {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .modal.show {
            display: block !important;
        }

        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Modal backdrop click */
        .modal {
            z-index: 1050;
        }

        .modal-backdrop {
            z-index: 1040;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Simple modal handling
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, setting up modal handlers');
        });

        // Livewire hooks
        document.addEventListener('livewire:init', function() {
            console.log('Livewire initialized');

            Livewire.on('modal-opened', function() {
                console.log('Modal opened event received');
                // Prevent body scroll
                document.body.style.overflow = 'hidden';
            });

            Livewire.on('modal-closed', function() {
                console.log('Modal closed event received');
                // Restore body scroll
                document.body.style.overflow = 'auto';
            });
        });

        // Global function for testing
        window.testModal = function() {
            console.log('Testing modal trigger');
            Livewire.find('{{ $this->getId() }}').call('selectLetter', 109);
        };

        // Debug modal state
        @if ($showUploadModal)
            console.log('Modal state: showUploadModal = true, selectedLetter =', @json($selectedLetter ? $selectedLetter->id : null));
        @else
            console.log('Modal state: showUploadModal = false');
        @endif
    </script>
@endpush
