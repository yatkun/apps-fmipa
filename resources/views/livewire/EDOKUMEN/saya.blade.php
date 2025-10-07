@push('styles')
@endpush

@section('title', 'Dokumen Pribadi')

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
                    
                    <ul class="breadcrumb">
                        <li>Dokumen Pribadi</li>
                        <li>Pendidikan</li>
                      </ul>
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

                                            <!-- End Select -->
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target=".bs-example-modal-center"
                                            class=" btn btn-success waves-effect btn-label waves-light"><i
                                                class=" bx bx-plus label-icon"></i>Dokumen</button>

                                    </div>

                                </div>
                                <table id="example" class="table mt-3 table-bordered dt-responsive nowrap w-100"
                                    wire:key={{ uniqid() }}>
                                    <thead>
                                        <tr>

                                            <th style="width: 70%" wire:click="setsortBy('nama')" class="sorting_asc">
                                                <x-datatable-items columnName="Nama Dokumen"
                                                    :sortBy="$sortBy"></x-datatable-items>
                                            </th>

                                            <th style="width: 20%" wire:click="setsortBy('nama')" class="sorting_asc">
                                                <x-datatable-items columnName="Tanggal Upload"
                                                    :sortBy="$sortBy"></x-datatable-items>
                                            </th>
                                            <th style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @foreach ($a as $i)
                                            <tr>

                                                <td><i
                                                        class="align-middle {{ $i->icon }} font-size-16  me-2"></i>{{ $i->nama }}
                                                </td>
                                                <td>{{ $i->created_at->format('d-m-Y') }}</td>

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

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                      

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#pendidikan" role="tab" aria-selected="true">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Pendidikan</span> 
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#pengajaran" role="tab" aria-selected="false" tabindex="-1">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">Pengajaran</span> 
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#penelitian" role="tab" aria-selected="false" tabindex="-1">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">Penelitian</span>   
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#pengabdian" role="tab" aria-selected="false" tabindex="-1">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Pengabdian</span>    
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#kepangkatan" role="tab" aria-selected="false" tabindex="-1">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Kepangkatan</span>    
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#lain-lain" role="tab" aria-selected="false" tabindex="-1">
                                    <span class="d-block d-sm-none"><i class="fas fa-lock"></i></span>
                                    <span class="d-none d-sm-block">Lain-lain <i class="fas fa-lock"></i></span>    
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="p-0 tab-content text-muted">
                            <div class="tab-pane active show" id="pendidikan" role="tabpanel">
                                <p class="mb-0">
                                    <table id="example" class="table mt-3 table-bordered dt-responsive nowrap w-100"
                                    wire:key={{ uniqid() }}>
                                    <thead>
                                        <tr>

                                            <th style="width: 70%" wire:click="setsortBy('nama')" class="sorting_asc">
                                                <x-datatable-items columnName="Nama Dokumen"
                                                    :sortBy="$sortBy"></x-datatable-items>
                                            </th>

                                           
                                            <th style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @foreach ($a as $i)
                                            <tr>

                                                <td><i
                                                        class="align-middle {{ $i->icon }} font-size-16  me-2"></i>{{ $i->nama }}
                                                </td>
                                               

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
                                </p>
                            </div>
                            <div class="tab-pane" id="profile1" role="tabpanel">
                                <p class="mb-0">
                                    Food truck fixie locavore, accusamus mcsweeney's marfa nulla
                                    single-origin coffee squid. Exercitation +1 labore velit, blog
                                    sartorial PBR leggings next level wes anderson artisan four loko
                                    farm-to-table craft beer twee. Qui photo booth letterpress,
                                    commodo enim craft beer mlkshk aliquip jean shorts ullamco ad
                                    vinyl cillum PBR. Homo nostrud organic, assumenda labore
                                    aesthetic magna delectus.
                                </p>
                            </div>
                            <div class="tab-pane" id="messages1" role="tabpanel">
                                <p class="mb-0">
                                    Etsy mixtape wayfarers, ethical wes anderson tofu before they
                                    sold out mcsweeney's organic lomo retro fanny pack lo-fi
                                    farm-to-table readymade. Messenger bag gentrify pitchfork
                                    tattooed craft beer, iphone skateboard locavore carles etsy
                                    salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                                    Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                                    mi whatever gluten-free carles.
                                </p>
                            </div>
                            <div class="tab-pane" id="settings1" role="tabpanel">
                                <p class="mb-0">
                                    Trust fund seitan letterpress, keytar raw denim keffiyeh etsy
                                    art party before they sold out master cleanse gluten-free squid
                                    scenester freegan cosby sweater. Fanny pack portland seitan DIY,
                                    art party locavore wolf cliche high life echo park Austin. Cred
                                    vinyl keffiyeh DIY salvia PBR, banh mi before they sold out
                                    farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral,
                                    mustache readymade keffiyeh craft.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



        </div>
    </div>

    <div wire:ignore.self class="modal fade bs-example-modal-center" role="dialog" id="modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> {{ $mode == 'edit' ? 'Edit' : 'Tambah' }} Dokumen Pribadi
                    </h5>
                    <button type="button" wire:click="cancelEdit" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit="handleSaveOrUpdate">

                    <div>
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Nama Dokumen</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="example-text-input"
                                        wire:model="form.nama" placeholder="Masukkan nama dokumen" name="nama">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Pilih Dokumen</label>
                                <div class="col-md-10">
                                    @if ($existingFile)
                                        <p>File Saat Ini:
                                            

                                            <button wire:click="download('{{ $existingFile }}')" type="button" class="btn btn-sm btn-outline-info waves-effect waves-light">{{ basename($existingFile) }}</button>
                                        </p>
                                    @endif
                                    <input type="file" name="document" id="document"
                                        wire:model.defer="form.document" class="block w-full mt-1 form-control">
                                     
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">
                                <span wire:loading.remove>{{ $mode == 'edit' ? 'Update' : 'Upload' }}</span>
                                <span wire:loading><span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span> Proses Upload...</span>
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
    {{-- Livewire script sudah diload di layout --}}
@endpush
