@push('styles')
    {{-- <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script> --}}
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    
    @endpush


@section('title', 'Tambah Data Bimbingan Mahasiswa')

<div class="main-content">
    @if (session('success'))
        @include('livewire.includes.alert-success', [
            'header' => 'Sukses',
        ])
    @endif
    <div class="page-content">
        <div class="container-fluid">

           
            <div class="row">

                <form wire:submit="upload" class="needs-validation" novalidate>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Mahasiswa Bimbingan</h4>

                            <div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mt-3 mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input class="form-control" type="text" wire:model="nama"
                                                placeholder="Masukkan Nama Lengkap Mahasiswa">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Nomor Induk Mahasiswa
                                                (NIM)</label>
                                            <input type="text" wire:model="nim" class="form-control"
                                                id="basicpill-nim-input" placeholder="Masukkan NIM mahasiswa">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-email-input">Angkatan</label>
                                            <input type="text" wire:model="angkatan" class="form-control"
                                                id="basicpill-angkatan-input" placeholder="Contoh : 2022">
                                        </div>
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="basicpill-email-input">Program Studi</label>
                                            <select class="form-select" wire:model="prodi">
                                                <option>Pilih program studi</option>
                                                <option value="Matematika">Matematika</option>
                                                <option value="Statistika">Statistika</option>
                                                <option value="Bioteknologi">Bioteknologi</option>
                                                <option value="Aktuaria">Aktuaria</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-0">
                                            <label for="basicpill-address-input">Judul Skripsi</label>
                                            <textarea id="basicpill-judul-input" class="form-control" wire:model="judul" rows="2"
                                                placeholder="Masukkan judul skripsi"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title ">Data Pembimbing</h4>
    
                                <div class="mt-3 mb-0">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3" wire:ignore>
                                                <label class="form-label">Pembimbing 1</label>
                                                <select class="form-control select2" wire:model.defer="pembimbing_1">
                                                    <option>Pilih Dosen</option>
    
                                                    @foreach ($user as $i)
                                                        @if ($i->id !== Auth::id())
                                                            <!-- Menghindari pengguna yang sedang login -->
                                                            <option value="{{ $i->id }}">
                                                                {{ $i->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
    
                                            </div>
    
    
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-0" wire:ignore>
                                                <label class="form-label">Pembimbing 2</label>
                                                <select class="form-control select2" wire:model.defer="pembimbing_2">
                                                    <option>Pilih Dosen</option>
    
                                                    @foreach ($user as $i)
                                                        @if ($i->id !== Auth::id())
                                                            <!-- Menghindari pengguna yang sedang login -->
                                                            <option value="{{ $i->id }}">
                                                                {{ $i->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
    
                                            </div>
    
                                        </div>
    
                                    </div>
    
    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title ">Dokumen Pendukung</h4>
                                <div class="mt-3 row">
                                    <label for="example-text-input" class="form-label">Pilih Dokumen</label>
                                    <div class="col-md-10">
                                        @if ($existingFile)
                                            <p>File Saat Ini:
                                                
    
                                                <button wire:click="download('{{ $existingFile }}')" type="button" class="btn btn-sm btn-outline-info waves-effect waves-light">{{ basename($existingFile) }}</button>
                                            </p>
                                        @endif
                                        <input type="file" name="document" id="document"
                                            wire:model="document" class="block w-full mt-1 form-control">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">
                        <span wire:loading.remove>{{ $mode == 'edit' ? 'Update' : 'Upload' }}</span>
                        <span wire:loading><span class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span> Proses Upload...</span>
                    </button>
                </div>
            </form>

               

                <!-- end col -->
            </div>




        </div> <!-- container-fluid -->
    </div>


</div>

@push('scripts')
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}" data-navigate-track></script>

<script src="{{ asset('assets/js/pages/form-advanced.init.js') }}" data-navigate-track></script>

    {{-- <script>
        document.addEventListener("livewire:initialized", () => {

            $('.select2').select2();
            console.log('Inisialisasi select2...');

            $('.select2').on('change', function(e) {
                let data = $(this).val();
                @this.set('selected', data); // pastikan 'selected' property memang ada di Livewire
            });
        });
    </script> --}}
    {{-- <script>
        function initSelect2() {
            $('.select2').select2();
            console.log('Inisialisasi select2...');

            $('.select2').on('change', function(e) {
                let data = $(this).val();
                @this.set('selected', data); // pastikan 'selected' property memang ada di Livewire
            });
        }

        window.addEventListener('livewire:navigated', () => {
            setTimeout(() => {
                initSelect2();
            }, 120);
        });

        document.addEventListener("DOMContentLoaded", function() {
            initSelect2(); // supaya jalan di first load
        });
    </script> --}}


   
@endpush
