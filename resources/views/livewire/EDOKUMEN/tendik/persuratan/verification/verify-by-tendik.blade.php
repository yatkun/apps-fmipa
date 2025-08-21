<div class="main-content">
    <div class="page-content">
<div class="py-4 container-fluid">
    <!-- Header Section -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="border-0 shadow-sm card">
                <div class="text-white card-header bg-primary">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-clipboard-check me-2"></i>
                            Verifikasi Surat oleh Tendik
                        </h5>
                        <a href="{{ route('list.verification.tendik') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Letter Information Card -->
    <div class="mb-4 row">
        <div class="mx-auto col-lg-8">
            <div class="border-0 shadow-sm card">
                <div class="text-white card-header bg-info">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Surat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Judul Surat:</label>
                                <p class="mb-0">{{ $letter->title ?? 'Tidak ada judul' }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Template:</label>
                                <p class="mb-0">
                                    @if ($letter->template)
                                        {{ $letter->template->name }}
                                    @else
                                        <span class="badge bg-secondary">Surat Custom</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Pengaju:</label>
                                <p class="mb-0">{{ $letter->creator->name ?? 'Unknown' }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Tanggal Pengajuan:</label>
                                <p class="mb-0">{{ $letter->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    @if ($letter->file_path)
                        <div class="pt-3 mt-3 border-top">
                            <a href="{{ route('letters.show', $letter->hashed_id) }}"
                                class="btn btn-outline-primary btn-sm" target="_blank">
                                <i class="fas fa-eye me-1"></i>
                                Lihat Dokumen
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Verification Form -->
    <div class="row">
        <div class="mx-auto col-lg-8">
            <div class="border-0 shadow-sm card">
                <div class="text-white card-header bg-success">
                    <h6 class="mb-0">
                        <i class="fas fa-check-circle me-2"></i>
                        Form Verifikasi
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Letter Number Input -->
                    <div class="mb-4">
                        <label for="letterNumber" class="form-label fw-bold">
                            Nomor Surat <span class="text-danger">*</span>
                        </label>
                        <input type="text" wire:model="letterNumber"
                            class="form-control @error('letterNumber') is-invalid @enderror" id="letterNumber"
                            placeholder="Masukkan nomor surat (contoh: 001/FMIPA/2024)">
                        @error('letterNumber')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-info-circle text-primary me-1"></i>
                            Nomor surat akan digunakan sebagai identitas resmi dokumen
                        </div>
                    </div>

                    <!-- Notes Input -->
                    <div class="mb-4">
                        <label for="tendikNotes" class="form-label fw-bold">
                            Catatan Verifikasi <span class="text-muted">(Opsional)</span>
                        </label>
                        <textarea wire:model="tendikNotes" class="form-control @error('tendikNotes') is-invalid @enderror" id="tendikNotes"
                            rows="4" placeholder="Tambahkan catatan verifikasi jika diperlukan..."></textarea>
                        @error('tendikNotes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-info-circle text-primary me-1"></i>
                            Catatan ini akan disertakan dalam riwayat verifikasi
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="gap-3 d-flex">
                        <button type="button" wire:click="verifyLetter" class="px-4 btn btn-success"
                            wire:loading.attr="disabled">
                            <div wire:loading wire:target="verifyLetter" class="spinner-border spinner-border-sm me-2"
                                role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <i class="fas fa-check me-2" wire:loading.remove wire:target="verifyLetter"></i>
                            <span wire:loading.remove wire:target="verifyLetter">Verifikasi & Teruskan ke Dekan</span>
                            <span wire:loading wire:target="verifyLetter">Memverifikasi...</span>
                        </button>

                        <button type="button" class="px-4 btn btn-outline-danger" data-bs-toggle="modal"
                            data-bs-target="#rejectModal">
                            <i class="fas fa-times me-2"></i>
                            Tolak Surat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="text-white modal-header bg-danger">
                    <h5 class="modal-title" id="rejectModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Tolak Surat
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        Surat yang ditolak akan dikembalikan kepada pengaju dengan alasan penolakan.
                    </div>

                    <div class="mb-3">
                        <label for="rejectionReason" class="form-label fw-bold">
                            Alasan Penolakan <span class="text-danger">*</span>
                        </label>
                        <textarea wire:model="rejectionReason" class="form-control @error('rejectionReason') is-invalid @enderror"
                            id="rejectionReason" rows="4" placeholder="Jelaskan alasan penolakan secara detail..."></textarea>
                        @error('rejectionReason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" wire:click="rejectLetter" class="btn btn-danger"
                        wire:loading.attr="disabled" data-bs-dismiss="modal">
                        <div wire:loading wire:target="rejectLetter" class="spinner-border spinner-border-sm me-2"
                            role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <i class="fas fa-times me-2" wire:loading.remove wire:target="rejectLetter"></i>
                        <span wire:loading.remove wire:target="rejectLetter">Tolak Surat</span>
                        <span wire:loading wire:target="rejectLetter">Menolak...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
<!-- Reject Modal -->


@push('scripts')
    <script>
        // Auto-close modal after rejection
        Livewire.on('letterRejected', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('rejectModal'));
            if (modal) {
                modal.hide();
            }
        });
    </script>
@endpush
