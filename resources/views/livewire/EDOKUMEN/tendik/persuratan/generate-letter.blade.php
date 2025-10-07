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


            <div>
                <h2 class="mb-4">Buat Surat: {{ $template->name }}</h2>

                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form wire:submit.prevent="generate">
                    {{-- Input untuk placeholder umum --}}
                    @if ($template->placeholders)
                        <div class="mb-4 card">
                            <div class="card-header">
                                Data Umum Surat
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($template->placeholders as $placeholder)
                                        <div class="mb-3 col-md-6">
                                            @if ($placeholder == 'tanggal_surat')
                                                <label for="{{ $placeholder }}"
                                                    class="form-label">{{ ucfirst(str_replace('_', ' ', $placeholder)) }}</label>
                                                <input type="date" class="form-control" id="{{ $placeholder }}"
                                                    wire:model.defer="formData.{{ $placeholder }}">
                                                @if (isset($placeholderHints[$placeholder]) && !empty($placeholderHints[$placeholder]))
                                                    <small class="text-muted">Contoh :
                                                        {{ $placeholderHints[$placeholder] }}</small>
                                                @endif
                                            @elseif ($placeholder == 'qr_code')
                                              
                                            @else
                                                <label for="{{ $placeholder }}"
                                                    class="form-label">{{ ucfirst(str_replace('_', ' ', $placeholder)) }}</label>
                                                <input type="text" class="form-control" id="{{ $placeholder }}"
                                                    wire:model.defer="formData.{{ $placeholder }}">
                                                @if (isset($placeholderHints[$placeholder]) && !empty($placeholderHints[$placeholder]))
                                                    <small class="text-muted">Contoh :
                                                        {{ $placeholderHints[$placeholder] }}</small>
                                                @endif
                                            @endif


                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Input untuk tabel dinamis --}}
                    @if ($template->dynamic_table_marker && !empty($template->table_placeholders))
                        <div class="mb-4 card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="card-title">Tabel Dinamis</div>
                                <button type="button" wire:click="addTableRow" class="btn btn-sm btn-primary">Tambah
                                    Baris</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                @foreach ($template->table_placeholders as $ph)
                                                    <th>
                                                        {{ ucfirst(str_replace('_', ' ', $ph)) }}
                                                        @if (isset($placeholderHints[$ph]) && !empty($placeholderHints[$ph]))
                                                            <br><small class="text-muted">Contoh :
                                                                {{ $placeholderHints[$ph] }}</small>
                                                        @endif
                                                    </th>
                                                @endforeach
                                                <th style="width: 50px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tableData as $index => $rowData)
                                                <tr>
                                                    @foreach ($template->table_placeholders as $ph)
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm"
                                                                wire:model.defer="tableData.{{ $index }}.{{ $ph }}">
                                                        </td>
                                                    @endforeach
                                                    <td>
                                                        <button type="button"
                                                            wire:click="removeTableRow({{ $index }})"
                                                            class="btn btn-sm btn-danger">X</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="mt-4 btn btn-success">Buat Surat</button>

                    @if ($generatedFilePath)
                        <a href="{{ Storage::url($generatedFilePath) }}" target="_blank" class="mt-4 btn btn-info ms-2"
                            download>Unduh Surat</a>
                    @endif
                </form>
            </div>



        </div>
    </div>



</div>


<!-- Script untuk Handle Notifikasi dan Loading -->


@push('scripts')
    {{-- Livewire script sudah diload di layout --}}
@endpush
