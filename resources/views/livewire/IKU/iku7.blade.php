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
                            <h4 class="mb-0 card-title">IKU 7 : Pembelajaran dalam Kelas
                            </h4>
                            <p class="card-title-desc">Persentase mata kuliah S1 dan D4/D3/D2/D1 yang menggunakan metode pembelajaran pemecahan kasus (case method) atau pembelajaran kelompok berbasis project (team-based project) sebagai sebagian bobot evaluasi.</p>

                            <div class="row">


                                <div class="col-xl-12">
                                    <div class="mt-0">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                           
                                            <x-accordion.accordion id="1" title="Penjelasan Umum">
                                                <li>
                                                    Mata kuliah yang tercakup adalah mata kuliah yang dilaksanakan pada semester 2022 genap dan 2023 ganjil
                                                </li>
                                                <li>
                                                    Mata kuliah harus terdata pada kelas perkuliahan dan diikuti oleh mahasiswa
                                                </li>
                                                <li>
                                                    Perguruan tinggi mengumpulkan bukti berupa:
                                                </li>
                                                <div style="margin-left: 1.25rem">
                                                    <li>Rencana Pembelajaran Semester (RPS) tiap mata kuliah (mencakup rencana evaluasi) yang sudah dijalankan; atau</li>
                                                    <li>Rincian laporan hasil penilaian dan/atau rancangan atau modul tugas case method/team-based project.</li>
                                                </div>
                                                <li>
                                                    Minimal 50% bobot nilai akhir harus berdasarkan evaluasi case method dan/atau team-based project
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
                                                columnName="Nama Dosen" :sortBy="$sortBy"></x-datatable-items></th>
                                     
                                        <th wire:click="setsortBy('mata_kuliah')" class="sorting_asc">
                                            <x-datatable-items columnName="Mata Kuliah"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>
                                        <th wire:click="setsortBy('semester')" class="sorting_asc">
                                            <x-datatable-items columnName="Semester"
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
                                            <td>{{ $i->mata_kuliah }}</td>
                                            <td>{{ $i->semester }}</td>
                                            <td>{{ $i->bobot }}</td>
                                          
                                            

                                            <td>
                                                <div class="gap-2 d-flex">
                                                    <a href="{{ $i->link }}"
                                                        class="btn btn-sm btn-info waves-effect waves-light {{ $i->link ? '' : 'disabled' }}"
                                                        target="_blank"><i class="mdi mdi-file-document"></i></a>

                                                    <a wire:click="update({{ $i }})" id="btn-edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target=".bs-example-modal-center"
                                                        class="btn btn-sm btn-warning waves-effect waves-light btn-edit"
                                                        style="cursor: pointer;"
                                                        data-id="{{ $i->id }}"><i
                                                            class="mdi mdi-square-edit-outline "></i></a>
                                                    <a wire:click="deleteIku7({{ $i->id }})"
                                                        class="btn btn-sm btn-danger waves-effect waves-light"
                                                        style="cursor: pointer;">
                                                        <i class="mdi mdi-trash-can"></i>
                                                    </a>
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
                    <h5 class="modal-title"> {{ $mode == 'edit' ? 'Edit' : 'Tambah' }} Data IKU 7 | Data Pembelajaran
                    </h5>
                    <button type="button" wire:click="cancelEdit" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nama Dosen <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.nama" placeholder="Masukkan nama lengkap dosen">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Mata Kuliah <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.mata_kuliah" placeholder="Masukkan nama mata kuliah">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Semester <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.semester" placeholder="Contoh : 1">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Link RPS</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="example-text-input"
                                    wire:model="form.link" placeholder="Masukkan link google drive">
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


    {{-- Livewire script sudah diload di layout --}}

    {{-- <script>
        
        $('#myInputTextField').keyup(function() {
            oTable.search($(this).val()).draw();
        })
    </script> --}}
@endpush
