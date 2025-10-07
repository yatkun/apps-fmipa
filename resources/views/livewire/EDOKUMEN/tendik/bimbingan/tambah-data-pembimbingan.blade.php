@push('styles')
    {{-- <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script> --}}
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush


@section('title', 'Tambah Data Bimbingan Mahasiswa')

<div class="main-content">
   
    <div class="page-content">
        <div class="container-fluid">


            <div class="row">


                <div class="col-lg-12">
                    <form wire:submit="handleSaveOrUpdate">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data Mahasiswa Bimbingan</h4>

                                <div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mt-3 mb-3">
                                                <label class="form-label required">Nama Lengkap</label>
                                                <input class="form-control @error('nama') parsley-error @enderror"
                                                    type="text" wire:model="nama"
                                                    placeholder="Masukkan Nama Lengkap Mahasiswa">
                                                @error('nama')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                        aria-hidden="false">
                                                        <li class="parsley-required">{{ $message }}</li>
                                                    </ul>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="nim" class="form-label required">Nomor Induk Mahasiswa
                                                    (NIM)</label>
                                                <input type="text" wire:model="nim"
                                                    class="form-control @error('nim') parsley-error @enderror"
                                                    id="basicpill-nim-input" placeholder="Masukkan NIM mahasiswa">
                                                @error('nim')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                        aria-hidden="false">
                                                        <li class="parsley-required">{{ $message }}</li>
                                                    </ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="angkatan" class="form-label required">Angkatan</label>
                                                <input type="text" wire:model="angkatan"
                                                    class="form-control @error('angkatan') parsley-error @enderror"
                                                    id="basicpill-angkatan-input" placeholder="Contoh : 2022">
                                                @error('angkatan')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                        aria-hidden="false">
                                                        <li class="parsley-required">{{ $message }}</li>
                                                    </ul>
                                                @enderror
                                            </div>
                                        </div>



                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="prodi" class="form-label required">Program Studi</label>
                                                <select class="form-select @error('prodi') parsley-error @enderror"
                                                    wire:model="prodi">
                                                    <option value="">Pilih program studi</option>
                                                    <option value="Matematika">Matematika</option>
                                                    <option value="Statistika">Statistika</option>
                                                    <option value="Bioteknologi">Bioteknologi</option>
                                                    <option value="Aktuaria">Aktuaria</option>
                                                </select>
                                                @error('angkatan')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                        aria-hidden="false">
                                                        <li class="parsley-required">{{ $message }}</li>
                                                    </ul>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-0">
                                                <label for="judul" class="form-label required">Judul Skripsi</label>
                                                <textarea id="basicpill-judul-input" class="form-control @error('judul') parsley-error @enderror" wire:model="judul"
                                                    rows="2" placeholder="Masukkan judul skripsi"></textarea>
                                                @error('angkatan')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                        aria-hidden="false">
                                                        <li class="parsley-required">{{ $message }}</li>
                                                    </ul>
                                                @enderror
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
                                                        <label class="form-label required">Pembimbing 1</label>
                                                        <select id="pembimbing_1" class="form-control select2"
                                                            wire:model.defer="pembimbing_1">
                                                            <option value="">Pilih Dosen</option>

                                                            @foreach ($user as $i)
                                                                @if ($i->id !== Auth::id())
                                                                    <!-- Menghindari pengguna yang sedang login -->
                                                                    <option value="{{ $i->id }}">
                                                                        {{ $i->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('pembimbing_1')
                                                            <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                aria-hidden="false">
                                                                <li class="parsley-required">{{ $message }}</li>
                                                            </ul>
                                                        @enderror

                                                    </div>


                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="mb-0" wire:ignore>
                                                        <label class="form-label">Pembimbing 2</label>
                                                        <select id="pembimbing_2" class="form-control select2"
                                                            wire:model.defer="pembimbing_2">
                                                            <option>Pilih Dosen</option>

                                                            @foreach ($user as $i)
                                                                @if ($i->id !== Auth::id())
                                                                    <!-- Menghindari pengguna yang sedang login -->
                                                                    <option value="{{ $i->id }}">
                                                                        {{ $i->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('pembimbing_2')
                                                            <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                                aria-hidden="false">
                                                                <li class="parsley-required">{{ $message }}</li>
                                                            </ul>
                                                        @enderror

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


                                                        <button wire:click="download('{{ $existingFile }}')"
                                                            type="button"
                                                            class="btn btn-sm btn-outline-info waves-effect waves-light">{{ basename($existingFile) }}</button>
                                                    </p>
                                                @endif
                                                <input type="file" name="document" id="document"
                                                    wire:model="document" class="block w-full mt-1 form-control">

                                            </div>
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

                        <a wire:navigate href="{{ route('tendik.pembimbingan') }}" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Kembali</a>
                    </form>
                </div>







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
    <script>
        function initSelect2() {
            $('#pembimbing_1').select2().on('change', function() {
                @this.set('pembimbing_1', $(this).val());
            });

            $('#pembimbing_2').select2().on('change', function() {
                @this.set('pembimbing_2', $(this).val());
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            initSelect2();
        });

        window.addEventListener('livewire:navigated', function() {
            setTimeout(() => {
                initSelect2();
            }, 100);
        });
    </script>

    <script src="{{ asset('assets/libs/parsleyjs/parsley.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
@endpush
