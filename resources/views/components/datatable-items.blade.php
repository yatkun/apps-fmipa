<div class="justify-content-between d-flex align-items-center">
    <div>{{ $columnName }}</div>
    @if ($sortBy !== $columnName)
    <x-heroicon-o-chevron-up-down  style="height: 24px; width: 24px"/>
    @elseif ($sortDir === 'DESC')
    <x-heroicon-o-chevron-down  style="height: 24px; width: 24px"/>
    @else
    <x-heroicon-o-chevron-up  style="height: 24px; width: 24px"/>
    @endif
   
</div>