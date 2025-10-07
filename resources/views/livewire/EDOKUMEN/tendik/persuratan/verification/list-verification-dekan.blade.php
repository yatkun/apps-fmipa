<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Header Section -->
            <div class="mb-4 row">
                <div class="col-12">
                    <div class="border-0 shadow-sm card">
                        <div class="text-white card-header bg-success">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-user-tie me-2"></i>
                                    Persetujuan Surat oleh Dekan
                                </h5>
                                <div class="gap-2 d-flex">
                                    <div class="input-group" style="width: 300px;">
                                        <input type="text" wire:model.live="search"
                                            class="form-control form-control-sm" placeholder="Cari surat...">
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

            <!-- Status Cards -->
            <div class="mb-4 row">
                <div class="col-md-3">
                    <div class="text-white border-0 card bg-info">
                        <div class="text-center card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="me-3">
                                    <i class="fas fa-clock fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $verificationLetters->total() }}</h5>
                                    <small class="opacity-75">Menunggu Persetujuan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-white border-0 card bg-success">
                        <div class="text-center card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="me-3">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Dekan</h5>
                                    <small class="opacity-75">Level Persetujuan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-white border-0 card bg-warning">
                        <div class="text-center card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="me-3">
                                    <i class="fas fa-user-check fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Terverifikasi</h5>
                                    <small class="opacity-75">Oleh Tendik</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-white border-0 card bg-primary">
                        <div class="text-center card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="me-3">
                                    <i class="fas fa-stamp fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Siap TTD</h5>
                                    <small class="opacity-75">Tahap Akhir</small>
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
                                    Daftar Surat Menunggu Persetujuan Dekan
                                </h6>
                                <div class="gap-3 d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <label class="mb-0 form-label me-2 text-muted">Show:</label>
                                        <select wire:model.live="perPage" class="form-select form-select-sm"
                                            style="width: auto;">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-0 card-body">
                            @if ($verificationLetters->count() > 0)
                                <div class="table-responsive">
                                    <table class="table mb-0 align-middle table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 40px;">#</th>
                                                <th scope="col" wire:click="setSortBy('title')"
                                                    style="cursor: pointer;">
                                                    Judul Surat
                                                    @if ($sortBy === 'title')
                                                        <i
                                                            class="fas fa-sort-{{ $sortDir === 'ASC' ? 'up' : 'down' }} ms-1"></i>
                                                    @endif
                                                </th>
                                              
                                                <th scope="col" wire:click="setSortBy('creator_name')"
                                                    style="cursor: pointer;">
                                                    Pengaju
                                                    @if ($sortBy === 'creator_name')
                                                        <i
                                                            class="fas fa-sort-{{ $sortDir === 'ASC' ? 'up' : 'down' }} ms-1"></i>
                                                    @endif
                                                </th>
                                                <th scope="col">Diverifikasi Tendik</th>
                                                <th scope="col" wire:click="setSortBy('verified_at_tendik')"
                                                    style="cursor: pointer;">
                                                    Tanggal Verifikasi
                                                    @if ($sortBy === 'verified_at_tendik')
                                                        <i
                                                            class="fas fa-sort-{{ $sortDir === 'ASC' ? 'up' : 'down' }} ms-1"></i>
                                                    @endif
                                                </th>
                                                <th scope="col" class="text-center" style="width: 150px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($verificationLetters as $index => $letter)
                                                <tr>
                                                    <td class="text-muted">
                                                        {{ $verificationLetters->firstItem() + $index }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="me-2">
                                                                @if ($letter->template)
                                                                    <i class="fas fa-file-alt text-primary"></i>
                                                                @else
                                                                    <i class="fas fa-file-upload text-secondary"></i>
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <div class="fw-medium">
                                                                    {{ $letter->title ?? 'Tidak ada judul' }}
                                                                </div>
                                                                @if ($letter->template)
                                                                    <small class="text-muted">
                                                                        <i
                                                                            class="fas fa-tag me-1"></i>{{ $letter->template->name }}
                                                                    </small>
                                                                @else
                                                                    <small class="text-muted">
                                                                        <i class="fas fa-tag me-1"></i>Surat Custom
                                                                    </small>
                                                                @endif
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
                                                        @if ($letter->tendikVerifier)
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2">
                                                                    <i class="fas fa-check-circle text-success"></i>
                                                                </div>
                                                                <div>
                                                                    <div class="fw-medium text-success">
                                                                        {{ $letter->tendikVerifier->name }}</div>
                                                                    @if ($letter->tendik_notes)
                                                                        <small class="text-muted"
                                                                            title="{{ $letter->tendik_notes }}">
                                                                            <i class="fas fa-comment-alt me-1"></i>Ada
                                                                            catatan
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($letter->verified_at_tendik)
                                                            <div class="text-nowrap">
                                                                <div class="fw-medium">
                                                                    {{ $letter->verified_at_tendik->format('d M Y') }}
                                                                </div>
                                                                <small class="text-muted">
                                                                    {{ $letter->verified_at_tendik->format('H:i') }}
                                                                </small>
                                                            </div>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('approve.letter', $letter->hashed_id) }}"
                                                                class="btn btn-sm btn-success">
                                                                <i class="fas fa-stamp me-1"></i>
                                                                Setujui
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
                                            Menampilkan {{ $verificationLetters->firstItem() }} sampai
                                            {{ $verificationLetters->lastItem() }}
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
                                        <i class="fas fa-check-circle fa-3x text-muted"></i>
                                    </div>
                                    <h5 class="text-muted">Tidak ada surat yang perlu disetujui</h5>
                                    <p class="text-muted">
                                        @if ($search)
                                            Tidak ditemukan surat dengan pencarian "{{ $search }}"
                                        @else
                                            Semua surat sudah disetujui atau belum ada yang diverifikasi Tendik.
                                        @endif
                                    </p>
                                    @if ($search)
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
