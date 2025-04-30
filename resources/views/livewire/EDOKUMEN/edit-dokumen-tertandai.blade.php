@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>
@endpush

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
                        <h4 class="mb-sm-0 font-size-18">Update Dokumen</h4>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Form Update Dokumen</h4>

                            <form wire:submit="update()">
                                <div class="mt-3 row">
                                    <div class="col-lg-12">
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Nama
                                                Dokumen</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="example-text-input"
                                                    wire:model="nama" placeholder="Masukkan nama dokumen"
                                                    name="nama">
                                            </div>
                                        </div>

                                        @if ($icon == 'mdi mdi-google-drive')
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Link Dokumen</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="example-text-input"
                                                    wire:model="document" placeholder="Masukkan link google drive"
                                                    name="document">
                                            </div>
                                        </div>
                                        @else
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Pilih
                                                    Dokumen</label>
                                                <div class="col-md-10">
                                                    @if ($existingFile)
                                                        <p>File Saat Ini:
                                                            <button wire:click="download({{ $dokumenId }})"
                                                                type="button"
                                                                class="btn btn-sm btn-outline-info waves-effect waves-light">
                                                                {{ basename($existingFile) }}
                                                            </button>
                                                        </p>
                                                    @endif
                                                    <input type="file" name="document" id="document"
                                                        wire:model.defer="document"
                                                        class="block w-full mt-1 form-control">
                                                </div>
                                            </div>
                                        @endif

                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Tandai Pengguna</label>
                                            <div class="col-md-10">
                                                <div wire:ignore>
                                                    <select id="tom-select-it" name="state[]" multiple
                                                        placeholder="Pilih dosen/tendik..." autocomplete="off">
                                                        <option value="">Pilih dosen/tendik</option>
                                                        @foreach ($penggunaOptions as $id => $name)
                                                            @if ($id !== Auth::id())
                                                                <option value="{{ $id }}"
                                                                    {{ in_array($id, $pengguna) ? 'selected' : '' }}>
                                                                    {{ $name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit"
                                    wire:loading.attr="disabled" class="btn btn-primary">
                                    <span wire:loading.remove>
                                        {{ $mode == 'edit' ? 'Update' : ($mode == 'download' ? 'Download' : 'Upload') }}
                                    </span>
                                    <span wire:loading>
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        {{ $mode == 'download' ? ' Proses Download...' : ' Proses Upload...' }}
                                    </span>
                                </button>
                                <a wire:navigate href="{{ route('dokumen.tandai') }}" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</a>
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
@endpush
