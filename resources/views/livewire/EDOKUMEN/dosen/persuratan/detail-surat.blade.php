@section('title', 'Detail Surat')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="mb-4 border-0 shadow card animate__animated animate__fadeIn">
                            <div class=" card-header bg-light d-flex align-items-center justify-content-between">
                                <h5 class="mb-0"><i class="bx bx-file me-2"></i>Detail Surat</h5>
                                <span class="badge badge-soft-success">{{ $letter->status }}</span>
                              
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <h4 class="mb-1 fw-bold text-primary">{{ $letter->template->name ?? $letter->title }}</h4>
                                    <div class="mb-2 text-muted small">
                                        <i class="bx bx-calendar me-1"></i> Dibuat: {{ $letter->created_at->format('d M Y H:i') }}
                                    </div>
                                </div>
                                <div class="mb-3 row g-3">
                                    @foreach ($letter->data_filled ?? [] as $key => $value)
                                        @if (is_array($value) && $key === 'table_data' && count($value) > 0 && is_array($value[0]))
                                            <div class="col-12">
                                                <div class="mb-2 fw-semibold text-secondary text-uppercase" style="font-size:0.95rem;">{{ str_replace('_', ' ', $key) }}</div>
                                                <div class="mb-3 table-responsive">
                                                    <table class="table align-middle bg-white table-bordered table-hover table-sm">
                                                        <thead class="table-light">
                                                            <tr>
                                                                @foreach(array_keys($value[0]) as $col)
                                                                    <th class="text-capitalize">{{ str_replace('_', ' ', $col) }}</th>
                                                                @endforeach
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($value as $row)
                                                                <tr>
                                                                    @foreach($row as $v)
                                                                        <td>{{ $v }}</td>
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @elseif (is_array($value))
                                            <div class="col-12">
                                                <div class="mb-2 fw-semibold text-secondary text-uppercase" style="font-size:0.95rem;">{{ str_replace('_', ' ', $key) }}</div>
                                                <ul class="mb-0 ps-3">
                                                    @foreach ($value as $row)
                                                        <li>
                                                            @foreach ($row as $k => $v)
                                                                <strong>{{ str_replace('_', ' ', $k) }}:</strong> {{ $v }}<br>
                                                            @endforeach
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1 small text-muted text-uppercase fw-semibold">{{ str_replace('_', ' ', $key) }}</div>
                                                <div class="px-3 py-2 mb-2 border rounded bg-light">{{ $value }}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="mt-4 d-flex justify-content-between align-items-center">
                                    <a href="{{ route('dosen.persuratan.list-surat') }}" class="btn btn-outline-primary">
                                        <i class="bx bx-arrow-back"></i> Kembali
                                    </a>
                                    @if($letter->status === 'approved' && !empty($letter->file_path))
                                        <a href="{{ asset('storage/' . $letter->file_path) }}" class="btn btn-success" target="_blank">
                                            <i class="bx bx-download"></i> Download Surat
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%) !important;
    }
    .card-header.bg-gradient-primary {
        border-bottom: 1px solid #e3e6f0;
    }
    .fw-semibold { font-weight: 600; }
    .table th, .table td { vertical-align: middle !important; }
    .border { border-color: #e3e6f0 !important; }
    .animate__animated { animation-duration: 0.7s; }
</style>
@endpush
