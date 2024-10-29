<div>
    
    @if (session('success'))
    @include('livewire.includes.alert-success', [
        'header' => 'Sukses',
    ])
@endif
</div>