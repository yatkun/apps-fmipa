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
                            <h4 class="mb-0 card-title">IKU 6 : Kemitraan
                                Program Studi
                            </h4>
                            <p class="card-title-desc">Jumlah kerjasama per program studi S1
                                dan D4/D3/D2/D1.</p>

                            <div class="row">


                                <div class="col-xl-12">
                                    <div class="mt-0">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                           
                                            <x-accordion.accordion id="1" title="Penjelasan Umum">
                                                <li>
                                                    Kerjasama yang diakui adalah yang dihasilkan sepanjang tahun anggaran 2023
                                                </li>
                                                <li>
                                                    Naskah kerja sama dalam bentuk:
                                                </li>
                                                <div style="margin-left: 1.25rem">
                                                    <li>Memorandum Of Agreement (Perjanjian Kerja sama); atau</li>
                                                    <li>ImplementingArrangement(IA)</li>
                                                </div>
                                                <li>
                                                    Semua data akan dilakukan proses verifikasi dan validasi, dan nilai akan
                                                    muncul
                                                    ketika proses verval selesai
                                                </li>
                                            </x-accordion.accordion>
                                            <x-accordion.accordion id="2" title="Pembobotan">
                                               <li></li>
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
                                     
                                        <th wire:click="setsortBy('kriteria')" class="sorting_asc">
                                            <x-datatable-items columnName="Kriteria"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                       
                                           <th> <x-datatable-items columnName="Bobot"
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
                                            <td>{{ $i->kriteria }}</td>
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
                                                    <a wire:click="deleteIku6({{ $i->id }})"
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
                    <h5 class="modal-title"> {{ $mode == 'edit' ? 'Edit' : 'Tambah' }} Data IKU 6 | Kemitraan Program Studi
                    </h5>
                    <button type="button" wire:click="cancelEdit" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nama Mitra</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.nama" placeholder="Masukkan nama mitra"
                                    name="nama">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Kriteria</label>
                            <div class="col-md-10">
                                <select class="form-select" name="kriteria" wire:model="form.kriteria" required>
                                    <option selected value="">Pilih Kriteria</option>
                                    <option name="kriteria" value="Perusahaan multinasional">Perusahaan multinasional</option>
                                    <option name="kriteria" value="Organisasi nirlaba kelas dunia">Organisasi nirlaba kelas dunia</option>
                                    <option name="kriteria" value="Perusahaan nasional berstandar tinggi, BUMN, dan/atau BUMD">Perusahaan nasional berstandar tinggi, BUMN, dan/atau BUMD</option>
                                    <option name="kriteria" value="Perusahaan rintisan (startup company) teknologi">Perusahaan rintisan (startup company) teknologi</option>
                                    <option name="kriteria" value="Perguruan tinggi yang masuk dalam daftar QS200 berdasarkan bidang ilmu (QS200 by subject) perguruan tinggi dalam negeri">Perguruan tinggi yang masuk dalam daftar QS200 berdasarkan bidang ilmu (QS200 by subject) perguruan tinggi dalam negeri</option>
                                    <option name="kriteria" value="Perusahaan teknologi global">Perusahaan teknologi global</option>
                                    <option name="kriteria" value="Institusi/organisasi multilateral">Institusi/organisasi multilateral</option>
                                    <option name="kriteria" value="Perguruan tinggi yang masuk dalam daftar QS200 berdasarkan bidang ilmu (QS200 by subject) perguruan tinggi luar negeri">Perguruan tinggi yang masuk dalam daftar QS200 berdasarkan bidang ilmu (QS200 by subject) perguruan tinggi luar negeri</option>
                                    <option name="kriteria" value="Instansi pemerintah">Instansi pemerintah</option>
                                    <option name="kriteria" value="Rumah sakit">Rumah sakit</option>
                                    <option name="kriteria" value="Lembaga riset pemerintah, swasta, nasional, maupun internasional">Lembaga riset pemerintah, swasta, nasional, maupun internasional</option>
                                    <option name="kriteria" value="Lembaga kebudayaan berskala nasional/bereputasi">Lembaga kebudayaan berskala nasional/bereputasi</option>
                                </select>
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
