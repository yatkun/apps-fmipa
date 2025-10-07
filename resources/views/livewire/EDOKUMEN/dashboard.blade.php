@push('styles')

@endpush
@section('title', 'Dashboard')

<div class="main-content">
    
    <div class="page-content">
           <x-alert-nomorwa />
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="mb-2 text-muted fw-medium">Dokumen Pribadi</p>
                                    <h4 class="mb-0">{{ $a }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-check-circle font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="mb-2 text-muted fw-medium">Dokumen Publik</p>
                                    <h4 class="mb-0">{{ $b }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-hourglass font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="mb-2 text-muted fw-medium">Dokumen Tertandai</p>
                                    <h4 class="mb-0">{{ $c }}</h4>
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

            @if(Auth::user()->is_dekan && $dekanData)
                <!-- Statistik khusus Dekan -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mini-stats-wid bg-warning bg-soft">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="mb-2 text-muted fw-medium">Surat Menunggu Persetujuan</p>
                                        <h4 class="mb-0">{{ $dekanData['pending_letters'] }}</h4>
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
                    <div class="col-md-4">
                        <div class="card mini-stats-wid bg-success bg-soft">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="mb-2 text-muted fw-medium">Surat Disetujui</p>
                                        <h4 class="mb-0">{{ $dekanData['approved_letters'] }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                                            <span class="avatar-title">
                                                <i class="bx bx-check-double font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid bg-danger bg-soft">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="mb-2 text-muted fw-medium">Surat Ditolak</p>
                                        <h4 class="mb-0">{{ $dekanData['rejected_letters'] }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-danger">
                                            <span class="avatar-title">
                                                <i class="bx bx-x-circle font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Surat Terbaru yang Menunggu Persetujuan -->
                @if($dekanData['recent_pending_letters']->count() > 0)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0 card-title">Surat Terbaru Menunggu Persetujuan</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Pemohon</th>
                                                    <th>Template</th>
                                                    <th>Tanggal Pengajuan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dekanData['recent_pending_letters'] as $letter)
                                                    <tr>
                                                        <td>{{ $letter->creator->name ?? 'N/A' }}</td>
                                                        <td>{{ $letter->template->name ?? 'N/A' }}</td>
                                                        <td>{{ $letter->created_at->format('d/m/Y H:i') }}</td>
                                                        <td>
                                                            <a href="{{ route('approve.letter', $letter->hashed_id ?? '') }}" 
                                                               class="btn btn-primary btn-sm">
                                                                <i class="bx bx-edit"></i> Review
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3 text-center">
                                        <a href="{{ route('list.pending.letters') }}" class="btn btn-outline-primary">
                                            Lihat Semua Surat Menunggu Persetujuan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>

@push('scripts')
    {{-- Livewire script sudah diload di layout --}}
@endpush
