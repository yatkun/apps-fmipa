@push('styles')
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
                        <h4 class="mb-sm-0 font-size-18">Daftar Pengguna</h4>



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
                                                    placeholder="Cari Pengguna...">
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

                                            <!-- End Select -->
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target=".bs-example-modal-center"
                                            class=" btn btn-success waves-effect btn-label waves-light"><i
                                                class=" bx bx-plus label-icon"></i>Pengguna</button>

                                    </div>

                                </div>
                                <table id="example" class="table mt-3 table-bordered dt-responsive nowrap w-100"
                                    wire:key={{ uniqid() }}>
                                    <thead>
                                        <tr>
                                            <th>No</th>

                                            <th style="width: 50%" wire:click="setsortBy('name')" class="sorting_asc">
                                                <x-datatable-items columnName="Nama Pengguna"
                                                    :sortBy="$sortBy"></x-datatable-items>
                                            </th>

                                            <th style="width: 20%" wire:click="setsortBy('username')" class="sorting_asc">
                                                <x-datatable-items columnName="Username"
                                                    :sortBy="$sortBy"></x-datatable-items>
                                            </th>

                                            <th style="width: 20%" wire:click="setsortBy('email')" class="sorting_asc">
                                                <x-datatable-items columnName="Email"
                                                    :sortBy="$sortBy"></x-datatable-items>
                                            </th>

                                            <th style="width: 20%" wire:click="setsortBy('level')" class="sorting_asc">
                                                <x-datatable-items columnName="Level"
                                                    :sortBy="$sortBy"></x-datatable-items>
                                            </th>

                                            <th style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($a as $i)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $i->name }}</td>
                                                <td>{{ $i->username }}</td>
                                                <td>{{ $i->email }}</td>
                                                <td>{{ $i->level }}</td>

                                                <td>
                                                    <ul class="gap-1 mb-0 list-unstyled hstack">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Download">
                                                            <a wire:click="download({{ $i->id }})"
                                                                target="_blank" class="btn btn-sm btn-soft-primary"><i wire:loading.remove wire:target="download({{ $i->id }})"
                                                                    class="mdi mdi-download-box-outline"></i>
                                                                    <span wire:loading wire:target="download({{ $i->id }})"><span class="spinner-border spinner-border-sm" role="status"
                                                                        aria-hidden="true"></span></span></a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Edit">
                                                            <a wire:click="update({{ $i }})" id="btn-edit"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bs-example-modal-center"
                                                                class="btn btn-sm btn-soft-info"
                                                                data-id="{{ $i->id }}"><i
                                                                    class="mdi mdi-pencil-outline"></i></a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Hapus">
                                                            <a href="javascript:void(0);" wire:loading.attr="disabled"
                                                                onclick="if (confirm('Apakah Anda yakin ingin menghapus dokumen ini?')) @this.delete({{ $i->id }})"
                                                                class="btn btn-sm btn-soft-danger">
                                                                <i wire:loading.remove wire:target="delete({{ $i->id }})" class="mdi mdi-delete-outline"></i>
                                                            <span wire:loading wire:target="delete({{ $i->id }})"><span class="spinner-border spinner-border-sm" role="status"
                                                                aria-hidden="true"></span></span>
                                                            </a>
                                                            
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="">
                                  
                                    {{ $a->links('pagination::bootstrap-5') }}
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
                    <h5 class="modal-title"> {{ $mode == 'edit' ? 'Edit' : 'Tambah' }} Pengguna
                    </h5>
                    <button type="button" wire:click="cancelEdit" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit="handleSaveOrUpdate">

                    <div>
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Nama Lengkap</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="example-text-input"
                                        wire:model="name" placeholder="Masukkan nama lengkap" name="name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="example-text-input"
                                        wire:model="email" placeholder="Masukkan Email" name="email">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">NIP/NIDN/NIDK</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="example-text-input"
                                        wire:model="username" placeholder="Masukkan NIP/NIDN/NIDK" name="username">
                                </div>
                            </div>
                            
                            @if ($mode == 'add')
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Password</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="example-text-input"
                                        wire:model="password" placeholder="Masukkan Password" name="password">
                                </div>
                            </div>
                            @endif
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Level</label>
                                <div class="col-md-10">
                                    <select class="form-select" name="level" wire:model.change="level" required>
                                        <option selected value="">Pilih Level</option>
                                        <option name="level" value="Dosen">Dosen</option>
                                        <option name="level" value="Tendik">Tendik</option>
                                   
                                    </select>
                                </div>
                            </div>
                          

                        </div>
                        <div class="modal-footer">
                            <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">
                                <span wire:loading.remove>{{ $mode == 'edit' ? 'Update' : 'Simpan' }}</span>
                                <span wire:loading><span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>Menyimpan pengguna...</span>
                            </button>


                            <button wire:click="cancelEdit" type="button" class="btn btn-secondary"
                                wire:loading.attr="disabled" data-bs-dismiss="modal">Batal</button>
                        </div>

                    </div>
                </form>




            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- Overlay Loading -->

</div>


<!-- Script untuk Handle Notifikasi dan Loading -->


@push('scripts')
    <script src="{{ asset('assets/js/livewire.js') }}" data-navigate-track></script>
   
@endpush

