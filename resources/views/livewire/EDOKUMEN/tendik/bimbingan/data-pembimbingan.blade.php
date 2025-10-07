@push('styles')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
@endpush

@section('title', 'Dokumen Pembimbingan Mahasiswa')

<div class="main-content">
   
    <div class="page-content">
        <div class="container-fluid">
          
          

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body border-bottom">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 card-title flex-grow-1">Data Pembimbingan</h5>
                                <div class="flex-shrink-0">
                                
                                    <a wire:navigate href="{{ route('tendik.tambah.pembimbingan') }}"
                                            class=" btn btn-success waves-effect btn-label waves-light"><i
                                                class=" bx bx-plus label-icon"></i>Tambah Data</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            
                            <div wire:ignore>
                            <table  id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>No</th>
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
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($a as $i)
                                    <tr>
                                        <td>{{ $no++ }}</td>
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
                                            <ul class="gap-1 mb-0 list-unstyled hstack">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Download">
                                                    <a wire:click="download({{ $i->id }})"
                                                        target="_blank" class="btn btn-sm btn-soft-primary"><i
                                                            wire:loading.remove
                                                            wire:target="download({{ $i->id }})"
                                                            class="mdi mdi-download-box-outline"></i>
                                                        <span wire:loading
                                                            wire:target="download({{ $i->id }})"><span
                                                                class="spinner-border spinner-border-sm"
                                                                role="status"
                                                                aria-hidden="true"></span></span></a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit">
                                                    <a href="{{ route('tendik.edit.pembimbingan', \Vinkla\Hashids\Facades\Hashids::encode($i->id)) }}"
                                                        class="btn btn-sm btn-soft-info"
                                                        data-id="{{ $i->id }}">
                                                        <i class="mdi mdi-pencil-outline"></i>
                                                     </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Hapus">
                                                    <a href="javascript:void(0);" wire:loading.attr="disabled"
                                                        onclick="if (confirm('Apakah Anda yakin ingin menghapus dokumen ini?')) @this.delete({{ $i->id }})"
                                                        class="btn btn-sm btn-soft-danger">
                                                        <i wire:loading.remove
                                                            wire:target="delete({{ $i->id }})"
                                                            class="mdi mdi-delete-outline"></i>
                                                        <span wire:loading
                                                            wire:target="delete({{ $i->id }})"><span
                                                                class="spinner-border spinner-border-sm"
                                                                role="status" aria-hidden="true"></span></span>
                                                    </a>

                                                </li>
                                            </ul>
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


</div>


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
    {{-- Livewire script sudah diload di layout --}}
@endpush
