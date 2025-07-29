
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
                <h2 class="mb-4">Detail Surat dan Persetujuan</h2>
            
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
            
                <div class="card">
                    <div class="card-header">
                        <h4>Surat ID: {{ $letter->id }}</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Nama Template:</strong> {{ $letter->template->name ?? 'N/A' }}</p>
                        <p><strong>Dibuat Pada:</strong> {{ $letter->created_at->format('d M Y H:i') }}</p>
                        <p><strong>Status:</strong> <span class="badge bg-warning">{{ $letter->status }}</span></p>
            
                        <h5 class="mt-4">Pratinjau Data Surat:</h5>
                        <div class="p-3 mb-4 rounded bg-light">
                            @foreach ($letter->data_filled as $key => $value)
                                @if ($key === 'table_data')
                                    <h6>Data Tabel:</h6>
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                @foreach (($letter->template->table_placeholders ?? []) as $ph)
                                                    <th>{{ ucfirst(str_replace('_', ' ', $ph)) }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($value as $rowIndex => $rowData)
                                                <tr>
                                                    @foreach (($letter->template->table_placeholders ?? []) as $ph)
                                                        <td>{{ $rowData[$ph] ?? '' }}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</p>
                                @endif
                            @endforeach
                        </div>
            
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ Storage::url($letter->file_path) }}" target="_blank" class="btn btn-primary" download>
                                <i class="fas fa-download"></i> Unduh Surat Asli
                            </a>
            
                            @if ($letter->status === 'pending')
                                <div>
                                    <button wire:click="approveLetter" wire:confirm="Anda yakin ingin MENYETUJUI surat ini?" class="btn btn-success me-2">
                                        Setujui Surat
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                        Tolak Surat
                                    </button>
                                </div>
                            @elseif($letter->status === 'approved')
                                <span class="badge bg-success">Disetujui pada {{ $letter->approved_at->format('d M Y H:i') }} oleh {{ $letter->approver->name ?? 'N/A' }}</span>
                            @elseif($letter->status === 'rejected')
                                <span class="badge bg-danger">Ditolak pada {{ $letter->approved_at->format('d M Y H:i') }} oleh {{ $letter->approver->name ?? 'N/A' }}</span>
                                <p class="mt-2"><strong>Alasan Penolakan:</strong> {{ $letter->rejection_reason }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            
                <div wire:ignore.self class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rejectModalLabel">Tolak Surat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="rejectionReason" class="form-label">Alasan Penolakan:</label>
                                    <textarea wire:model.defer="rejectionReason" class="form-control @error('rejectionReason') is-invalid @enderror" id="rejectionReason" rows="4"></textarea>
                                    @error('rejectionReason') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button wire:click="rejectLetter" class="btn btn-danger" data-bs-dismiss="modal">Tolak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Script untuk Handle Notifikasi dan Loading -->


@push('scripts')
    <script src="{{ asset('assets/js/livewire.js') }}" data-navigate-track></script>
   
@endpush
