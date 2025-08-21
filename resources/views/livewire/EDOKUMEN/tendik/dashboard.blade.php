@section('title', 'Dashboard Tendik')

<div class="main-content">
    
    <div class="page-content">
        <div class="container-fluid">
            
            @if(Auth::user()->is_dekan)
                {{-- Dashboard khusus untuk Dekan --}}
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Dashboard Dekan - Persuratan</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Dekan</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Stats Cards untuk Dekan --}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="mb-2 text-muted fw-medium">Perlu Persetujuan</p>
                                        <h4 class="mb-0 text-warning">{{ $dashboardData['pending_letters'] ?? 0 }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-warning">
                                            <span class="avatar-title">
                                                <i class="bx bx-time-five font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="mb-2 text-muted fw-medium">Telah Disetujui</p>
                                        <h4 class="mb-0 text-success">{{ $dashboardData['approved_letters'] ?? 0 }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm mini-stat-icon rounded-circle bg-success">
                                            <span class="avatar-title">
                                                <i class="bx bx-check-circle font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="mb-2 text-muted fw-medium">Ditolak</p>
                                        <h4 class="mb-0 text-danger">{{ $dashboardData['rejected_letters'] ?? 0 }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm mini-stat-icon rounded-circle bg-danger">
                                            <span class="avatar-title">
                                                <i class="bx bx-x-circle font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="mb-2 text-muted fw-medium">Total Surat</p>
                                        <h4 class="mb-0">{{ $dashboardData['total_letters'] ?? 0 }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                            <span class="avatar-title">
                                                <i class="bx bx-package font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Surat yang Perlu Persetujuan --}}
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-0 flex-grow-1">Surat Menunggu Persetujuan</h5>
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('list.pending.letters') }}" class="btn btn-primary btn-sm">
                                            <i class="bx bx-list-ul"></i> Lihat Semua
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(!empty($dashboardData['recent_pending_letters']) && $dashboardData['recent_pending_letters']->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-hover mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Judul Surat</th>
                                                    <th>Pengaju</th>
                                                    <th>Template</th>
                                                    <th>Tanggal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dashboardData['recent_pending_letters'] as $letter)
                                                <tr>
                                                    <td>
                                                        <h6 class="mb-1 text-truncate" style="max-width: 200px;">{{ $letter->title }}</h6>
                                                        <span class="badge badge-soft-warning">Pending</span>
                                                    </td>
                                                    <td>{{ $letter->creator->name ?? 'Unknown' }}</td>
                                                    <td>
                                                        <span class="text-muted">{{ $letter->template->name ?? 'Custom' }}</span>
                                                    </td>
                                                    <td>{{ $letter->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('approve.letter', $letter->hashed_id) }}" 
                                                           class="btn btn-outline-primary btn-sm">
                                                            <i class="bx bx-detail"></i> Review
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <div class="avatar-md mx-auto mb-4">
                                            <div class="avatar-title bg-light rounded-circle text-primary h1">
                                                <i class="bx bx-check-circle"></i>
                                            </div>
                                        </div>
                                        <h5>Tidak Ada Surat Pending</h5>
                                        <p class="text-muted">Semua surat sudah diproses.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Aksi Cepat</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('list.pending.letters') }}" class="btn btn-warning">
                                        <i class="bx bx-time-five me-1"></i>
                                        Lihat Surat Pending ({{ $dashboardData['pending_letters'] ?? 0 }})
                                    </a>
                                    <a href="{{ route('list.approved.letters') }}" class="btn btn-success">
                                        <i class="bx bx-check-circle me-1"></i>
                                        Surat Disetujui ({{ $dashboardData['approved_letters'] ?? 0 }})
                                    </a>
                                    <a href="{{ route('list.surat.tolak') }}" class="btn btn-danger">
                                        <i class="bx bx-x-circle me-1"></i>
                                        Surat Ditolak ({{ $dashboardData['rejected_letters'] ?? 0 }})
                                    </a>
                                    <hr>
                                    <a href="{{ route('dosen.persuratan.ajukan-surat') }}" class="btn btn-primary">
                                        <i class="bx bx-plus-circle me-1"></i>
                                        Ajukan Surat Baru
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                {{-- Dashboard untuk Tendik biasa --}}
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Dashboard Tendik</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="mb-2 text-muted fw-medium">Total Surat</p>
                                        <h4 class="mb-0">{{ $dashboardData['total_letters'] ?? 0 }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                            <span class="avatar-title">
                                                <i class="bx bx-file font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="mb-2 text-muted fw-medium">Menunggu Template</p>
                                        <h4 class="mb-0 text-warning">{{ $dashboardData['waiting_template_letters'] ?? 0 }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm mini-stat-icon rounded-circle bg-warning">
                                            <span class="avatar-title">
                                                <i class="bx bx-hourglass font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>


@push('scripts')

    <script src="{{ asset('assets/js/livewire.js') }}" data-navigate-track></script>



    
@endpush
