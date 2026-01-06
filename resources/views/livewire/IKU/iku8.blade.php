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
                            <h4 class="mb-0 card-title">IKU 8 : Akreditasi Internasional
                            </h4>
                            <p class="card-title-desc">Persentase program studi S1 dan D4/D3 yang memiliki akreditasi
                                atau sertifikasi internasional yang diakui pemerintah.</p>

                            <div class="row">


                                <div class="col-xl-12">
                                    <div class="mt-0">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">

                                            <x-accordion.accordion id="1"
                                                title="Kriteria Akreditasi dan Sertifikasi">
                                                <li>
                                                    Lembaga akreditasi atau sertifikasi internasional yang diakui oleh
                                                    Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi.
                                                </li>
                                                <li>
                                                    Program studi Kedokteran yang memiliki peringkat akreditasi Unggul
                                                    dari LAM PT-KES dapat dihitung sebagai program studi terakreditasi
                                                    Internasional.
                                                </li>
                                                <li>
                                                    Akreditasi atau sertifikasi internasional yang dihitung adalah yang
                                                    masih berlaku pada tahun perhitungan IKU
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

            <!-- Data Table -->
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
                                        <select class="form-select" wire:model.live='perPage'>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <button type="button" data-bs-toggle="modal" wire:click="modes"
                                        data-bs-target=".iku8modal"
                                        class="mb-2 btn btn-success waves-effect btn-label waves-light"><i
                                            class=" bx bx-check-double label-icon"></i> Tambah Data</button>
                                </div>
                            </div>

                            <table id="example" class="table table-bordered dt-responsive nowrap w-100"
                                wire:key={{ uniqid() }}>
                                <thead>
                                    <tr>
                                        <th>No</th>

                                        <th wire:click="setsortBy('program_studi')" class="sorting_asc">
                                            <x-datatable-items columnName="Program Studi"
                                                :sortBy="$sortBy"></x-datatable-items>
                                        </th>

                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @forelse ($iku8 as $i)
                                        <tr>
                                            <td>{{ $no++ }}</td>

                                            <td>{{ $i->program_studi }}</td>

                                            <td>
                                                <div class="gap-2 d-flex">
                                                    <a href="{{ $i->bukti }}"
                                                        class="btn btn-sm btn-info waves-effect waves-light {{ $i->bukti ? '' : 'disabled' }}"
                                                        target="_blank"><i class="mdi mdi-file-document"></i></a>

                                                    <button wire:click="edit({{ $i->id }})" type="button"
                                                        data-bs-toggle="modal" data-bs-target=".iku8modal"
                                                        class="btn btn-sm btn-primary waves-effect waves-light">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>

                                                    <button wire:click="delete({{ $i->id }})"
                                                        class="btn btn-sm btn-danger waves-effect waves-light">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example_info" role="status" aria-live="polite">
                                        Showing {{ $iku8->firstItem() ?? 0 }} to
                                        {{ $iku8->lastItem() ?? 0 }} of {{ $iku8->total() }} entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers">
                                        {{ $iku8->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
        <!-- Modal -->
        <div wire:ignore.self class="modal fade iku8modal" role="dialog" id="modal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $mode == 'edit' ? 'Edit' : 'Tambah' }} Data IKU 8 | Akreditasi
                            Internasional</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form wire:submit="handleSaveOrUpdate">
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="program_studi" class="col-md-3 col-form-label">Program Studi <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="program_studi"
                                        wire:model="form.program_studi" placeholder="Masukkan program studi">
                                    @error('form.program_studi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="bukti" class="col-md-3 col-form-label">Bukti (Link)</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="url" id="bukti"
                                        wire:model="form.bukti" placeholder="Masukkan link bukti">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" wire:submit="handleSaveOrUpdate" wire:loading.attr="disabled"
                                class="btn btn-primary">{{ $mode == 'edit' ? 'Update' : 'Simpan' }}</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
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


            {{-- Livewire script sudah diload di layout --}}

            {{-- <script>
        
        $('#myInputTextField').keyup(function() {
            oTable.search($(this).val()).draw();
        })
    </script> --}}
        @endpush
