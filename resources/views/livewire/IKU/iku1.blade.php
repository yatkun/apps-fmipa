@push('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <style>
        .error-notif {
            position: fixed;
            left: 0px;
            right: 0px;
            z-index: 9999;
            display: flex;
            justify-content: center;
            display: hidden;
            top: 1.25rem;

        }

        .notif-content {
            display: flex;
            align-items: center;
            background: #556ee6;
            color: white;
            gap: 1rem;
            padding-left: 0.75rem
                /* 12px */
            ;
            padding-right: 0.75rem
                /* 12px */
            ;
            padding-top: 0.75rem
                /* 12px */
            ;
            padding-bottom: 0.75rem
                /* 12px */
            ;
            border-radius: 0.125rem
                /* 2px */
            ;
        }
    </style>
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
                            <h4 class="mb-0 card-title">IKU 1 : Lulusan Mendapatkan Pekerjaan yang Layak
                            </h4>
                            <p class="card-title-desc"> Persentase lulusan yang berhasil memiliki pekerjaan, melanjutkan
                                studi, atau menjadi wiraswasta</p>

                            <div class="row">


                                <div class="col-xl-12">
                                    <div class="mt-0">

                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button fw-medium collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                        aria-expanded="false" aria-controls="flush-collapseOne">
                                                        Penjelasan Umum
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingOne"
                                                    data-bs-parent="#accordionFlushExample" style="">
                                                    <div class="accordion-body text-muted">
                                                        <li>
                                                            Masa tunggu 12 (dua belas) bulan setelah tanggal terbit
                                                            ijazah
                                                        </li>
                                                        <li>
                                                            Mahasiswa yang lulus sepanjang 1 (satu) tahun sebelum tahun
                                                            anggaran yang
                                                            sedang
                                                            berjalan (lulusan sepanjang tahun 2022)
                                                        </li>
                                                        <li>
                                                            Menggunakan pembanding UMP tahun 2023
                                                        </li>
                                                        <li>
                                                            Provinsi yang dipakai adalah provinsi tempat bekerja lulusan
                                                        </li>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingTwo">
                                                    <button class="accordion-button fw-medium collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                        aria-expanded="true" aria-controls="flush-collapseTwo">
                                                        Kriteria Lanjut Studi
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingTwo"
                                                    data-bs-parent="#accordionFlushExample" style="">
                                                    <div class="accordion-body text-muted">
                                                        <li>
                                                            Melanjutkan studi di prodi profesi, S1/D4 terapan, S2/S2
                                                            terapan, S3/S3
                                                            terapan
                                                            di dalam negeri atau luar negeri
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingThree">
                                                    <button class="accordion-button fw-medium collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                                        aria-expanded="false" aria-controls="flush-collapseThree">
                                                        Pembobotan
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingThree"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body text-muted">
                                                        <div class="d-flex">
                                                            <div class="table-responsive">

                                                                <p class="mb-0 card-title-desc">Matriks Pembobotan untuk
                                                                    kriteria bekerja</p>
                                                                <table class="table mb-0">

                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th>Gaji / Masa Tunggu</th>
                                                                            <th>≤ 6 bulan</th>
                                                                            <th>6 < Waktu Tunggu ≤ 12 bulan</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="text-center">
                                                                        <tr>
                                                                            <th scope="row">Gaji ≥ 1.2x UMP</th>
                                                                            <td>1.0</td>
                                                                            <td>0.8</td>

                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Gaji < 1.2x UMP</th>
                                                                            <td>0.7</td>
                                                                            <td>0.5</td>

                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
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
                                        <th wire:click="setsortBy('nama')" class="sorting_asc"><x-datatable-items columnName="Nama Lengkap" :sortBy="$sortBy"></x-datatable-items></th>
                                        <th wire:click="setsortBy('program_studi')" class="sorting_asc">
                                            <x-datatable-items columnName="Program Studi" :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                        <th wire:click="setsortBy('tanggal_lulus')" class="sorting_asc"><x-datatable-items columnName="Tanggal Lulus" :sortBy="$sortBy"></x-datatable-items></th>
                                        <th wire:click="setsortBy('pekerjaan')" class="sorting_asc"><x-datatable-items columnName="Pekerjaan" :sortBy="$sortBy"></x-datatable-items></th>
                                        <th wire:click="setsortBy('masa_tunggu')" class="sorting_asc"><x-datatable-items columnName="Masa Tunggu" :sortBy="$sortBy"></x-datatable-items></th>
                                        <th>Bobot</th>

                                        <th>Aksi</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($ikusatu as $i)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $i->nama }}</td>
                                            <td>{{ $i->program_studi }}</td>
                                            <td>{{ $i->tanggal_lulus }}</td>
                                            <td>{{ $i->pekerjaan }}</td>
                                            <td>{{ $i->masa_tunggu }}</td>
                                            <td>{{ $i->bobot }}</td>

                                            <td>
                                                <div class="gap-2 d-flex">
                                                    <a href="{{ $i->bukti }}"
                                                        class="btn btn-sm btn-info waves-effect waves-light {{ $i->bukti ? '' : 'disabled' }}"
                                                        target="_blank"><i class="mdi mdi-file-document"></i></a>

                                                    <a wire:click="updateiku1({{ $i }})" id="btn-edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target=".bs-example-modal-center"
                                                        class="btn btn-sm btn-warning waves-effect waves-light btn-edit"
                                                        data-id="{{ $i->id }}"><i
                                                            class="mdi mdi-square-edit-outline "></i></a>
                                                    <a wire:click="deleteIku1({{ $i->id }})"
                                                        class="btn btn-sm btn-danger waves-effect waves-light"><i
                                                            class="mdi mdi-trash-can"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="">
                                {{ $ikusatu->links() }}
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
                    <h5 class="modal-title"> {{ $mode == 'edit' ? 'Edit' : 'Tambah' }} Data IKU 1 | Lulusan
                        Mendapatkan
                        Pekerjaan</h5>
                    <button type="button" wire:click="cancelEdit" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nama Lengkap</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.nama" placeholder="Masukkan nama lengkap alumni" name="nama">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Program Studi</label>
                            <div class="col-md-10">
                                <select class="form-select" name="program_studi" wire:model="form.program_studi">
                                    <option>Pilih Program Studi</option>
                                    <option value="Matematika">Matematika</option>
                                    <option value="Statistika">Statistika</option>
                                    <option value="Aktuaria">Aktuaria</option>
                                    <option value="Bioteknologi">Bioteknologi</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-date-input" class="col-md-2 col-form-label">Tanggal Lulus</label>
                            <div class="col-md-3">
                                <input class="form-control" type="date" value="2019-08-19"
                                    id="example-date-input" placeholder="masukkan tanggal lulus" name="tanggal_lulus"
                                    wire:model="form.tanggal_lulus">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Pekerjaan</label>
                            <div class="col-md-10">
                                <select class="form-select" wire:model="form.pekerjaan" name="pekerjaan">
                                    <option>Pilih Pekerjaan</option>
                                    <option value="Bekerja">Bekerja</option>
                                    <option value="Wirausaha">Wirausaha</option>
                                    <option value="Lanjut studi">Lanjut studi</option>
                                    <option value="-">Belum Bekerja</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Pendapatan</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <div class="input-group-text">Rp.</div>
                                    <input type="text" class="form-control" id="autoSizingInputGroup"
                                        placeholder="Masukkan pendapatan" wire:model="form.pendapatan"
                                        name="pendapatan">
                                </div>

                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Masa Tunggu</label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <select class="form-select" wire:model="form.masa_tunggu" name="masa_tunggu">
                                        <option>Pilih masa tunggu</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <div class="input-group-text">Bulan</div>

                                </div>

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
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}" data-navigate-once>
    </script>
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
