@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>
@endpush


@section('title', 'Dokumen Tertandai')

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
                        <h4 class="mb-sm-0 font-size-18">Dokumen Publik</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="d-xl-flex">
                    <div class="w-100">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-grow-1">
                                        <div class="search-box me-3 flex-grow-1">
                                            <div class="position-relative">
                                                <input id="myInputTextField" type="search"
                                                    wire:model.live.debounce.300ms="search" type="text"
                                                    class="rounded form-control bg-light border-light"
                                                    placeholder="Cari Dokumen...">
                                                <i class="bx bx-search-alt search-icon"></i>
                                            </div>
                                        </div>
                                        <div class="space-x-2 me-3">
                                            <select class="form-select" wire:model.live='perPage'>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">Tambah Dokumen <i
                                                    class="mdi mdi-chevron-down"></i></button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item" href="{{ route('dokumen.tandai.upload') }}"
                                                    wire:navigate>Upload Dokumen</a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target=".bs-example-modal-center">Link Dokumen</a>

                                            </div>
                                        </div>
                                        {{-- <a href="{{ route('dokumen.tandai.upload') }}" wire:navigate
                                            class=" btn btn-success waves-effect btn-label waves-light"><i
                                                class=" bx bx-plus label-icon"></i>Dokumen</a> --}}
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="example" class="table mt-3 table-bordered dt-responsive nowrap w-100"
                                        wire:key={{ uniqid() }}>
                                        <thead>
                                            <tr>

                                                <th style="width: 70%" wire:click="setsortBy('nama')"
                                                    class="sorting_asc">
                                                    <x-datatable-items columnName="Nama Dokumen"
                                                        :sortBy="$sortBy"></x-datatable-items>
                                                </th>
                                                <th style="width: 20%" wire:click="setsortBy('created_at')"
                                                    class="sorting_asc">
                                                    <x-datatable-items columnName="Tanggal Upload"
                                                        :sortBy="$sortBy"></x-datatable-items>
                                                </th>
                                               
                                                <th style="width: 10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dok as $i)
                                                <tr>
                                                    {{-- <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-xs me-3">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-info bg-soft text-dark font-size-16">
                                                                    <i class="{{ $i->icon }}"></i>
                                                                </span>
                                                            </div>
                                                            
                                                            <span>{{ $i->nama }}</span>
                                                        </div>
                                                    </td> --}}
                                                    <td><i
                                                        class="align-middle {{ $i->icon }} font-size-16  me-2"></i>{{ $i->nama }}

                                                        <i  data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ $i->user->name  }}" class="align-middle bx bxs-group" style="color: rgb(124, 124, 124)"></i>
                                                </td>
                                                    <td>{{ $i->created_at->format('d-m-Y') }}</td>
                                                    
                                                    <td>
                                                        <ul class="gap-1 mb-0 list-unstyled hstack">
                                                            @if ($i->icon == 'mdi mdi-google-drive')
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Download">

                                                                    <a href="{{ $i->document }}"
                                                                        wire:loading.attr="disabled" target="_blank"
                                                                        class="btn btn-sm btn-soft-primary"><i
                                                                            wire:loading.remove
                                                                            wire:target="download({{ $i->id }})"
                                                                            class="mdi mdi-download-box-outline"></i>

                                                                    </a>
                                                                </li>
                                                            @else
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Download">

                                                                    <a wire:click="download({{ $i->id }})"
                                                                        wire:loading.attr="disabled" target="_blank"
                                                                        class="btn btn-sm btn-soft-primary"><i
                                                                            wire:loading.remove
                                                                            wire:target="download({{ $i->id }})"
                                                                            class="mdi mdi-download-box-outline"></i>
                                                                        <span wire:loading
                                                                            wire:target="download({{ $i->id }})"><span
                                                                                class="spinner-border spinner-border-sm"
                                                                                role="status"
                                                                                aria-hidden="true"></span></span>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if ($userId == $i->user->id)
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Edit">
                                                                    <a href="{{ route('dokumen.tandai.edit', ['hashid' => $i->hashid]) }}"
                                                                        wire:navigate id="btn-edit"
                                                                        class="btn btn-sm btn-soft-info"
                                                                        data-id="{{ $i->id }}"><i
                                                                            class="mdi mdi-pencil-outline"></i></a>
                                                                </li>



                                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Hapus">
                                                                    <a href="javascript:void(0);"
                                                                        wire:loading.attr="disabled"
                                                                        onclick="if (confirm('Apakah Anda yakin ingin menghapus dokumen ini?')) @this.delete({{ $i->id }})"
                                                                        class="btn btn-sm btn-soft-danger">
                                                                        <i wire:loading.remove
                                                                            wire:target="delete({{ $i->id }})"
                                                                            class="mdi mdi-delete-outline"></i>
                                                                        <span wire:loading
                                                                            wire:target="delete({{ $i->id }})"><span
                                                                                class="spinner-border spinner-border-sm"
                                                                                role="status"
                                                                                aria-hidden="true"></span></span>
                                                                    </a>
                                                                </li>
                                                            @endif

                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="">
                                    {{ $dok->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade bs-example-modal-center" role="dialog" id="modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> {{ $mode == 'edit' ? 'Edit' : 'Tambah' }} Dokumen Tertandai
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit="handleSaveOrUpdate" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nama Dokumen</label>
                            <div class="col-md-10">
                                <input class="form-control @error('nama') parsley-error @enderror" type="text" id="example-text-input" wire:model="nama"
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
                            <label for="example-text-input" class="col-md-2 col-form-label">Link Dokumen</label>
                            <div class="col-md-10">
                                <input class="form-control @error('doc') parsley-error @enderror" type="text" id="example-text-input" wire:model="doc"
                                    placeholder="Masukkan link google drive" name="document">
                                    @error('doc')
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

                                    <select class="@error('pengguna') parsley-error @enderror" id="tom-select-it" wire:model="pengguna" name="state[]" multiple
                                        placeholder="Pilih dosen/tendik..." autocomplete="off">
                                        <option value="">Pilih dosen/tendik...</option>

                                        @foreach ($user as $i)
                                            @if ($i->id !== Auth::id())
                                                <!-- Menghindari pengguna yang sedang login -->
                                                <option value="{{ $i->id }}">
                                                    {{ $i->name }}</option>
                                            @endif
                                        @endforeach

                                        {{-- @foreach ($user as $i)
                                            @if ($i->id !== Auth::id())
                                                <!-- Menghindari pengguna yang sedang login -->
                                                <option value="{{ $i->id }}">
                                                    {{ $i->name }}</option>
                                            @endif
                                        @endforeach --}}
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

                    </div>
                    <div class="modal-footer">
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">
                            <span wire:loading.remove>{{ $mode == 'edit' ? 'Update' : 'Simpan' }}</span>
                            <span wire:loading><span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span> Proses Simpan...</span>
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
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
    {{-- Livewire script sudah diload di layout --}}
@endpush
