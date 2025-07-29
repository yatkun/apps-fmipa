



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

        

        

        <button type="submit" class="mt-4 btn btn-primary">Unggah Template</button>
    </form>
</div>
           


        </div>
    </div>



</div>


<!-- Script untuk Handle Notifikasi dan Loading -->


@push('scripts')
    <script src="{{ asset('assets/js/livewire.js') }}" data-navigate-track></script>
   
@endpush
