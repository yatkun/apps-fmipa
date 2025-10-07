<div>
    @push('styles')
        <style>
            .period-card {
                transition: all 0.3s ease;
            }

            .period-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            .active-period {
                border-left: 4px solid #28a745;
                background-color: #f8fff9;
            }

            .modal.show {
                display: block !important;
            }

            .modal-backdrop {
                z-index: 1040;
            }

            .modal {
                z-index: 1050;
            }
        </style>
    @endpush

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1">Manajemen Periode IKU</h4>
                                <p class="text-muted mb-0">Kelola periode tahun untuk data IKU</p>
                            </div>
                            <button wire:click="openModal" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i> Tambah Periode
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Flash Messages -->
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bx bx-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bx bx-error-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Active Period Info -->
                @if ($activePeriod)
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i class="bx bx-info-circle fs-4 me-2"></i>
                                <div>
                                    <strong>Periode Aktif:</strong> {{ $activePeriod->name }}
                                    ({{ $activePeriod->year_start }} - {{ $activePeriod->year_end }})
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <i class="bx bx-error-circle fs-4 me-2"></i>
                                <div>
                                    <strong>Peringatan:</strong> Tidak ada periode aktif. Silakan aktifkan salah satu
                                    periode.
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Periods List -->
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                @if ($periods->count() > 0)
                                    <div class="row g-3">
                                        @foreach ($periods as $period)
                                            <div class="col-md-6 col-lg-4">
                                                <div
                                                    class="card period-card h-100 {{ $period->is_active ? 'active-period' : '' }}">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                                            <div>
                                                                <h5 class="card-title mb-1">{{ $period->name }}</h5>
                                                                <p class="text-muted mb-0 small">
                                                                    {{ $period->year_start }} - {{ $period->year_end }}
                                                                </p>
                                                            </div>
                                                            @if ($period->is_active)
                                                                <span class="badge bg-success">Aktif</span>
                                                            @endif
                                                        </div>

                                                        @if ($period->description)
                                                            <p class="card-text small text-muted">
                                                                {{ $period->description }}
                                                            </p>
                                                        @endif

                                                        <div class="mt-3 d-flex gap-2">
                                                            @if (!$period->is_active)
                                                                <button wire:click="setActive({{ $period->id }})"
                                                                    class="btn btn-sm btn-success">
                                                                    <i class="bx bx-check"></i> Aktifkan
                                                                </button>
                                                            @endif
                                                            <button wire:click="edit({{ $period->id }})"
                                                                class="btn btn-sm btn-primary">
                                                                <i class="bx bx-edit"></i> Edit
                                                            </button>
                                                            @if (!$period->is_active)
                                                                <button wire:click="delete({{ $period->id }})"
                                                                    wire:confirm="Apakah Anda yakin ingin menghapus periode ini?"
                                                                    class="btn btn-sm btn-danger">
                                                                    <i class="bx bx-trash"></i> Hapus
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Pagination -->
                                    <div class="mt-4">
                                        {{ $periods->links() }}
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="bx bx-calendar-x display-4 text-muted"></i>
                                        <p class="text-muted mt-3">Belum ada periode. Silakan tambah periode baru.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add/Edit Period -->
    @if ($showModal)
        <div class="modal show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $editingId ? 'Edit Periode' : 'Tambah Periode Baru' }}
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <form wire:submit.prevent="save">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Periode <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" wire:model="name" placeholder="Contoh: 2024/2025">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="year_start" class="form-label">Tahun Mulai <span
                                            class="text-danger">*</span></label>
                                    <input type="number"
                                        class="form-control @error('year_start') is-invalid @enderror" id="year_start"
                                        wire:model="year_start" placeholder="2024" min="2020" max="2100">
                                    @error('year_start')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="year_end" class="form-label">Tahun Selesai <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('year_end') is-invalid @enderror"
                                        id="year_end" wire:model="year_end" placeholder="2025" min="2020"
                                        max="2100">
                                    @error('year_end')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model="description"
                                    rows="3" placeholder="Deskripsi periode (opsional)"></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                <span wire:loading.remove>
                                    <i class="bx bx-save me-1"></i> Simpan
                                </span>
                                <span wire:loading>
                                    <i class="bx bx-loader-alt bx-spin me-1"></i> Menyimpan...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', function() {
                Livewire.on('period-saved', () => {
                    // Optional: Add notification or animation
                });

                Livewire.on('period-activated', () => {
                    // Refresh page to update period-related data
                    setTimeout(() => window.location.reload(), 1000);
                });
            });
        </script>
    @endpush
</div>
