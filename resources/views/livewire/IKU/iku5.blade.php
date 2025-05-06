@push('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-0 card-title">IKU 5 : Penerapan Karya Dosen
                            </h4>
                            <p class="card-title-desc">Jumlah keluaran dosen yang berhasil
                                mendapat rekognisi internasional atau diterapkan oleh masyarakat/industri/pemerintah per
                                jumlah dosen.</p>

                            <div class="row">


                                <div class="col-xl-12">
                                    <div class="mt-0">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                           
                                            <x-accordion.accordion id="1" title="Karya Tulis Ilmiah">
                                                <li>
                                                    Artikel ilmiah, buku akademik, dan bab (chapter) dalam buku akademik;
                                                </li>
                                                <li>
                                                    Karya rujukan: buku saku (handbook), pedoman (guidelines), manual, buku teks
                                                    (textbook), monograf, ensiklopedia, kamus; Studi kasus; dan/atau
                                                </li>
        
                                                <li>
                                                    Laporan penelitian untuk mitra.
                                                </li>
                                            </x-accordion.accordion>
                                            <x-accordion.accordion id="2" title="Karya Terapan">
                                                <li>
                                                    Produk fisik, digital, dan algoritme (termasuk prototipe); dan/atau
                                                </li>
                                                <li>
                                                    Pengembangan invensi dengan mitra.
                                                </li>
                                            </x-accordion.accordion>
                                            <x-accordion.accordion id="3" title="Karya Seni">
                                                <li>
                                                    Visual, audio, audio-visual, pertunjukan (performance);
                                                </li>
                                                <li>
                                                    Desain konsep, desain produk, desain komunikasi visual, desain arsitektur,
                                                    desain kriya;
                                                </li>
                                                <li>
                                                    Karya tulis novel, sajak, puisi, notasi musik; dan/atau
                                                </li>
        
                                                <li>
                                                    Karya preservasi (contoh: modernisasi seni tari daerah).
                                                </li>
                                            </x-accordion.accordion>
                                            
                                        </div>
                                        <!-- end accordion -->
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="align-items-center d-flex">
                                <div class="gap-2 flex-grow-1 d-flex">


                                    <div class="items-center d-flex col-md-2">

                                        <input id="myInputTextField" type="search"
                                            wire:model.live.debounce.300ms="search" class="mb-2 form-control"
                                            placeholder="Cari Data" aria-controls="example">
                                    </div>

                                    <div class="flex items-center flex-1 space-x-2">
                                        <!-- Select -->

                                        <!-- End Select -->

                                        <!-- Select -->
                                        <select class="form-select" wire:model.live='perPage'>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>

                                        <!-- End Select -->
                                    </div>
                                </div>
                                <div>
                                    <button type="button" data-bs-toggle="modal" wire:click="modes"
                                        data-bs-target=".bs-example-modal-center"
                                        class="mb-2 btn btn-success waves-effect btn-label waves-light"><i
                                            class=" bx bx-check-double label-icon"></i> Tambah Data</button>
                                </div>
                            </div>

                            <table id="example" class="table table-bordered dt-responsive nowrap w-100"
                                wire:key={{ uniqid() }}>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th wire:click="setsortBy('nama')" class="sorting_asc"><x-datatable-items
                                                columnName="Nama Lengkap" :sortBy="$sortBy"></x-datatable-items></th>
                                        <th wire:click="setsortBy('jenis_karya')" class="sorting_asc">
                                            <x-datatable-items columnName="Jenis Karya"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                        <th wire:click="setsortBy('kriteria')" class="sorting_asc">
                                            <x-datatable-items columnName="Kriteria"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                        <th wire:click="setsortBy('tanggal')" class="sorting_asc">
                                            <x-datatable-items columnName="Tanggal Terbit"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                     
                                        <th wire:click="setsortBy('keterangan')" class="sorting_asc">
                                            <x-datatable-items columnName="Keterangan"
                                                :sortBy="$sortBy"></x-datatable-items></th>
                                        <th wire:click="setsortBy('bobot')" class="sorting_asc">
                                            <x-datatable-items columnName="Bobot"
                                                :sortBy="$sortBy"></x-datatable-items></th>

                                        

                                        <th>Aksi</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($a as $i)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $i->nama }}</td>
                                            <td>{{ $i->jenis_karya }}</td>
                                            <td>{{ $i->kriteria }}</td>
                                            <td>{{ $i->tanggal }}</td>
                                            <td>{{ $i->keterangan }}</td>
                                            <td>{{ $i->bobot }}</td>
                                            

                                            <td>
                                                <div class="gap-2 d-flex">
                                                    <a href="{{ $i->bukti }}"
                                                        class="btn btn-sm btn-info waves-effect waves-light {{ $i->bukti ? '' : 'disabled' }}"
                                                        target="_blank"><i class="mdi mdi-file-document"></i></a>

                                                    <a wire:click="update({{ $i }})" id="btn-edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target=".bs-example-modal-center"
                                                        class="btn btn-sm btn-warning waves-effect waves-light btn-edit"
                                                        data-id="{{ $i->id }}"><i
                                                            class="mdi mdi-square-edit-outline "></i></a>
                                                    <a wire:click="deleteIku5({{ $i->id }})"
                                                        class="btn btn-sm btn-danger waves-effect waves-light"><i
                                                            class="mdi mdi-trash-can"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="">
                           
                                {{ $a->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>


    <div wire:ignore.self class="modal fade bs-example-modal-center" role="dialog" id="modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> {{ $mode == 'edit' ? 'Edit' : 'Tambah' }} Data IKU 5 | Karya Dosen
                    </h5>
                    <button type="button" wire:click="cancelEdit" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nama Lengkap</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.nama" placeholder="Masukkan nama lengkap"
                                    name="nama">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Jenis Karya</label>
                            <div class="col-md-10">
                                <select class="form-select" name="jenis_karya" wire:model.change="form.jenis_karya" required>
                                    <option selected value="">Pilih Jenis Karya</option>
                                    <option name="jenis_karya" value="Karya Tulis Ilmiah">Karya Tulis Ilmiah</option>
                                    <option name="jenis_karya" value="Karya Terapan">Karya Terapan</option>
                                    <option name="jenis_karya" value="Karya Seni">Karya Seni</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Kriteria</label>
                            <div class="col-md-10">
                                <select class="form-select" name="kriteria" wire:model="form.kriteria" required>
                                    <option selected value="">Pilih Kriteria</option>
                                    @foreach ($kriteriaOptions as $kriteria)
                                    <option value="{{ $kriteria }}">{{ $kriteria }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-date-input" class="col-md-2 col-form-label">Tanggal Terbit</label>
                            <div class="col-md-3">
                                <input class="form-control" type="date" 
                                    id="example-date-input" name="tanggal"
                                    wire:model="form.tanggal">
                            </div>
                        </div>

                 
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Keterangan</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.keterangan"
                                    name="keterangan">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Bukti Dokumen</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.bukti" placeholder="Masukkan link google drive" name="bukti">
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" wire:click="handleSaveOrUpdate" wire:loading.attr="disabled"
                            class="btn btn-primary"> {{ $mode == 'edit' ? 'Update' : 'Simpan' }}</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div>
    </div>

</div>


@push('scripts')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}" data-navigate-once></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}" data-navigate-once></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}" data-navigate-once>
    </script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}" data-navigate-once>
    </script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}" data-navigate-once>
    </script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"
        data-navigate-once></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}" data-navigate-once></script>

    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" data-navigate-once>
    </script>


    <script src="{{ asset('assets/js/livewire.js') }}" data-navigate-track></script>

    {{-- <script>
        
        $('#myInputTextField').keyup(function() {
            oTable.search($(this).val()).draw();
        })
    </script> --}}
@endpush
