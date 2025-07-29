<style>
    .sortable-column {
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .sortable-column:hover {
        background-color: #f6f6f6;
    }
</style>


<div class="px-1 py-1 d-flex justify-content-between align-items-center w-100">
    <span class="fw-semibold text-capitalize">{{ $columnName }}</span>

    @if ($sortBy !== $columnName)
        <x-heroicon-o-chevron-up-down class="text-secondary" style="width: 20px; height: 20px;" />
    @elseif ($sortDir === 'DESC')
        <x-heroicon-o-chevron-down class="text-primary" style="width: 20px; height: 20px;" />
    @else
        <x-heroicon-o-chevron-up class="text-primary" style="width: 20px; height: 20px;" />
    @endif
</div>
