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
                            <h4 class="mb-0 card-title">IKU 2 : Mahasiswa Berkegiatan/Meraih Prestasi di Luar Program
                                Studi
                            </h4>
                            <p class="card-title-desc">Persentase mahasiswa S1 dan D4/D3/D2/D1 yang menjalankan kegiatan
                                pembelajaran di luar
                                program studi atau meraih prestasi</p>

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
                                                            Mahasiswa yang tercakup adalah mahasiswa aktif yang
                                                            melaksanakan perkuliahan
                                                            pada semester 2022 genap dan semester 2023 ganjil.
                                                        </li>
                                                        <li>
                                                            Tidak termasuk dalam perhitungan prodi bidang kesehatan yang
                                                            terintegrasi dengan
                                                            program pendidikan profesi (Kedokteran (tidak termasuk
                                                            Kedokteran Gigi dan
                                                            Hewan), Kebidanan, dan Keperawatan)
                                                        </li>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingTwo">
                                                    <button class="accordion-button fw-medium collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                        aria-expanded="true" aria-controls="flush-collapseTwo">
                                                        Jumlah SKS di Luar Program Studi
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingTwo"
                                                    data-bs-parent="#accordionFlushExample" style="">
                                                    <div class="accordion-body text-muted">
                                                        <li>
                                                            Mahasiswa yang menghabiskan sampai dengan <b>20 sks per
                                                                semester</b> di luar
                                                            prodi
                                                        </li>
                                                        <li>
                                                            Batas minimal yang dapat dihitung adalah paling sedikit
                                                            <b>10 (sepuluh) sks</b>
                                                            untuk mahasiswa S1/D4/D3 dan <b>5 (lima) sks</b> untuk
                                                            mahasiswa D1 dan D2 per
                                                            semester
                                                        </li>
                                                        <li>
                                                            Pengakuan sks dihitung setahun penuh yang mencakup semester
                                                            genap dan ganjil
                                                            (2022-2 & 2023-1). Semester antara tidak diperhitungkan.
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-3a">
                                                    <button class="accordion-button fw-medium collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-3"
                                                        aria-expanded="true" aria-controls="flush-3a">
                                                        Pertukaran Pelajar Internal
                                                    </button>
                                                </h2>
                                                <div id="flush-3" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-3" data-bs-parent="#accordionFlushExample"
                                                    style="">
                                                    <div class="accordion-body text-muted">
                                                        <li>
                                                            Bentuk pembelajaran untuk menunjang terpenuhinya capaian
                                                            pembelajaran baik yang
                                                            sudah tertuang dalam struktur kurikulum program studi maupun
                                                            pengembangan
                                                            kurikulum untuk memperkaya capaian pembelajaran lulusan yang
                                                            dapat berbentuk
                                                            mata kuliah pilihan
                                                        </li>
                                                        <li>
                                                            Mata kuliah yang merupakan mata kuliah wajib kurikulum
                                                            pendidikan tinggi
                                                            (Pancasila, Agama, Bahasa Indonesia, dan Kewarganegaraan)
                                                            tidak termasuk dalam
                                                            perhitungan
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-4a">
                                                    <button class="accordion-button fw-medium collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-4"
                                                        aria-expanded="true" aria-controls="flush-collapseTwo">
                                                        Mahasiswa Inbound
                                                    </button>
                                                </h2>
                                                <div id="flush-4" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingTwo"
                                                    data-bs-parent="#accordionFlushExample" style="">
                                                    <div class="accordion-body text-muted">
                                                        <li>
                                                            Mahasiswa S1/D4/D3/D2/D1 yang diterima perguruan tinggi
                                                            dalam program pertukaran
                                                            pelajar di luar Perguruan Tinggi (eksternal)
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-5a">
                                                    <button class="accordion-button fw-medium collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-5"
                                                        aria-expanded="true" aria-controls="flush-collapseTwo">
                                                        Meraih Prestasi
                                                    </button>
                                                </h2>
                                                <div id="flush-5" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingTwo"
                                                    data-bs-parent="#accordionFlushExample" style="">
                                                    <div class="accordion-body text-muted">
                                                        <li>
                                                            Berprestasi dalam kompetisi atau lomba pada peringkat juara
                                                            I - III pada
                                                            kompetisi:

                                                        </li>
                                                        <div class="ml-5">
                                                            <li>tingkat internasional;</li>
                                                            <li>tingkat nasional; atau</li>
                                                            <li>tingkat provinsi.</li>
                                                            <li>Khusus untuk kepesertaan pada
                                                                kompetisi tingkat internasional, dapat niliai sebagai
                                                                kriteria (dapat
                                                                dibuktikan
                                                                dengan mekanisme seleksi yang ketat).</li>
                                                        </div>

                                                        <li>
                                                            Memiliki karya yang digunakan dunia usaha, industri dan
                                                            masyarakat yang bukan
                                                            merupakan hasil dari kompetisi → Karya harus disertai dengan
                                                            SK karya dari
                                                            Perguruan Tinggi
                                                        </li>
                                                        <li>
                                                            Mendapatkan sertifikasi kompetensi internasional.
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-6a">
                                                    <button class="accordion-button fw-medium collapsed"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-6" aria-expanded="false"
                                                        aria-controls="flush-collapseThree">
                                                        Pembobotan
                                                    </button>
                                                </h2>
                                                <div id="flush-6" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingThree"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body text-muted">
                                                        <div class="d-flex">
                                                            <div class="table-responsive">

                                                                <p class="mb-0 card-title-desc">Matriks Pembobotan
                                                                    untuk
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
                            <div class="card-title">
                                Prestasi Mahasiswa
                            </div>
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
                                        data-bs-target=".prestasi"
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
                                        <th wire:click="setsortBy('program_studi')" class="sorting_asc">
                                            <x-datatable-items columnName="Program Studi"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                        <th wire:click="setsortBy('sks_juara')" class="sorting_asc">
                                            <x-datatable-items columnName="Juara"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                        <th wire:click="setsortBy('level')" class="sorting_asc">
                                            <x-datatable-items columnName="Level"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                        <th wire:click="setsortBy('keterangan')" class="sorting_asc">
                                            <x-datatable-items columnName="Keterangan"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                        <th wire:click="setsortBy('tahun')" class="sorting_asc">
                                            <x-datatable-items columnName="Tahun"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                        <th wire:click="setsortBy('triwulan')" class="sorting_asc">
                                            <x-datatable-items columnName="Triwulan"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>

                                        <th>Bobot</th>

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
                                            <td>{{ $i->program_studi }}</td>
                                            <td>{{ $i->sks_juara }}</td>
                                            <td>{{ $i->level }}</td>
                                            <td>{{ $i->keterangan }}</td>
                                            <td>{{ $i->tahun }}</td>
                                            <td>{{ $i->triwulan }}</td>
                                            <td>{{ $i->bobot }}</td>

                                            <td>
                                                <div class="gap-2 d-flex">
                                                    <a href="{{ $i->bukti }}"
                                                        class="btn btn-sm btn-info waves-effect waves-light {{ $i->bukti ? '' : 'disabled' }}"
                                                        target="_blank"><i class="mdi mdi-file-document"></i></a>

                                                    <a wire:click="updatea({{ $i }})" id="btn-edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target=".bs-example-modal-center"
                                                        class="btn btn-sm btn-warning waves-effect waves-light btn-edit"
                                                        data-id="{{ $i->id }}"><i
                                                            class="mdi mdi-square-edit-outline "></i></a>
                                                    <a wire:click="deleteIku2a({{ $i->id }})"
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
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                Kegiatan Mahasiswa di Luar Kampus
                            </div>
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
                                        data-bs-target=".luar-kampus"
                                        class="mb-2 btn btn-success waves-effect btn-label waves-light"><i
                                            class="bx bx-check-double label-icon"></i> Tambah Data</button>
                                </div>
                            </div>

                            <table id="example" class="table table-bordered dt-responsive nowrap w-100"
                                wire:key={{ uniqid() }}>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th wire:click="setsortBy('nama')" class="sorting_asc"><x-datatable-items
                                                columnName="Nama Lengkap" :sortBy="$sortBy"></x-datatable-items></th>
                                        <th wire:click="setsortBy('program_studi')" class="sorting_asc">
                                            <x-datatable-items columnName="Program Studi"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                        <th wire:click="setsortBy('sks_juara')" class="sorting_asc">
                                            <x-datatable-items columnName="Total SKS"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                      
                                        <th wire:click="setsortBy('keterangan')" class="sorting_asc">
                                            <x-datatable-items columnName="Keterangan"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                        <th wire:click="setsortBy('tahun')" class="sorting_asc">
                                            <x-datatable-items columnName="Tahun"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                        <th wire:click="setsortBy('triwulan')" class="sorting_asc">
                                            <x-datatable-items columnName="Triwulan"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>

                                        <th>Bobot</th>

                                        <th>Aksi</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($b as $i)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $i->nama }}</td>
                                            <td>{{ $i->program_studi }}</td>
                                            <td>{{ $i->sks_juara }}</td>

                                            <td>{{ $i->keterangan }}</td>
                                            <td>{{ $i->tahun }}</td>
                                            <td>{{ $i->triwulan }}</td>
                                            <td>{{ $i->bobot }}</td>

                                            <td>
                                                <div class="gap-2 d-flex">
                                                    <a href="{{ $i->bukti }}"
                                                        class="btn btn-sm btn-info waves-effect waves-light {{ $i->bukti ? '' : 'disabled' }}"
                                                        target="_blank"><i class="mdi mdi-file-document"></i></a>

                                                    <a wire:click="updatea({{ $i }})" id="btn-edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target=".bs-example-modal-center"
                                                        class="btn btn-sm btn-warning waves-effect waves-light btn-edit"
                                                        data-id="{{ $i->id }}"><i
                                                            class="mdi mdi-square-edit-outline "></i></a>
                                                    <a wire:click="deleteIku2a({{ $i->id }})"
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
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade bs-example-modal-center prestasi" role="dialog" id="modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> {{ $mode == 'edit' ? 'Edit' : 'Tambah' }} Data IKU 2 | Prestasi Mahasiswa
                    </h5>
                    <button type="button" wire:click="cancelEdit" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit="savea">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nama Lengkap</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.nama" placeholder="Masukkan nama lengkap mahasiswa"
                                    name="nama">
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
                            <label class="col-md-2 col-form-label">Juara</label>
                            <div class="col-md-10">
                                <select class="form-select" name="sks_juara" wire:model="form.sks_juara">
                                    <option selected="">Pilih Juara</option>
                                    <option name="sks_juara" value="1">1</option>
                                    <option name="sks_juara" value="2">2</option>
                                    <option name="sks_juara" value="3">3</option>
                                    <option name="sks_juara" value="Peserta">Peserta</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Level</label>
                            <div class="col-md-10">
                                <select class="form-select" name="level" wire:model="form.level">
                                    <option selected="">Pilih level</option>
                                    <option name="level" value="Provinsi">Provinsi</option>
                                    <option name="level" value="Nasional">Nasional</option>
                                    <option name="level" value="Internasional">Internasional</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Keterangan</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.keterangan" placeholder="Contoh: Lomba Infografis"
                                    name="keterangan">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Tahun</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.tahun" placeholder="Contoh: 2025" name="tahun">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Triwulan</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.triwulan" placeholder="Contoh: 1" name="triwulan">
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
                        <button type="submit" wire:click="handleSaveOrUpdatea" wire:loading.attr="disabled"
                            class="btn btn-primary"> {{ $mode == 'edit' ? 'Update' : 'Simpan' }}</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div>
    </div>



    <div wire:ignore.self class="modal fade bs-example-modal-center luar-kampus" role="dialog" id="modal2">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> {{ $mode == 'edit' ? 'Edit' : 'Tambah' }} Data IKU 2 | Kegiatan Mahasiswa di Luar Kampus
                    </h5>
                    <button type="button" wire:click="cancelEdit" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit="saveb">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nama Lengkap</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.nama" placeholder="Masukkan nama lengkap mahasiswa"
                                    name="nama">
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
                            <label for="example-text-input" class="col-md-2 col-form-label">Keterangan</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.keterangan" placeholder="Contoh: Lomba Infografis"
                                    name="keterangan">
                            </div>
                        </div>
                         <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">SKS</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.sks_juara" placeholder="Contoh: 3" name="sks_juara">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Tahun</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.tahun" placeholder="Contoh: 2025" name="tahun">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Triwulan</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.triwulan" placeholder="Contoh: 1" name="triwulan">
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
                        <button type="submit" wire:click="handleSaveOrUpdateb" wire:loading.attr="disabled"
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
