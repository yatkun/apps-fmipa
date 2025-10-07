@section('title', 'Daftar Surat Menunggu Persetujuan')

<div class="main-content">
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
                            @if ($pendingLetters->hasPages())
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted">
                                        <small>
                                            <i class="bx bx-info-circle me-1"></i>
                                            Menampilkan {{ $pendingLetters->firstItem() ?? 0 }} -
                                            {{ $pendingLetters->lastItem() ?? 0 }}
                                            dari {{ $pendingLetters->total() }} surat
                                        </small>
                                    </div>
                                    <div class="d-flex gap-3 align-items-center">
                                        <small class="text-muted d-none d-md-block">
                                            {{ $perPage }} per halaman
                                        </small>
                                        <div>
                                            {{ $pendingLetters->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center">
                                    <small class="text-muted">
                                        <i class="bx bx-info-circle me-1"></i>
                                        {{ $pendingLetters->total() }} surat ditemukan
                                    </small>
                                </div>
                            @endif
                        @endslot
                    </livewire:components.modern-data-table>
                </div>
            </div>
        </div>
    </div>
</div>
