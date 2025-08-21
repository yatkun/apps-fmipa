




@section('title', 'Detail Dokumen - ' . ($letter->title ?? 'Surat'))

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .header-gradient {
        background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
    }
    
    .status-pulse {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .card-hover {
        transition: all 0.3s ease;
    }
    
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    
    .detail-border-primary { border-left: 4px solid var(--bs-primary); }
    .detail-border-success { border-left: 4px solid var(--bs-success); }
    .detail-border-warning { border-left: 4px solid var(--bs-warning); }
    .detail-border-danger { border-left: 4px solid var(--bs-danger); }
</style>
@endpush


<div class="py-5 min-vh-100">
    <div class="container">
        <!-- Header Section -->
        <div class="">
            <div class="text-center">
                
                <h1 class="mb-3 h2">📄 Detail Dokumen Elektronik</h1>
                <p class="mb-0 opacity-75">
                    Dokumen ini telah diverifikasi dan ditandatangani secara elektronik
                </p>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session()->has('message'))
            <div class="shadow-sm alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Berhasil!</strong> {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="shadow-sm alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
               

                

                <!-- Approval Details -->
                @if($letter->status === 'approved' || $letter->status === 'rejected')
                    <div class="mb-4 border-0 shadow card card-hover">
                        <div class="p-4 card-body">
                            <h3 class="mb-3 card-title h5 fw-bold text-dark">
                                <i class="fas fa-signature me-2 text-primary"></i>
                                Detail Persetujuan
                            </h3>

                            <div class="border rounded-3 p-3 mb-3 bg-light {{ $letter->status === 'approved' ? 'detail-border-success' : 'detail-border-danger' }}">
                                <small class="mb-1 text-muted fw-semibold text-uppercase d-block">
                                    <i class="fas fa-user-tie me-1"></i>
                                    Ditandatangani oleh
                                </small>
                                <div class="fw-medium text-dark">
                                    {{ $letter->approver->name ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="border rounded-3 p-3 mb-3 bg-light {{ $letter->status === 'approved' ? 'detail-border-success' : 'detail-border-danger' }}">
                                <small class="mb-1 text-muted fw-semibold text-uppercase d-block">
                                    <i class="fas fa-clock me-1"></i>
                                    Tanggal {{ $letter->status === 'approved' ? 'Persetujuan' : 'Penolakan' }}
                                </small>
                                <div class="fw-medium text-dark">
                                    {{ $letter->approved_at ? $letter->approved_at->format('d F Y, H:i') . ' WIB' : 'N/A' }}
                                </div>
                            </div>

                            @if($letter->status === 'rejected' && $letter->rejection_reason)
                                <div class="p-3 mb-0 border rounded-3 bg-light detail-border-danger">
                                    <small class="mb-1 text-muted fw-semibold text-uppercase d-block">
                                        <i class="fas fa-comment-alt me-1"></i>
                                        Alasan Penolakan
                                    </small>
                                    <div class="fw-medium text-dark">
                                        {{ $letter->rejection_reason }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

               

                <!-- Security Note -->
                <div class="border-0 shadow card card-hover">
                    <div class="p-4 text-center card-body">
                        <div class="mb-3">
                            <i class="fas fa-lock fa-2x text-success"></i>
                        </div>
                        <h5 class="mb-2 card-title text-success">Dokumen Terverifikasi</h5>
                        <p class="mb-0 card-text text-muted small">
                            Dokumen ini telah melalui proses verifikasi digital dan dilindungi 
                            dengan sistem keamanan tingkat tinggi. Keaslian dokumen terjamin.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth entrance animation for cards
    const cards = document.querySelectorAll('.card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });
    
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `all 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
});
</script>
@endpush
