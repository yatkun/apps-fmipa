@push('styles')
<style>


.badge-custom {
    font-size: 0.7rem !important;
    padding: 0.5rem 1rem !important;
    border-radius: 25px !important;
}

.info-card {
    border-left: 4px solid #007bff;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.action-button {
    min-width: 120px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.action-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.data-section {
    background: #ffffff;
    border: 1px solid #e3e6f0;
    border-radius: 6px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.table-modern {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.table-modern thead {
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
}

.key-value-item {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 0.5rem;
    
}

.download-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px dashed #007bff;
}

.modal-modern .modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

.fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Signature Animation Styles */
.signature-container {
    position: relative;
    display: inline-block;
}

.signature-animation {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 80px;
}

.signature-icon {
    animation: signatureFloat 3s ease-in-out infinite, signaturePulse 2s ease-in-out infinite;
    filter: drop-shadow(0 4px 8px rgba(40, 167, 69, 0.3));
}

.signature-line {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, transparent 0%, #28a745 50%, transparent 100%);
    animation: signatureDraw 2.5s ease-in-out infinite;
}

@keyframes signatureFloat {
    0%, 100% {
        transform: translateY(0px) scale(1);
    }
    25% {
        transform: translateY(-8px) scale(1.05);
    }
    50% {
        transform: translateY(-4px) scale(1.02);
    }
    75% {
        transform: translateY(-12px) scale(1.08);
    }
}

@keyframes signaturePulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

@keyframes signatureDraw {
    0% {
        width: 0px;
        opacity: 0;
    }
    30% {
        width: 60px;
        opacity: 1;
    }
    70% {
        width: 100px;
        opacity: 1;
    }
    100% {
        width: 120px;
        opacity: 0;
    }
}

.process-step {
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
    padding: 0.5rem;
    border-radius: 6px;
}

.process-step:hover {
    background-color: rgba(40, 167, 69, 0.1);
}

.process-step.completed {
    background-color: rgba(40, 167, 69, 0.15);
}

.progress-bar {
    transition: width 0.8s ease-in-out;
}

/* Signature Animation Styles */
.signature-container {
    position: relative;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.signature-animation {
    position: relative;
    width: 200px;
    height: 80px;
}

.signature-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: signatureFloat 2s ease-in-out infinite;
    z-index: 2;
}

.signature-line {
    position: absolute;
    bottom: 10px;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent 0%, #28a745 50%, transparent 100%);
    animation: signatureLine 3s ease-in-out infinite;
    border-radius: 2px;
}

@keyframes signatureFloat {
    0%, 100% { 
        transform: translate(-50%, -50%) rotate(-5deg) scale(1);
        opacity: 0.8;
    }
    50% { 
        transform: translate(-50%, -60%) rotate(0deg) scale(1.1);
        opacity: 1;
    }
}

@keyframes signatureLine {
    0%, 100% { 
        background: linear-gradient(90deg, transparent 0%, #28a745 50%, transparent 100%);
        opacity: 0.3;
    }
    50% { 
        background: linear-gradient(90deg, #28a745 0%, #28a745 100%);
        opacity: 1;
        transform: scaleX(1.2);
    }
}

.process-step {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0.5rem;
    border-radius: 6px;
    background: rgba(40, 167, 69, 0.05);
    border-left: 3px solid #28a745;
    transition: all 0.3s ease;
}

.process-step.completed {
    background: rgba(40, 167, 69, 0.1);
    border-left-color: #28a745;
}

.process-step i.fa-spin {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Progress bar animation */
.progress-bar-animated {
    animation: progress-bar-stripes 1s linear infinite;
}

@keyframes progress-bar-stripes {
    0% { background-position: 0 0; }
    100% { background-position: 1rem 0; }
}

/* Modal entrance animation */
.modal.fade .modal-dialog {
    transition: transform 0.4s ease-out;
    transform: translate(0, -50px) scale(0.9);
}

.modal.show .modal-dialog {
    transform: none;
}

/* Button loading state */
.btn-loading {
    position: relative;
    pointer-events: none;
}

.btn-loading::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    margin: auto;
    border: 2px solid transparent;
    border-top-color: currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}
</style>
@endpush

@section('title', 'Detail Persetujuan Surat')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Breadcrumb & Header -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 font-size-18 text-dark">Detail Persetujuan Surat</h4>
                           
                        </div>
                        <div class="gap-2 d-flex">
                            <a href="{{ route('list.pending.letters') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Berhasil!</strong> {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show fade-in" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Main Content Card -->
            <div class="row">
                <div class="col-12">
                    <div class="border-0 shadow-lg card fade-in">
                        <!-- Card Header -->
                        <div class="py-4 border-0 card-header bg-dark bg-gradient">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="text-white fas fa-file-contract fa-2x"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 text-white fw-bold">{{ $letter->template->name ?? 'Surat Custom' }}</h4>
                                        <p class="mb-0 text-white-50">
                                            <i class="fas fa-clock me-1"></i>
                                            Diajukan {{ $letter->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    @php
                                        $statusConfig = [
                                            'pending' => ['class' => 'bg-warning text-dark', 'icon' => 'fas fa-clock'],
                                            'approved' => ['class' => 'bg-success text-white', 'icon' => 'fas fa-check-circle'],
                                            'rejected' => ['class' => 'bg-danger text-white', 'icon' => 'fas fa-times-circle'],
                                            'waiting_template' => ['class' => 'bg-info text-white', 'icon' => 'fas fa-hourglass-half']
                                        ];
                                        $config = $statusConfig[$letter->status] ?? $statusConfig['pending'];
                                    @endphp
                                    <span class="badge badge-soft-warning badge-custom">
                                        <i class="{{ $config['icon'] }} me-1"></i>
                                        {{ ucfirst(str_replace('_', ' ', $letter->status)) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-4 card-body">
                            <!-- Letter Information Section -->
                            <div class="data-section info-card">
                                <h5 class="mb-3 text-primary fw-bold">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Informasi Surat
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="key-value-item">
                                            <small class="text-muted d-block">Template Surat</small>
                                            <strong>{{ $letter->template->name ?? 'Surat Custom' }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="key-value-item">
                                            <small class="text-muted d-block">Tanggal Pengajuan</small>
                                            <strong>{{ $letter->created_at->format('d M Y H:i') }}</strong>
                                        </div>
                                    </div>
                                    @if($letter->user)
                                    <div class="col-md-6">
                                        <div class="key-value-item">
                                            <small class="text-muted d-block">Pengaju</small>
                                            <strong>{{ $letter->user->name }}</strong>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="key-value-item">
                                            <small class="text-muted d-block">ID Surat</small>
                                            <strong>#{{ $letter->id }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Detail Section -->
                            <div class="data-section">
                                <h5 class="mb-4 text-primary fw-bold">
                                    <i class="fas fa-file-alt me-2"></i>
                                    Detail Data Surat
                                </h5>
                                
                                @if($letter->data_filled && count($letter->data_filled) > 0)
                                    <div class="row">
                                        @foreach ($letter->data_filled as $key => $value)
                                            @if ($key === 'table_data' && !empty($value))
                                                <!-- Table Data Section -->
                                                <div class="mb-4 col-12">
                                                    <div class="mb-3 d-flex align-items-center">
                                                        <i class="fas fa-table text-primary me-2"></i>
                                                        <h6 class="mb-0 fw-bold">Data Tabel</h6>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 table-modern table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    @foreach ($letter->template->table_placeholders ?? [] as $ph)
                                                                        <th class="text-white fw-bold">
                                                                            {{ ucfirst(str_replace('_', ' ', $ph)) }}
                                                                        </th>
                                                                    @endforeach
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($value as $rowIndex => $rowData)
                                                                    <tr>
                                                                        @foreach ($letter->template->table_placeholders ?? [] as $ph)
                                                                            <td class="py-3">{{ $rowData[$ph] ?? '-' }}</td>
                                                                        @endforeach
                                                                    </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td colspan="{{ count($letter->template->table_placeholders ?? []) }}" 
                                                                            class="py-4 text-center text-muted">
                                                                            <i class="mb-2 fas fa-inbox fa-2x d-block"></i>
                                                                            Tidak ada data tabel
                                                                        </td>
                                                                    </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @elseif($key !== 'table_data')
                                                <!-- Regular Data Fields -->
                                                <div class="mb-3 col-md-6">
                                                    <div class="key-value-item">
                                                        <small class="mb-1 text-muted d-block">
                                                            {{ ucfirst(str_replace('_', ' ', $key)) }}
                                                        </small>
                                                        <div class="fw-semibold">
                                                            @if($key === 'custom_content')
                                                                <div class="p-3 border-4 rounded bg-light border-start border-info">
                                                                    {!! nl2br(e($value)) !!}
                                                                </div>
                                                            @else
                                                                {{ $value }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="py-5 text-center">
                                        <i class="mb-3 fas fa-file-alt fa-3x text-muted"></i>
                                        <h6 class="text-muted">Tidak ada data detail untuk surat ini</h6>
                                    </div>
                                @endif
                            </div>

                            <!-- Tendik Data Section -->
                            @if($letter->template && $letter->template->placeholder_permissions)
                                @php
                                    $tendikPermissions = $letter->template->placeholder_permissions;
                                    $hasTendikData = false;
                                    $tendikDataCount = 0;
                                    
                                    foreach($tendikPermissions as $placeholder => $permission) {
                                        if($permission === 'tendik' && isset($letter->data_filled[$placeholder])) {
                                            $hasTendikData = true;
                                            $tendikDataCount++;
                                        }
                                    }
                                @endphp
                                
                                @if($hasTendikData)
                                <div class="data-section">
                                    <h5 class="mb-4 text-success fw-bold">
                                        <i class="fas fa-user-shield me-2"></i>
                                        Data yang Diisi oleh Tendik
                                        <span class="badge bg-success ms-2">{{ $tendikDataCount }} field</span>
                                    </h5>
                                    
                                    <div class="p-3 alert alert-success" role="alert">
                                        <i class="fas fa-check-circle me-2"></i>
                                        <strong>Informasi:</strong> Data berikut telah diisi oleh Tendik saat proses verifikasi.
                                    </div>
                                    
                                    <div class="row">
                                        @foreach($tendikPermissions as $placeholder => $permission)
                                            @if($permission === 'tendik' && isset($letter->data_filled[$placeholder]))
                                                <div class="mb-3 col-md-6">
                                                    <div class="p-3 border rounded bg-light">
                                                        <div class="mb-2 d-flex align-items-center">
                                                            <i class="fas fa-tag text-success me-2"></i>
                                                            <strong class="text-success">
                                                                {{ $letter->template->hints[$placeholder] ?? ucfirst(str_replace('_', ' ', $placeholder)) }}
                                                            </strong>
                                                        </div>
                                                        <div class="fw-semibold text-dark">
                                                            {{ $letter->data_filled[$placeholder] }}
                                                        </div>
                                                        <small class="text-muted">
                                                            <i class="fas fa-code me-1"></i>
                                                            Field: {{ $placeholder }}
                                                        </small>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            @endif

                            <!-- Action Section -->
                            <div class="row">
                                <!-- Download Section -->
                                @if($letter->file_path)
                                <div class="mb-3 col-md-6">
                                    <div class="download-section h-100">
                                        <div class="text-center">
                                            <i class="mb-3 fas fa-download fa-2x text-primary"></i>
                                            <h6 class="mb-2 fw-bold">Unduh Dokumen</h6>
                                            <p class="mb-3 text-muted small">Unduh file surat asli untuk review</p>
                                            <button wire:click="downloadLetter"
                                               class="btn btn-outline-primary action-button">
                                                <i class="fas fa-file-download me-2"></i>
                                                Unduh Surat
                                            </button>
                                            
                                            <!-- Debug Button untuk Surat Custom -->
                                            @if(is_null($letter->template_id))
                                                <br><br>
                                                <button wire:click="debugCustomLetter"
                                                   class="btn btn-outline-warning btn-sm">
                                                    <i class="fas fa-bug me-2"></i>
                                                    Debug QR Code
                                                </button>
                                                <br>
                                                <button wire:click="testQrCode"
                                                   class="mt-2 btn btn-outline-info btn-sm">
                                                    <i class="fas fa-qrcode me-2"></i>
                                                    Test QR Generation
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Action Buttons Section -->
                                <div class="mb-3 col-md-6">
                                    <div class="data-section h-100">
                                        <div class="text-center">
                                            @if ($letter->status === 'verification_dekan')
                                                <i class="mb-3 fas fa-clipboard-check fa-2x text-warning"></i>
                                                <h6 class="mb-2 fw-bold">Tindakan Persetujuan</h6>
                                                <p class="mb-3 text-muted small">Pilih tindakan untuk surat ini</p>
                                                <div class="gap-2 d-grid">
                                                    <button type="button" class="btn btn-success action-button"
                                                            data-bs-toggle="modal" data-bs-target="#approveModal">
                                                        <i class="fas fa-check-circle me-2"></i>
                                                        Setujui Surat
                                                    </button>
                                                    <button type="button" class="btn btn-danger action-button" 
                                                            data-bs-toggle="modal" data-bs-target="#rejectModal">
                                                        <i class="fas fa-times-circle me-2"></i>
                                                        Tolak Surat
                                                    </button>
                                                </div>
                                            @elseif($letter->status === 'approved')
                                                <i class="mb-3 fas fa-check-circle fa-2x text-success"></i>
                                                <h6 class="mb-2 fw-bold text-success">Surat Disetujui</h6>
                                                <div class="mb-0 alert alert-success">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-user-check me-2"></i>
                                                        <div class="text-start">
                                                            <small class="d-block">Disetujui oleh:</small>
                                                            <strong>{{ $letter->approver->name ?? 'N/A' }}</strong>
                                                            <small class="d-block text-muted">
                                                                {{ $letter->approved_at->format('d M Y H:i') }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($letter->status === 'rejected')
                                                <i class="mb-3 fas fa-times-circle fa-2x text-danger"></i>
                                                <h6 class="mb-2 fw-bold text-danger">Surat Ditolak</h6>
                                                <div class="mb-3 alert alert-danger">
                                                    <div class="mb-2 d-flex align-items-center">
                                                        <i class="fas fa-user-times me-2"></i>
                                                        <div class="text-start">
                                                            <small class="d-block">Ditolak oleh:</small>
                                                            <strong>{{ $letter->approver->name ?? 'N/A' }}</strong>
                                                            <small class="d-block text-muted">
                                                                {{ $letter->approved_at->format('d M Y H:i') }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($letter->rejection_reason)
                                                <div class="p-3 border-4 rounded bg-light border-start border-danger">
                                                    <small class="mb-1 text-muted d-block">Alasan Penolakan:</small>
                                                    <div class="fw-semibold text-dark">{{ $letter->rejection_reason }}</div>
                                                </div>
                                                @endif
                                            @elseif($letter->status === 'waiting_template')
                                                <i class="mb-3 fas fa-hourglass-half fa-2x text-info"></i>
                                                <h6 class="mb-2 fw-bold text-info">Menunggu Template</h6>
                                                <p class="mb-0 text-muted small">Surat custom sedang diproses oleh Tendik</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rejection Modal -->
            <div wire:ignore.self class="modal fade modal-modern" id="rejectModal" tabindex="-1" 
                 aria-labelledby="rejectModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="text-white border-0 modal-header bg-danger">
                            <h5 class="modal-title fw-bold" id="rejectModalLabel">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Tolak Surat
                            </h5>
                            <button type="button" class="btn-close btn-close-white" 
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="p-4 modal-body">
                            <div class="mb-4 text-center">
                                <i class="mb-3 fas fa-ban fa-3x text-danger"></i>
                                <h6 class="fw-bold">Anda yakin ingin menolak surat ini?</h6>
                                <p class="text-muted small">Tindakan ini tidak dapat dibatalkan</p>
                            </div>
                            
                            <div class="mb-3">
                                <label for="rejectionReason" class="form-label fw-bold">
                                    <i class="fas fa-comment-alt me-1"></i>
                                    Alasan Penolakan <span class="text-danger">*</span>
                                </label>
                                <textarea wire:model.defer="rejectionReason" 
                                          class="form-control @error('rejectionReason') is-invalid @enderror"
                                          id="rejectionReason" 
                                          rows="4" 
                                          placeholder="Jelaskan alasan penolakan surat ini..."
                                          style="resize: none;"></textarea>
                                @error('rejectionReason')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Alasan ini akan dikirimkan kepada pengaju surat
                                </div>
                            </div>
                        </div>
                        <div class="border-0 modal-footer">
                            <button type="button" class="btn btn-light action-button" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i>
                                Batal
                            </button>
                            <button wire:click="rejectLetter" class="btn btn-danger action-button" 
                                    data-bs-dismiss="modal">
                                <i class="fas fa-ban me-1"></i>
                                Tolak Surat
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Approval Modal with Signature Animation -->
            <div wire:ignore.self class="modal fade modal-modern" id="approveModal" tabindex="-1" 
                 aria-labelledby="approveModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="text-white border-0 modal-header bg-success">
                            <h5 class="modal-title fw-bold" id="approveModalLabel">
                                <i class="fas fa-check-circle me-2"></i>
                                Setujui Surat
                            </h5>
                            <button type="button" class="btn-close btn-close-white" 
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="p-4 modal-body">
                            <!-- Confirmation Phase -->
                            <div id="confirmationPhase">
                                <div class="mb-4 text-center">
                                    <i class="mb-3 fas fa-file-signature fa-3x text-success"></i>
                                    <h6 class="fw-bold">Konfirmasi Persetujuan Surat</h6>
                                    <p class="text-muted small">Surat akan ditandatangani secara digital</p>
                                </div>
                                
                                <div class="p-3 mb-3 border-4 rounded bg-light border-start border-success">
                                    <small class="mb-1 text-muted d-block">Judul Surat:</small>
                                    <div class="fw-bold">{{ $letter->template->name ?? 'Surat Custom' }}</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="approvalNotes" class="form-label fw-bold">
                                        <i class="fas fa-sticky-note me-1"></i>
                                        Catatan Persetujuan (Opsional)
                                    </label>
                                    <textarea wire:model.defer="approvalNotes" 
                                              class="form-control"
                                              id="approvalNotes" 
                                              rows="3" 
                                              placeholder="Tambahkan catatan persetujuan jika diperlukan..."
                                              style="resize: none;"></textarea>
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Catatan ini akan disertakan dalam surat yang disetujui
                                    </div>
                                </div>
                            </div>

                            <!-- Processing Phase (Hidden initially) -->
                            <div id="processingPhase" style="display: none;">
                                <div class="text-center">
                                    <div class="mb-4 signature-container">
                                        <div class="signature-animation">
                                            <i class="fas fa-signature fa-4x text-success signature-icon"></i>
                                            <div class="signature-line"></div>
                                        </div>
                                    </div>
                                    
                                    <h6 class="fw-bold text-success">Menandatangani Surat...</h6>
                                    <p class="mb-3 text-muted small">Sedang memproses tanda tangan digital</p>
                                    
                                    <div class="mb-3 progress" style="height: 6px;">
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                                             id="signatureProgress" style="width: 0%"></div>
                                    </div>
                                    
                                    <div id="processSteps">
                                        <div class="mb-2 process-step" data-step="1">
                                            <i class="fas fa-circle-notch fa-spin text-primary me-2"></i>
                                            <span>Memvalidasi dokumen...</span>
                                        </div>
                                        <div class="mb-2 process-step" data-step="2" style="display: none;">
                                            <i class="fas fa-circle-notch fa-spin text-primary me-2"></i>
                                            <span>Menerapkan tanda tangan digital...</span>
                                        </div>
                                        <div class="mb-2 process-step" data-step="3" style="display: none;">
                                            <i class="fas fa-circle-notch fa-spin text-primary me-2"></i>
                                            <span>Mengirim notifikasi...</span>
                                        </div>
                                        <div class="mb-2 process-step" data-step="4" style="display: none;">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            <span>Surat berhasil disetujui!</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-0 modal-footer" id="modalFooter">
                            <button type="button" class="btn btn-light action-button" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i>
                                Batal
                            </button>
                            <button id="confirmApprovalBtn" class="btn btn-success action-button">
                                <i class="fas fa-signature me-1"></i>
                                Tanda Tangani & Setujui
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Test QR Code Modal -->
    <!-- Test QR Code Modal -->
    <div class="modal fade" id="testQrModal" tabindex="-1" aria-labelledby="testQrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testQrModalLabel">Test Functions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>QR Code Test</h6>
                            <button wire:click="testQrCode" class="mb-3 btn btn-primary">
                                <i class="mdi mdi-qrcode"></i> Generate Test QR Code
                            </button>
                            
                            <div class="mb-3 form-group">
                                <label>Test Data:</label>
                                <input type="text" wire:model="testQrData" class="form-control" 
                                       placeholder="Enter test data for QR code" value="TEST-QR-CODE-{{ now() }}">
                            </div>

                            <hr>

                            <h6>Telegram Test</h6>
                            <button wire:click="testTelegramDocumentSend" class="mb-2 btn btn-success">
                                <i class="mdi mdi-telegram"></i> Test Send Document to Telegram
                            </button>
                            <p class="small text-muted">Test pengiriman dokumen surat ke Telegram Bot</p>

                            <button wire:click="testPdfConversionWithFallback" class="mb-2 btn btn-warning">
                                <i class="mdi mdi-file-pdf-box"></i> Test PDF Conversion
                            </button>
                            <p class="small text-muted">Test konversi DOCX ke PDF dengan fallback</p>

                            <button wire:click="testUploadWithFallback" class="mb-2 btn btn-info">
                                <i class="mdi mdi-cloud-upload"></i> Test Upload to Google Drive
                            </button>
                            <p class="small text-muted">Test upload file ke Google Drive</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Test Results</h6>
                            @if(session()->has('qr_test_result'))
                                <div class="alert alert-info">
                                    <pre style="white-space: pre-wrap; font-size: 12px;">{{ session('qr_test_result') }}</pre>
                                </div>
                            @endif

                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    <i class="mdi mdi-check-circle me-1"></i>
                                    {{ session('message') }}
                                </div>
                            @endif

                            @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    <i class="mdi mdi-alert-circle me-1"></i>
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Debug Button (Only for Dekan) -->
@if(auth()->user()->isDekan())
<div class="position-fixed" style="bottom: 20px; right: 20px; z-index: 1000;">
    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#testQrModal">
        <i class="fas fa-bug"></i> Test QR
    </button>
</div>
@endif
</div>



@push('scripts')
    {{-- Livewire script sudah diload di layout --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const approveModal = document.getElementById('approveModal');
            const confirmBtn = document.getElementById('confirmApprovalBtn');
            const confirmationPhase = document.getElementById('confirmationPhase');
            const processingPhase = document.getElementById('processingPhase');
            const modalFooter = document.getElementById('modalFooter');
            const progressBar = document.getElementById('signatureProgress');
            
            // Reset modal when it's opened (only if not currently processing)
            approveModal.addEventListener('show.bs.modal', function() {
                if (!isProcessing) {
                    confirmationPhase.style.display = 'block';
                    processingPhase.style.display = 'none';
                    modalFooter.style.display = 'flex';
                    progressBar.style.width = '0%';
                    
                    // Reset all process steps
                    const steps = document.querySelectorAll('.process-step');
                    steps.forEach((step, index) => {
                        if (index === 0) {
                            step.style.display = 'flex';
                        } else {
                            step.style.display = 'none';
                        }
                        step.classList.remove('completed');
                    });
                }
            });
            
            // Only reset modal when hidden if not processing
            approveModal.addEventListener('hidden.bs.modal', function() {
                if (!isProcessing) {
                    resetApprovalModal();
                }
            });
            
            // Handle approval confirmation
            confirmBtn.addEventListener('click', function() {
                // Show processing phase
                confirmationPhase.style.display = 'none';
                processingPhase.style.display = 'block';
                modalFooter.style.display = 'none';
                
                // Disable modal closing during processing
                approveModal.setAttribute('data-bs-backdrop', 'static');
                approveModal.setAttribute('data-bs-keyboard', 'false');
                
                // Hide close button
                const closeBtn = approveModal.querySelector('.btn-close');
                if (closeBtn) closeBtn.style.display = 'none';
                
                // Start the continuous signing animation
                startContinuousSigningProcess();
                
                // Execute the actual approval process
                @this.call('approveLetter').then(() => {
                    // Keep animation running - the redirect will happen automatically
                    console.log('Approval process completed, waiting for redirect...');
                }).catch((error) => {
                    console.error('Approval failed:', error);
                    // Re-enable modal closing on error
                    approveModal.removeAttribute('data-bs-backdrop');
                    approveModal.removeAttribute('data-bs-keyboard');
                    const closeBtn = approveModal.querySelector('.btn-close');
                    if (closeBtn) closeBtn.style.display = 'block';
                    // Reset modal on error
                    resetApprovalModal();
                });
            });
            
            let animationInterval = null;
            let isProcessing = false;
            
            function startContinuousSigningProcess() {
                if (isProcessing) return;
                
                isProcessing = true;
                const steps = [
                    { progress: 25, text: 'Memvalidasi dokumen...' },
                    { progress: 50, text: 'Menerapkan tanda tangan digital...' },
                    { progress: 75, text: 'Mengirim notifikasi...' },
                    { progress: 90, text: 'Menyimpan persetujuan...' }
                ];
                
                let currentStep = 0;
                let cycleCount = 0;
                
                function executeContinuousStep() {
                    if (!isProcessing) {
                        clearInterval(animationInterval);
                        return;
                    }
                    
                    // Mark previous step as completed if not first iteration
                    if (currentStep > 0) {
                        const prevStep = document.querySelector(`[data-step="${currentStep}"]`);
                        if (prevStep) {
                            prevStep.classList.add('completed');
                            const icon = prevStep.querySelector('i');
                            icon.className = 'fas fa-check-circle text-success me-2';
                        }
                    }
                    
                    if (currentStep < steps.length) {
                        const step = steps[currentStep];
                        const stepElement = document.querySelector(`[data-step="${currentStep + 1}"]`);
                        
                        if (stepElement) {
                            stepElement.style.display = 'flex';
                            stepElement.classList.remove('completed');
                            const icon = stepElement.querySelector('i');
                            icon.className = 'fas fa-circle-notch fa-spin text-primary me-2';
                        }
                        
                        // Animate progress bar with slight randomness to make it feel more alive
                        const randomOffset = Math.random() * 5;
                        const targetProgress = Math.min(step.progress + randomOffset, 95);
                        setTimeout(() => {
                            progressBar.style.width = targetProgress + '%';
                        }, 200);
                        
                        currentStep++;
                    } else {
                        // Reset cycle but keep animating
                        cycleCount++;
                        currentStep = 0;
                        
                        // Reset all steps to initial state for next cycle
                        const allSteps = document.querySelectorAll('.process-step');
                        allSteps.forEach((step, index) => {
                            if (index === 0) {
                                step.style.display = 'flex';
                                step.classList.remove('completed');
                                const icon = step.querySelector('i');
                                icon.className = 'fas fa-circle-notch fa-spin text-primary me-2';
                            } else {
                                step.style.display = 'none';
                                step.classList.remove('completed');
                            }
                        });
                        
                        // Reset progress with slight variation
                        progressBar.style.width = '15%';
                    }
                }
                
                // Start continuous animation
                animationInterval = setInterval(executeContinuousStep, 1800); // Each step takes 1.8 seconds
                executeContinuousStep(); // Execute first step immediately
            }
            
            function resetApprovalModal() {
                isProcessing = false;
                if (animationInterval) {
                    clearInterval(animationInterval);
                    animationInterval = null;
                }
                
                // Re-enable modal closing
                approveModal.removeAttribute('data-bs-backdrop');
                approveModal.removeAttribute('data-bs-keyboard');
                const closeBtn = approveModal.querySelector('.btn-close');
                if (closeBtn) closeBtn.style.display = 'block';
                
                // Reset UI to initial state
                confirmationPhase.style.display = 'block';
                processingPhase.style.display = 'none';
                modalFooter.style.display = 'flex';
                progressBar.style.width = '0%';
                
                // Reset all process steps
                const steps = document.querySelectorAll('.process-step');
                steps.forEach((step, index) => {
                    if (index === 0) {
                        step.style.display = 'flex';
                    } else {
                        step.style.display = 'none';
                    }
                    step.classList.remove('completed');
                    const icon = step.querySelector('i');
                    icon.className = 'fas fa-circle-notch fa-spin text-primary me-2';
                });
            }
            
            // Clean up when page is about to unload (during redirect)
            window.addEventListener('beforeunload', function() {
                isProcessing = false;
                if (animationInterval) {
                    clearInterval(animationInterval);
                }
            });
            
            // Add success sound effect (optional)
            function playSuccessSound() {
                // Create a simple success beep
                const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();
                
                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);
                
                oscillator.frequency.value = 800;
                oscillator.type = 'sine';
                
                gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);
                
                oscillator.start(audioContext.currentTime);
                oscillator.stop(audioContext.currentTime + 0.5);
            }
        });
    </script>
@endpush
