@push('styles')
@endpush

@section('title', 'Dokumen Pribadi')

<div class="main-content">
    @if (session('success'))
        @include('livewire.includes.alert-success', [
            'header' => 'Sukses',
        ])
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="page-content">
        <div class="container-fluid">

            <div>
               

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Daftar Surat yang Disetujui</h4>


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
                                    </div>
                                    <table id="example" class="table mt-3 table-bordered dt-responsive nowrap w-100"
                                        wire:key={{ uniqid() }}>
                                        <thead>


                                            <tr>
                                                <th style="width: 50%" wire:click="setsortBy('template_name')"
                                                    class="sortable-column sorting_asc">
                                                    <x-datatable-items columnName="Nama Surat"
                                                        :sortBy="$sortBy"></x-datatable-items>
                                                </th>
                                                <th style="width: 20%" wire:click="setsortBy('created_at')"
                                                    class="sortable-column sorting_asc">
                                                    <x-datatable-items columnName="Tanggal Dibuat"
                                                        :sortBy="$sortBy"></x-datatable-items>
                                                </th>
                                                <th style="width: 20%" wire:click="setsortBy('created_at')"
                                                    class="sortable-column sorting_asc">
                                                    <x-datatable-items columnName="Tanggal Disetujui"
                                                        :sortBy="$sortBy"></x-datatable-items>
                                                </th>
                                                <th style="width: 10%">Aksi</th>
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @forelse ($approvedLetters as $letter)
                                                <tr>
                                                    <td>{{ $letter->template->name ?? 'N/A' }}</td>
                                                    <td>{{ $letter->created_at->format('d M Y') }}</td>

                                                    <td>{{ $letter->approved_at ? $letter->approved_at->format('d M Y') : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        <button wire:click="downloadLetter({{ $letter->id }})"
                                                            wire:loading.attr="disabled"
                                                            wire:target="downloadLetter({{ $letter->id }})"
                                                            class="btn btn-sm btn-soft-success">
                                                            <span wire:loading.remove wire:target="downloadLetter({{ $letter->id }})">
                                                                <i class="fas fa-download"></i> Unduh
                                                            </span>
                                                            <span wire:loading wire:target="downloadLetter({{ $letter->id }})">
                                                                <i class="fas fa-spinner fa-spin"></i> Mengunduh...
                                                            </span>
                                                        </button>
                                                        
                                                      
                                                        
                                                        {{-- Jika Anda ingin fitur lihat detail, bisa tambahkan rute baru --}}
                                                        {{-- <a wire:navigate href="{{ route('view.approved.letter', $letter->id) }}" class="btn btn-sm btn-info">Lihat Detail</a> --}}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada surat yang telah
                                                        disetujui.</td>
                                                </tr>
                                            @endforelse

                                            {{-- @foreach ($templates as $template)
                                            <tr>

                                                <td>{{ $template->name }}</td>
                                                
                                                <td>{{ $template->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <ul class="gap-1 mb-0 list-unstyled hstack">
                                                       

                                                        <li >
                                                            <a wire:navigate
                                                                href="{{ route('generate.letter', $template->id) }}"
                                                                class="btn btn-sm btn-soft-success">
                                                                <i class="mdi mdi-pencil"></i></a>
                                                        </li>
                                                        <li >
                                                            <a wire:navigate
                                                                href="{{ route('generate.letter', $template->id) }}"
                                                                class="btn btn-sm btn-soft-primary">
                                                                <i class="mdi mdi-download"></i></a>
                                                        </li>
                                                        <li >
                                                            <a wire:click="deleteTemplate({{ $template->id }})" class="btn btn-sm btn-soft-danger"
                                                                wire:confirm="Anda yakin ingin menghapus template ini? Ini akan menghapus file template juga."><i class="mdi mdi-trash-can"></i></a>
                                                        </li>
                                                      
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach --}}


                                        </tbody>
                                    </table>
                                    
                                    <!-- Pagination -->
                                    <div class="mt-3">
                                        {{ $approvedLetters->links('pagination::bootstrap-5') }}
                                    </div>

                                </div>

                            </div><!--end card-->
                        </div><!--end col-->


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Script untuk Handle Notifikasi dan Loading -->


@push('scripts')
    <script src="{{ asset('assets/js/livewire.js') }}" data-navigate-track></script>
@endpush
