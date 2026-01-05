<div class="dropdown d-inline-block ms-2">
    <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bx bx-calendar"></i>
        <span class="ms-2">
            @if($selectedPeriod == 'all')
                Semua Periode
            @else
                @php
                    $period = $periods->find($selectedPeriod);
                @endphp
                {{ $period?->name ?? 'Pilih Periode' }}
            @endif
        </span>
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        <h6 class="dropdown-header">Pilih Periode</h6>
        <a class="dropdown-item {{ $selectedPeriod == 'all' ? 'active' : '' }}" href="#" wire:click.prevent="selectPeriod('all')">
            Semua Periode
        </a>
        <div class="dropdown-divider"></div>
        @foreach($periods as $period)
            <a class="dropdown-item {{ $selectedPeriod == $period->id ? 'active' : '' }}" href="#" wire:click.prevent="selectPeriod({{ $period->id }})">
                {{ $period->name }} ({{ $period->year_start }}/{{ $period->year_end }})
            </a>
        @endforeach
    </div>
</div>
