@section('title', 'Daftar Surat yang Disetujui')

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
            <!-- Main Content -->
            <div class="row">
                <div class="col-12">
                    <!-- Using Modern Data Table Component -->
                    <livewire:components.modern-data-table
                        :title="$tableConfig['title']"
                        :subtitle="$tableConfig['subtitle']"
                        :search-placeholder="$tableConfig['searchPlaceholder']"
                        :columns="$tableConfig['columns']"
                        :data="$tableConfig['data']"
                        :row-view="$tableConfig['rowView']"
                        :empty-state-title="$tableConfig['emptyStateTitle']"
                        :empty-state-text="$tableConfig['emptyStateText']"
                        :empty-state-icon="$tableConfig['emptyStateIcon']"
                        :header-actions="$tableConfig['headerActions']"
                        :search="$search"
                        :per-page="$perPage"
                        :sort-by="$sortBy"
                        :sort-dir="$sortDir"
                    >
                        @slot('paginationSlot')
                            @if ($approvedLetters->hasPages())
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="table-info">
                                        Menampilkan {{ $approvedLetters->firstItem() ?? 0 }} - {{ $approvedLetters->lastItem() ?? 0 }} 
                                        dari {{ $approvedLetters->total() }} data
                                    </div>
                                    <div>
                                        {{ $approvedLetters->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            @else
                                <div class="text-center">
                                    <div class="table-info">
                                        {{ $approvedLetters->total() }} surat ditemukan
                                    </div>
                                </div>
                            @endif
                        @endslot
                    </livewire:components.modern-data-table>
                </div>
            </div>
        </div>
    </div>
</div>
