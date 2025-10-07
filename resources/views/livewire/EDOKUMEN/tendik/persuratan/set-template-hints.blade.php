@push('styles')
@endpush

@section('title', 'Dokumen Pribadi')

<div class="main-content">
    @if (session('success'))
        @include('livewire.includes.alert-success', [
            'header' => 'Sukses',
        ])
    @endif
    <div class="page-content">
        <div class="container-fluid">

            <div>
                <h2 class="mb-4">Atur Petunjuk & Permission untuk Template: {{ $template->name }}</h2>

                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="alert alert-info" role="alert">
                    <h6><i class="fas fa-info-circle me-2"></i>Pengaturan Placeholder</h6>
                    <p class="mb-2"><strong>Petunjuk:</strong> Membantu pengguna memahami apa yang harus diisi pada setiap field</p>
                    <p class="mb-0"><strong>Permission:</strong> Mengatur siapa yang bisa mengisi placeholder untuk kontrol alur kerja</p>
                    <ul class="mb-0 mt-2">
                        <li><span class="badge bg-primary">Dosen</span> - Placeholder yang bisa diisi oleh dosen saat mengajukan surat (data akademik, personal)</li>
                        <li><span class="badge bg-warning">Tendik</span> - Placeholder yang hanya bisa diisi oleh Tendik saat verifikasi (nomor surat, data administrasi)</li>
                        <li><span class="badge bg-success">Sistem</span> - Placeholder yang dikelola otomatis oleh sistem (QR code, tanda tangan digital)</li>
                    </ul>
                    <div class="mt-2 alert alert-warning alert-sm">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        <strong>Penting:</strong> Perubahan permission akan berlaku untuk pengajuan surat baru. Surat yang sudah diajukan tidak terpengaruh.
                    </div>
                    <div class="mt-2 alert alert-success alert-sm">
                        <i class="fas fa-robot me-1"></i>
                        <strong>Info:</strong> Placeholder sistem seperti <code>${qr_code}</code>, <code>${ttd}</code>, dan <code>${tanda_tangan_dekan}</code> tidak ditampilkan di sini karena dikelola otomatis oleh sistem.
                    </div>
                </div>

                <form wire:submit.prevent="saveHints">
                    <div class="row">
                        @forelse ($placeholderHints as $placeholder => $hint)
                            <div class="mb-4 col-lg-6">
                                <div class="border card">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">
                                            <i class="fas fa-tag me-1"></i>
                                            <code>${{ $placeholder }}</code>
                                            @if(isset($placeholderPermissions[$placeholder]))
                                                @if($placeholderPermissions[$placeholder] === 'tendik')
                                                    <span class="badge bg-warning ms-2">Tendik Only</span>
                                                @else
                                                    <span class="badge bg-primary ms-2">Dosen</span>
                                                @endif
                                            @endif
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <!-- Petunjuk Placeholder -->
                                        <div class="mb-3">
                                            <label for="hint-{{ $placeholder }}" class="form-label">
                                                <i class="fas fa-lightbulb text-warning me-1"></i>
                                                Petunjuk untuk Pengguna
                                            </label>
                                            <input type="text"
                                                class="form-control @error('placeholderHints.' . $placeholder) is-invalid @enderror"
                                                id="hint-{{ $placeholder }}"
                                                wire:model.defer="placeholderHints.{{ $placeholder }}"
                                                placeholder="Contoh: Nama lengkap atau Tanggal lahir">
                                            @error('placeholderHints.' . $placeholder)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Permission Placeholder -->
                                        <div class="mb-0">
                                            <label class="form-label">
                                                <i class="fas fa-user-shield text-info me-1"></i>
                                                Siapa yang Bisa Mengisi?
                                            </label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" 
                                                               wire:model.defer="placeholderPermissions.{{ $placeholder }}" 
                                                               value="dosen" 
                                                               id="perm-dosen-{{ $placeholder }}">
                                                        <label class="form-check-label" for="perm-dosen-{{ $placeholder }}">
                                                            <span class="badge bg-primary">Dosen</span>
                                                            <small class="d-block text-muted">Diisi saat mengajukan surat</small>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" 
                                                               wire:model.defer="placeholderPermissions.{{ $placeholder }}" 
                                                               value="tendik" 
                                                               id="perm-tendik-{{ $placeholder }}">
                                                        <label class="form-check-label" for="perm-tendik-{{ $placeholder }}">
                                                            <span class="badge bg-warning">Tendik</span>
                                                            <small class="d-block text-muted">Diisi saat verifikasi</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('placeholderPermissions.' . $placeholder)
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center alert alert-info">
                                    <i class="fas fa-info-circle fa-2x mb-2"></i>
                                    <p class="mb-0">Tidak ada placeholder yang terdeteksi untuk template ini.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    @if(count($placeholderHints) > 0)
                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save me-2"></i>
                                Simpan Pengaturan
                            </button>
                            <a href="{{ route('admin.templates') }}" class="btn btn-secondary btn-lg ms-2">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali ke Daftar Template
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>



</div>


<!-- Script untuk Handle Notifikasi dan Loading -->


@push('scripts')
    {{-- Livewire script sudah diload di layout --}}
@endpush
