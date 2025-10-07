@push('styles')
    <style>
        .modern-datatable {
            background: white;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            overflow: hidden;
        }

        .search-controls {
            background: #f8f9fa;
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding-left: 2.5rem;
        }

        .search-box .s-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1rem;
        }

        .modern-table {
            margin: 0;
            font-size: 0.875rem;
        }

        .modern-table thead th {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 0.75rem;
            font-weight: 600;
            color: #495057;
            font-size: 0.875rem;
            vertical-align: middle;
            cursor: pointer;
        }

        .modern-table thead th:hover {
            background: #e9ecef;
        }

        .modern-table tbody td {
            padding: 0.75rem;
            border-bottom: 1px solid #efefef;
            vertical-align: middle;
            font-size: 0.875rem;
        }

        .modern-table tbody tr:hover {
            background: #f8f9fa;
        }

        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-pending {
            background: #ffc107;
            color: #212529;
        }

        .status-approved {
            background: #198754;
            color: white;
        }

        .status-rejected {
            background: #dc3545;
            color: white;
        }

        .ava-sm {
            height: 2rem;
            width: 2rem;
        }

        .action-btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .btn-view {
            background: #0d6efd;
            color: white;
            border: 1px solid #0d6efd;
        }

        .btn-view:hover {
            background: #0b5ed7;
            color: white;
        }

        .action-btn-success {
            background: #198754;
            color: white;
            border: 1px solid #198754;
        }

        .action-btn-success:hover {
            background: #157347;
            color: white;
        }

        .sortable-column {
            user-select: none;
        }

        .sort-icon {
            margin-left: 0.5rem;
            opacity: 0.5;
            font-size: 0.875rem;
        }

        .sort-icon.active {
            opacity: 1;
            color: #0d6efd;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #6c757d;
        }

        .empty-state-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #dee2e6;
        }

        .empty-state-icon i {
            font-size: 1.5rem;
            color: #6c757d;
        }

        .empty-state-title {
            color: #495057;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.125rem;
        }

        .empty-state-text {
            color: #6c757d;
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 1rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .page-title {
            color: #212529;
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }

        .page-subtitle {
            color: #6c757d;
            font-size: 0.875rem;
            margin-bottom: 0;
        }

        .badge-info-modern {
            background: #0d6efd;
            color: white;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }

        .table-info {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .pagination-wrapper {
            padding: 1rem;
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }

        .fade-in {
            animation: fadeInUp 0.3s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Loading overlay */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            border-radius: 8px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .search-controls {
                padding: 0.75rem;
            }

            .search-controls .row>div {
                margin-bottom: 0.75rem;
            }

            .modern-table {
                font-size: 0.8125rem;
            }

            .modern-table thead th,
            .modern-table tbody td {
                padding: 0.5rem;
            }

            .page-title {
                font-size: 1.25rem;
            }
        }
    </style>
@endpush

<div class="modern-datatable fade-in {{ $containerClass }}">
    <!-- Page Header (Optional) -->
    @if ($showHeader && ($title || $subtitle || count($headerActions) > 0))
        <div class="p-3 bg-white border-bottom">
            <div class="d-flex align-items-center justify-content-between">
                @if ($title || $subtitle)
                    <div>
                        @if ($title)
                            <h4 class="page-title">{{ $title }}</h4>
                        @endif
                        @if ($subtitle)
                            <p class="page-subtitle">{{ $subtitle }}</p>
                        @endif
                    </div>
                @endif
                
                @if (count($headerActions) > 0)
                    <div class="d-flex gap-2">
                        @foreach ($headerActions as $action)
                            {!! $action !!}
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Search and Filter Controls -->
    @if ($showSearch || $showPerPage)
        <div class="search-controls">
            <div class="row align-items-center">
                @if ($showSearch)
                    <div class="col-lg-{{ $showPerPage ? '10' : '12' }}">
                        <div class="search-box">
                            <input type="search" 
                                   wire:model.live.debounce.300ms="search"
                                   class="form-control"
                                   placeholder="{{ $searchPlaceholder }}">
                            <i class="bx bx-search s-icon"></i>
                        </div>
                    </div>
                @endif
                
                @if ($showPerPage)
                    <div class="col-lg-{{ $showSearch ? '2' : '12' }}">
                        <div class="d-flex align-items-center justify-content-{{ $showSearch ? 'end' : 'start' }}">
                            <select class="form-select" wire:model.live='perPage'>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Data Table -->
    <div class="table-responsive">
        <table class="table modern-table {{ $tableClass }}" wire:key="{{ uniqid() }}">
            @if (count($columns) > 0)
                <thead>
                    <tr>
                        @foreach ($columns as $column)
                            <th 
                                @if (isset($column['sortable']) && $column['sortable'])
                                    wire:click="setSortBy('{{ $column['field'] ?? '' }}')" 
                                    class="sortable-column"
                                @endif
                                @if (isset($column['width']))
                                    style="width: {{ $column['width'] }}"
                                @endif
                            >
                                <div class="d-flex align-items-center">
                                    @if (isset($column['icon']))
                                        <i class="{{ $column['icon'] }} me-2 text-muted"></i>
                                    @endif
                                    {{ $column['label'] ?? '' }}
                                    
                                    @if (isset($column['sortable']) && $column['sortable'])
                                        @if ($sortBy === ($column['field'] ?? ''))
                                            <i class="bx bx-{{ $sortDir === 'ASC' ? 'up' : 'down' }}-arrow-alt sort-icon active"></i>
                                        @else
                                            <i class="bx bx-sort-alt-2 sort-icon"></i>
                                        @endif
                                    @endif
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
            @endif
            
            <tbody>
                @forelse ($data as $row)
                    @if ($rowView)
                        @include($rowView, array_merge(['row' => $row], $rowData))
                    @else
                        {{ $slot }}
                    @endif
                @empty
                    <tr>
                        <td colspan="{{ count($columns) }}" class="py-5 text-center">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    @if ($search)
                                        <i class="bx bx-search-alt-2"></i>
                                    @else
                                        <i class="{{ $emptyStateIcon }}"></i>
                                    @endif
                                </div>
                                <h5 class="empty-state-title">
                                    @if ($search)
                                        Pencarian Tidak Ditemukan
                                    @else
                                        {{ $emptyStateTitle }}
                                    @endif
                                </h5>
                                <p class="empty-state-text">
                                    @if ($search)
                                        Tidak ada data yang cocok dengan "<strong>{{ $search }}</strong>".
                                        <br>Coba kata kunci lain atau hapus filter pencarian.
                                    @else
                                        {{ $emptyStateText }}
                                    @endif
                                </p>
                                @if ($search)
                                    <button class="btn btn-outline-primary btn-sm mt-3"
                                            wire:click="$set('search', '')">
                                        <i class="bx bx-x me-1"></i>
                                        Hapus Pencarian
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination (Slot untuk custom pagination) -->
    @if ($showPagination)
        <div class="pagination-wrapper">
            {{ $paginationSlot ?? '' }}
        </div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search input loading indicator
            const searchInput = document.querySelector('input[wire\\:model\\.live\\.debounce\\.300ms="search"]');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchBox = this.closest('.search-box');
                    const icon = searchBox.querySelector('.s-icon');

                    // Show loading
                    icon.className = 'bx bx-loader-alt bx-spin s-icon';

                    // Reset after delay
                    setTimeout(() => {
                        icon.className = 'bx bx-search s-icon';
                    }, 500);
                });
            }
        });

        // Livewire event listeners
        document.addEventListener('livewire:init', function() {
            // Table loading
            Livewire.hook('message.sent', () => {
                const tableContainer = document.querySelector('.table-responsive');
                if (tableContainer && !tableContainer.querySelector('.loading-overlay')) {
                    const loadingOverlay = document.createElement('div');
                    loadingOverlay.className = 'loading-overlay';
                    loadingOverlay.innerHTML = `
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="spinner-border text-primary me-2" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <span class="text-muted">Memuat data...</span>
                        </div>
                    `;
                    tableContainer.style.position = 'relative';
                    tableContainer.appendChild(loadingOverlay);
                }
            });

            Livewire.hook('message.processed', () => {
                const loadingOverlay = document.querySelector('.loading-overlay');
                if (loadingOverlay) {
                    loadingOverlay.remove();
                }
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.querySelector('input[wire\\:model\\.live\\.debounce\\.300ms="search"]');
                if (searchInput) {
                    searchInput.focus();
                    searchInput.select();
                }
            }
        });
    </script>
@endpush
