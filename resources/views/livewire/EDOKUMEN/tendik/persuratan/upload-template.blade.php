



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
    <h2 class="mb-4">Unggah Template Baru</h2>

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

    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Template</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.defer="name">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="templateFile" class="form-label">Pilih File Template (.docx)</label>
            <input type="file" class="form-control @error('templateFile') is-invalid @enderror" id="templateFile" wire:model="templateFile">
            @error('templateFile') <div class="invalid-feedback">{{ $message }}</div> @enderror
            @if ($templateFile)
                <small class="mt-2 text-muted">File dipilih: {{ $templateFile->getClientOriginalName() }}</small>
            @endif
        </div>

        <div class="mb-3">
            <label for="dynamicTableMarker" class="form-label">Penanda Baris Tabel Dinamis (Opsional)</label>
            <input type="text" class="form-control @error('dynamicTableMarker') is-invalid @enderror" id="dynamicTableMarker" wire:model.defer="dynamicTableMarker">
            <small class="text-muted">Contoh: `row_idx`. Ini adalah placeholder yang digunakan PhpWord untuk mengkloning baris tabel.</small>
            @error('dynamicTableMarker') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Informasi tentang placeholder sistem -->
        <div class="mb-3">
            <div class="alert alert-info">
                <h6 class="alert-heading">
                    <i class="fas fa-info-circle"></i>
                    Informasi Placeholder Sistem
                </h6>
                <p class="mb-2">Placeholder berikut akan <strong>otomatis dikelola sistem</strong> dan tidak dapat diedit oleh Dosen maupun Tendik:</p>
                <ul class="mb-2">
                    <li><code>${qr_code}</code> - QR Code akan otomatis dihasilkan setelah surat disetujui Dekan</li>
                    <li><code>${ttd}</code> - Tanda tangan digital akan otomatis ditambahkan setelah surat disetujui Dekan</li>
                    <li><code>${tanda_tangan_dekan}</code> - <em>(Legacy)</em> Tanda tangan digital (backward compatibility)</li>
                </ul>
                <div class="alert alert-warning alert-sm mb-0">
                    <small>
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Penting:</strong> Placeholder sistem ini akan otomatis dikecualikan dari form input dan tidak akan muncul untuk diedit oleh user manapun.
                    </small>
                </div>
                <small class="text-muted mt-2 d-block">
                    <i class="fas fa-lightbulb"></i>
                    <strong>Tips:</strong> Gunakan placeholder ini di template untuk posisi QR code dan tanda tangan digital.
                </small>
            </div>
        </div>

        

        

        <button type="submit" class="mt-4 btn btn-primary">Unggah Template</button>
    </form>
</div>
           


        </div>
    </div>



</div>


<!-- Script untuk Handle Notifikasi dan Loading -->


@push('scripts')
    {{-- Livewire script sudah diload di layout --}}
   
@endpush
