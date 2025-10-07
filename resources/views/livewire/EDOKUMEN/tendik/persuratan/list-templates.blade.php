@push('styles')
@endpush

@section('title', 'Dokumen Pribadi')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Daftar Template Surat</h4>


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
                                        <div class="btn-group">
                                            <a wire:navigate href="{{ route('admin.upload.template') }}"
                                                class="btn btn-primary" aria-expanded="false">Upload Template</a>
                                        </div>
                                        {{-- <a href="{{ route('dokumen.tandai.upload') }}" wire:navigate
                                            class=" btn btn-success waves-effect btn-label waves-light"><i
                                                class=" bx bx-plus label-icon"></i>Dokumen</a> --}}
                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table id="example" class="table mt-3 table-bordered"
                                        wire:key={{ uniqid() }}>
                                        <thead>
                                            <tr>

                                                <th style="width: 70%" wire:click="setsortBy('name')"
                                                    class="sortable-column sorting_asc">
                                                    <x-datatable-items columnName="Nama Dokumen"
                                                        :sortBy="$sortBy"></x-datatable-items>
                                                </th>
                                                <th style="width: 20%" wire:click="setsortBy('created_at')"
                                                    class="sortable-column sorting_asc">
                                                    <x-datatable-items columnName="Tanggal Unggah"
                                                        :sortBy="$sortBy"></x-datatable-items>
                                                </th>
                                                <th style="width: 10%">Aksi</th>
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @forelse ($templates as $template)
                                                <tr>

                                                    <td>{{ $template->name }}</td>

                                                    <td>{{ $template->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <ul class="gap-1 mb-0 list-unstyled hstack">


                                                            <li>
                                                                <a wire:navigate
                                                                    href="{{ route('generate.letter', $template->id) }}"
                                                                    class="btn btn-sm btn-soft-success">
                                                                    <i class="mdi mdi-pencil"></i></a>
                                                            </li>
                                                            <li>
                                                                <button wire:click="downloadTemplate({{ $template->id }})"
                                                                    class="btn btn-sm btn-soft-primary">
                                                                    <i class="mdi mdi-download"></i></button>
                                                            </li>
                                                            <li>
                                                                <a wire:click="deleteTemplate({{ $template->id }})"
                                                                    class="btn btn-sm btn-soft-danger"
                                                                    wire:confirm="Anda yakin ingin menghapus template ini? Ini akan menghapus file template juga."><i
                                                                        class="mdi mdi-trash-can"></i></a>
                                                            </li>
                                                            <li><a href="{{ route('templates.set-hints', ['templateId' => $template->id]) }}"
                                                                    class="btn btn-sm btn-soft-info"><i
                                                                        class="mdi mdi-cog"></i></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Template Tidak Ditemukan</td>
                                                </tr>
                                            @endforelse


                                        </tbody>
                                    </table>
                                </div>
                                <div class="">
                                    {{ $templates->links('pagination::bootstrap-5') }}


                                </div>
                            </div>

                        </div><!--end card-->
                    </div><!--end col-->


                </div>

            </div>

        </div>
    </div>



</div>


<!-- Script untuk Handle Notifikasi dan Loading -->


@push('scripts')
    {{-- Livewire script sudah diload di layout --}}
@endpush
