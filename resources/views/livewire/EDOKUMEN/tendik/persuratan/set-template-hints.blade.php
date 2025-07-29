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
                <h2 class="mb-4">Atur Petunjuk untuk Template: {{ $template->name }}</h2>

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

                <p class="text-muted">Isi petunjuk singkat untuk setiap placeholder. Petunjuk ini akan membantu pengguna
                    saat mengisi data.</p>

                <form wire:submit.prevent="saveHints">
                    <div class="mb-3 row">
                        @forelse ($placeholderHints as $placeholder => $hint)
                            <div class="mb-3 col-md-6">
                                <label for="hint-{{ $placeholder }}" class="form-label">Petunjuk untuk
                                    `${{ $placeholder }}`</label>
                                <input type="text"
                                    class="form-control @error('placeholderHints.' . $placeholder) is-invalid @enderror"
                                    id="hint-{{ $placeholder }}"
                                    wire:model.defer="placeholderHints.{{ $placeholder }}"
                                    placeholder="Contoh: Nama lengkap atau Tanggal lahir">
                                @error('placeholderHints.' . $placeholder)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-info">Tidak ada placeholder yang terdeteksi untuk template ini.</p>
                            </div>
                        @endforelse
                    </div>

                    <button type="submit" class="mt-4 btn btn-primary">Simpan Petunjuk</button>
                    <a href="{{ route('admin.templates') }}" class="mt-4 btn btn-secondary">Kembali ke Daftar
                        Template</a>
                </form>
            </div>
        </div>
    </div>



</div>


<!-- Script untuk Handle Notifikasi dan Loading -->


@push('scripts')
    <script src="{{ asset('assets/js/livewire.js') }}" data-navigate-track></script>
@endpush
