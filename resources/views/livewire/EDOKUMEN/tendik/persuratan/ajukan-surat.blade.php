                              
@push('styles')
<style>
.section-title {
    color: #2d3748;
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.section-title i {
    color: #6366f1;
}

.fade-in {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .d-flex.gap-2 {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>
@endpush

@section('title', 'Ajukan Surat Baru')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                         <h4 class="mb-sm-0 font-size-18">Ajukan Surat Baru</h4>
                    </div>
                    
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <!-- Main Form Card -->
                    <div class="shadow card fade-in">
                        <!-- Card Header -->
                        <div class="text-white card-header bg-secondary">
                            <div class="d-flex align-items-center">
                               
                                <div>
                                    <span class="fs-5">Form Pengajuan Surat</span>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="p-4 card-body">
                            <!-- Alert Messages -->
                            @if (session('success'))
                                <div class="alert alert-success fade-in">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <strong>Berhasil!</strong> {{ session('success') }}
                                </div>
                            @endif
                            
                            @if (session('error'))
                                <div class="alert alert-danger fade-in">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Error!</strong> {{ session('error') }}
                                </div>
                            @endif

                            <!-- Template Selection Section -->
                            <div class="mb-4 card fade-in">
                                <div class="card-body">
                                    <h5 class="section-title">
                                        <i class="fas fa-file-alt"></i>
                                        Pilih Template Surat
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <select class="form-select" wire:model="templateId">
                                                <option value="">🔍 Pilih Template Surat</option>
                                                @foreach ($templates as $template)
                                                    <option value="{{ $template->id }}">📄 {{ $template->name }}</option>
                                                @endforeach
                                                <option value="custom">✨ Custom Surat</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" 
                                                    class="btn btn-primary w-100" 
                                                    wire:click="pilihTemplate">
                                                <i class="fas fa-check me-2"></i>
                                                Pilih Template
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Content Sections -->
                            @if ($templateSelected)
                                @if ($templateId === 'custom')
                                <!-- Custom Letter Section -->
                                <div class="mb-4 card fade-in">
                                    <div class="card-body">
                                        <h5 class="section-title">
                                            <i class="fas fa-edit"></i>
                                            Informasi Surat Custom
                                        </h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">
                                                        <i class="fas fa-heading me-1"></i>
                                                        Judul Surat Custom
                                                    </label>
                                                    <input type="text" 
                                                           class="form-control" 
                                                           wire:model.defer="customTitle" 
                                                           placeholder="Masukkan judul surat yang jelas dan spesifik">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">
                                                        <i class="fas fa-file-text me-1"></i>
                                                        Isi Surat Custom
                                                    </label>
                                                    <textarea class="form-control" 
                                                              wire:model.defer="customContent" 
                                                              rows="6" 
                                                              placeholder="Masukkan isi surat dengan detail yang lengkap..."></textarea>
                                                    <div class="form-text">
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        Jelaskan kebutuhan surat Anda dengan detail agar mudah diproses
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif ($templateId && $templateId !== 'custom')
                                    @php
                                        $selectedTemplate = $templates->firstWhere('id', $templateId);
                                        $placeholders = [];
                                        $placeholderHints = [];
                                        
                                        if ($selectedTemplate && !empty($selectedTemplate->placeholders)) {
                                            if (is_array($selectedTemplate->placeholders)) {
                                                $placeholders = $selectedTemplate->placeholders;
                                            } else {
                                                $placeholders = json_decode($selectedTemplate->placeholders, true) ?? [];
                                            }
                                        }
                                        
                                        // Get placeholder hints if available
                                        if ($selectedTemplate && !empty($selectedTemplate->placeholder_hints)) {
                                            if (is_array($selectedTemplate->placeholder_hints)) {
                                                $placeholderHints = $selectedTemplate->placeholder_hints;
                                            } else {
                                                $placeholderHints = json_decode($selectedTemplate->placeholder_hints, true) ?? [];
                                            }
                                        }
                                    @endphp
                                    @if (!empty($placeholders))
                                        <!-- Template Placeholders Section -->
                                        <div class="mb-4 card fade-in">
                                            <div class="card-body">
                                                <h5 class="section-title">
                                                    <i class="fas fa-form"></i>
                                                    Isi Data Template
                                                </h5>
                                                <div class="row">
                                                    @foreach ($placeholders as $index => $ph)
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label fw-semibold">
                                                                <i class="fas fa-edit me-1"></i>
                                                                {{ ucfirst(str_replace('_', ' ', $ph)) }}
                                                            </label>
                                                            @php
                                                                // Use placeholder hint if available, otherwise use default
                                                                $placeholderText = isset($placeholderHints[$ph]) 
                                                                    ? $placeholderHints[$ph] 
                                                                    : 'Masukkan ' . strtolower(str_replace('_', ' ', $ph));
                                                            @endphp
                                                            <input type="text" 
                                                                   class="form-control" 
                                                                   wire:model="formData.{{ $ph }}" 
                                                                   placeholder="{{ $placeholderText }}">
                                                            @if(isset($placeholderHints[$ph]))
                                                                <div class="form-text">
                                                                    <i class="fas fa-info-circle me-1"></i>
                                                                    {{ $placeholderHints[$ph] }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Dynamic Table Section -->
                                    @if ($selectedTemplate && $selectedTemplate->dynamic_table_marker && !empty($selectedTemplate->table_placeholders))
                                        <div class="mb-4 card fade-in">
                                            <div class="card-body">
                                                <h5 class="section-title">
                                                    <i class="fas fa-table"></i>
                                                    Data Tabel Dinamis
                                                </h5>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead class="table-primary">
                                                            <tr>
                                                                @foreach ($selectedTemplate->table_placeholders as $ph)
                                                                    <th>{{ ucfirst(str_replace('_', ' ', $ph)) }}</th>
                                                                @endforeach
                                                                <th width="120">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($tableData as $idx => $row)
                                                                @if (is_array($row) && count(array_intersect(array_keys($row), $selectedTemplate->table_placeholders)) > 0)
                                                                    <tr>
                                                                        @foreach ($selectedTemplate->table_placeholders as $ph)
                                                                            <td>
                                                                                <input type="text" 
                                                                                       class="form-control" 
                                                                                       wire:model="tableData.{{ $idx }}.{{ $ph }}" 
                                                                                       placeholder="{{ strtolower(str_replace('_', ' ', $ph)) }}">
                                                                            </td>
                                                                        @endforeach
                                                                        <td>
                                                                            <button type="button" 
                                                                                    class="btn btn-outline-danger btn-sm" 
                                                                                    wire:click="removeTableRow({{ $idx }})">
                                                                                <i class="fas fa-trash"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @empty
                                                                <tr>
                                                                    <td colspan="{{ count($selectedTemplate->table_placeholders) + 1 }}" 
                                                                        class="py-4 text-center text-muted">
                                                                        <i class="mb-2 fas fa-inbox fa-2x d-block"></i>
                                                                        Belum ada data. Klik "Tambah Baris" untuk menambah data.
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button type="button" 
                                                        class="btn btn-secondary" 
                                                        wire:click="addTableRow">
                                                    <i class="fas fa-plus me-2"></i>
                                                    Tambah Baris
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                <!-- Additional Notes Section -->
                                <div class="mb-4 card fade-in">
                                    <div class="card-body">
                                        <h5 class="section-title">
                                            <i class="fas fa-sticky-note"></i>
                                            Catatan Tambahan
                                        </h5>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="fas fa-comment me-1"></i>
                                                Catatan Pengajuan (opsional)
                                            </label>
                                            <textarea class="form-control" 
                                                      wire:model.defer="catatan" 
                                                      rows="4" 
                                                      placeholder="Tambahkan catatan atau informasi tambahan yang diperlukan..."></textarea>
                                            <div class="form-text">
                                                <i class="fas fa-lightbulb me-1"></i>
                                                Catatan ini akan membantu reviewer memahami konteks pengajuan Anda
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Section -->
                                <div class="mb-4 card fade-in">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1 fw-bold text-dark">Siap untuk diajukan?</h6>
                                                <small class="text-muted">Pastikan semua data sudah benar sebelum mengajukan</small>
                                            </div>
                                            <div class="gap-2 d-flex">
                                                <a href="{{ route('dosen.persuratan.list-pending-letters') }}" 
                                                   class="btn btn-outline-secondary">
                                                    <i class="fas fa-times me-2"></i>
                                                    Batal
                                                </a>
                                                <button wire:click="submit" 
                                                        wire:loading.attr="disabled" 
                                                        wire:target="submit" 
                                                        class="btn btn-success">
                                                    <span wire:loading.remove wire:target="submit">
                                                        <i class="fas fa-paper-plane me-2"></i>
                                                        Ajukan Surat
                                                    </span>
                                                    <span wire:loading wire:target="submit">
                                                        <div class="spinner-border spinner-border-sm me-2" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        Memproses...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Simple fade-in animation
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        document.querySelectorAll('.fade-in').forEach(section => {
            observer.observe(section);
        });
    });
</script>
@endpush
