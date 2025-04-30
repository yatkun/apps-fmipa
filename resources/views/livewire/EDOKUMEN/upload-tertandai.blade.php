@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>
@endpush


@section('title', 'Upload Dokumen Tertandai')

<div class="main-content">
    @if (session('success'))
        @include('livewire.includes.alert-success', [
            'header' => 'Sukses',
        ])
    @endif
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Upload Dokumen</h4>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Form Upload Dokumen</h4>

                            <form wire:submit="handleSaveOrUpdate">
                                <div class="mt-3 row">
                                    <div class="col-lg-12">

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Nama
                                                Dokumen</label>
                                            <div class="col-md-10">
                                                <input id="validationCustom05"
                                                    class="form-control @error('nama') parsley-error @enderror"
                                                    type="text" id="example-text-input" wire:model="nama"
                                                    placeholder="Masukkan nama dokumen" name="nama">

                                                @error('nama')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                        aria-hidden="false">
                                                        <li class="parsley-required">{{ $message }}</li>
                                                    </ul>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Pilih
                                                Dokumen</label>
                                            <div class="col-md-10">
                                                @if ($existingFile)
                                                    <p>File Saat Ini:
                                                        <button wire:click="download('{{ $existingFile }}')"
                                                            type="button"
                                                            class="btn btn-sm btn-outline-info waves-effect waves-light">{{ basename($existingFile) }}</button>
                                                    </p>
                                                @endif
                                                <input type="file" name="document" id="document"
                                                    wire:model.defer="document" class="block w-full mt-1 form-control  @error('document') parsley-error @enderror">
                                                @error('document')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                        aria-hidden="false">
                                                        <li class="parsley-required">{{ $message }}</li>
                                                    </ul>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Tandai Pengguna</label>
                                            <div class="col-md-10">


                                                <div wire:ignore>
                                                    <select id="tom-select-it" name="pengguna" multiple wire:model.defer="pengguna" class=" @error('pengguna') parsley-error @enderror"
                                                        placeholder="Pilih dosen/tendik..." autocomplete="off">
                                                        <option value="">Pilih dosen/tendik...</option>
                                                        @foreach ($user as $i)
                                                            @if ($i->id !== Auth::id())
                                                                <!-- Menghindari pengguna yang sedang login -->
                                                                <option value="{{ $i->id }}">
                                                                    {{ $i->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('pengguna')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-5"
                                                            aria-hidden="false">
                                                            <li class="parsley-required">{{ $message }}</li>
                                                        </ul>
                                                    @enderror
                                                </div>
                                            </div>


                                        </div>


                                        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">
                                            <span wire:loading.remove>{{ $mode == 'edit' ? 'Update' : 'Upload' }}</span>
                                            <span wire:loading><span class="spinner-border spinner-border-sm"
                                                    role="status" aria-hidden="true"></span> Proses Upload...</span>
                                        </button>
                                        <a wire:navigate href="{{ route('dokumen.tandai') }}" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</a>


                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- end select2 -->

                </div>


            </div>

        </div>
    </div>


</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tom-select-it').on('change', function() {
                let data = $(this).val();
                console.log(data);
                @this.pengguna = data;
            })
        });
    </script>
    <script>
        document.addEventListener("livewire:navigated", () => {
            var settings = {
                plugins: ['remove_button'],
                persist: false,
            };
            new TomSelect('#tom-select-it', settings);
        }, {
            once: true
        });
    </script>

    <script src="{{ asset('assets/js/livewire.js') }}" data-navigate-track></script>


    <script src="{{ asset('assets/js/pages/form-validation.init.js') }}" data-navigate-track></script>


    <script src="{{ asset('assets/libs/spectrum-colorpicker2/spectrum.min.js') }}" data-navigate-track></script>

    <script src="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}" data-navigate-track>
    </script>
@endpush
