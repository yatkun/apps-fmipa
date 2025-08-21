<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">


    <!-- Header Section -->
    <div class="mb-0 row">
        <div class="col-12">
            <div class="border-0 shadow-sm card">
                <div class="text-white card-header bg-primary">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-clipboard-list me-2"></i>
                            Verifikasi Surat oleh Tendik
                        </h5>
                        <div class="gap-2 d-flex">
                            <div class="input-group" style="width: 300px;">
                                <input type="text" 
                                       wire:model.live="search" 
                                       class="form-control form-control-sm" 
                                       placeholder="Cari surat...">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Letters Table -->
    <div class="row">
        <div class="col-12">
            <div class="border-0 shadow-sm card">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-dark">
                            <i class="fas fa-list me-2"></i>
                            Daftar Surat Menunggu Verifikasi
                        </h6>
                        <div class="gap-3 d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <label class="mb-0 form-label me-2 text-muted">Show:</label>
                                <select wire:model.live="perPage" class="form-select form-select-sm" style="width: auto;">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-0 card-body">
                    @if($verificationLetters->count() > 0)
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 40px;">#</th>
                                        <th scope="col" wire:click="setSortBy('title')" style="cursor: pointer;">
                                            Judul Surat
                                            @if($sortBy === 'title')
                                                <i class="fas fa-sort-{{ $sortDir === 'ASC' ? 'up' : 'down' }} ms-1"></i>
                                            @endif
                                        </th>
                                        <th scope="col" wire:click="setSortBy('template_name')" style="cursor: pointer;">
                                            Template
                                            @if($sortBy === 'template_name')
                                                <i class="fas fa-sort-{{ $sortDir === 'ASC' ? 'up' : 'down' }} ms-1"></i>
                                            @endif
                                        </th>
                                        <th scope="col" wire:click="setSortBy('creator_name')" style="cursor: pointer;">
                                            Pengaju
                                            @if($sortBy === 'creator_name')
                                                <i class="fas fa-sort-{{ $sortDir === 'ASC' ? 'up' : 'down' }} ms-1"></i>
                                            @endif
                                        </th>
                                        <th scope="col" wire:click="setSortBy('created_at')" style="cursor: pointer;">
                                            Tanggal Pengajuan
                                            @if($sortBy === 'created_at')
                                                <i class="fas fa-sort-{{ $sortDir === 'ASC' ? 'up' : 'down' }} ms-1"></i>
                                            @endif
                                        </th>
                                        <th scope="col" class="text-center" style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($verificationLetters as $index => $letter)
                                        <tr>
                                            <td class="text-muted">
                                                {{ $verificationLetters->firstItem() + $index }}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">
                                                        @if($letter->template)
                                                            <i class="fas fa-file-alt text-primary"></i>
                                                        @else
                                                            <i class="fas fa-file-upload text-secondary"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="fw-medium">
                                                            {{ $letter->title ?? 'Tidak ada judul' }}
                                                        </div>
                                                        @if(!$letter->template)
                                                            <small class="text-muted">
                                                                <i class="fas fa-tag me-1"></i>Surat Custom
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($letter->template)
                                                    <span class="badge bg-primary">
                                                        {{ $letter->template->name }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">Custom</span>
                                                @endif
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
                                                        <div class="fw-medium">{{ $letter->creator->name ?? 'Unknown' }}</div>
                                                        <small class="text-muted">{{ $letter->creator->level ?? 'N/A' }}</small>
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
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('verify.by.tendik', $letter->hashed_id) }}" 
                                                       class="btn btn-sm btn-primary">
                                                        <i class="fas fa-check me-1"></i>
                                                        Verifikasi
                                                    </a>
                                                    <a href="{{ route('letters.show', $letter->hashed_id) }}" 
                                                       class="btn btn-sm btn-outline-secondary" 
                                                       target="_blank">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Menampilkan {{ $verificationLetters->firstItem() }} sampai {{ $verificationLetters->lastItem() }} 
                                    dari {{ $verificationLetters->total() }} surat
                                </div>
                                <div>
                                    {{ $verificationLetters->links() }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="py-5 text-center">
                            <div class="mb-3">
                                <i class="fas fa-inbox fa-3x text-muted"></i>
                            </div>
                            <h5 class="text-muted">Tidak ada surat yang perlu diverifikasi</h5>
                            <p class="text-muted">
                                @if($search)
                                    Tidak ditemukan surat dengan pencarian "{{ $search }}"
                                @else
                                    Semua surat sudah diverifikasi atau belum ada pengajuan baru.
                                @endif
                            </p>
                            @if($search)
                                <button wire:click="$set('search', '')" class="btn btn-outline-primary">
                                    <i class="fas fa-times me-1"></i>
                                    Hapus Filter
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


        </div>
    </div>
</div>