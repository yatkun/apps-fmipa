@push('styles')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@section('title', 'Dokumen Pendidikan | Bimbingan Mahasiswa')

<div class="main-content">
   
    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Data Pembimbingan</h4>
                            <div wire:ignore>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Nama Mahasiswa</th>
                                            <th>NIM</th>
                                            <th>Program Studi</th>
                                            <th>Angkatan</th>
                                            <th>Pembimbing 1</th>
                                            <th>Pembimbing 2</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($a as $i)
                                            <tr>

                                                <td>{{ $i->nama }}
                                                </td>
                                                <td>{{ $i->nim }}
                                                </td>
                                                <td>{{ $i->prodi }}
                                                </td>
                                                <td>{{ $i->angkatan }}
                                                </td>
                                                <td>{{ $i->pembimbingSatu->name }}
                                                </td>
                                                <td>{{ $i->pembimbingDua->name }}
                                                </td>
                                                <td>
                                                    {{-- <a wire:click="lihat({{ $i }})" class="btn btn-primary waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">Lihat data</a>
                                             --}}
                                                    {{-- <a wire:click="lihat({{ $i }})" class="btn btn-soft-primary waves-effect waves-light btn-sm">
                                                <i class="align-middle mdi mdi-download"></i> Dokumen
                                            </a> --}}

                                                    <a wire:click="download({{ $i->id }})" target="_blank"
                                                        class="btn btn-soft-primary waves-effect waves-light btn-sm"><div
                                                            class="align-middle mdi mdi-download" wire:loading.remove
                                                            wire:target="download({{ $i->id }})"> Dokumen</div>
                                                        <span wire:loading
                                                            wire:target="download({{ $i->id }})"><span
                                                                class="bx bx-loader bx-spin" role="status"
                                                                aria-hidden="true"></span> Dokumen</span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->




        </div>
    </div>

    <div wire:ignore.self class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Pembimbingan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table mb-0 table-hover">


                            <tbody>
                                <tr>
                                    <td>Nama Mahasiswa</td>
                                    <td>{{ $nama }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>{{ $nim }}</td>
                                </tr>
                                <tr>
                                    <td>Program Studi</td>
                                    <td>{{ $prodi }}</td>
                                </tr>
                                <tr>
                                    <td>Angkatan</td>
                                    <td>{{ $angkatan }}</td>
                                </tr>
                                <tr>
                                    <td>Judul</td>
                                    <td>{{ $judul }}</td>
                                </tr>
                                <tr>
                                    <td>Pembimbing 1</td>
                                    <td>{{ $pembimbing_1 }}</td>
                                </tr>
                                <tr>
                                    <td>Pembimbing 2</td>
                                    <td>{{ $pembimbing_2 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>

{{-- modal --}}



<!-- Script untuk Handle Notifikasi dan Loading -->


@push('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/modal.init.js') }}"></script>
    <script src="{{ asset('assets/js/livewire.js') }}" data-navigate-track></script>
@endpush
