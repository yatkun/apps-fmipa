<div>
    
    @if (session('success'))
    @include('livewire.includes.alert-success', [
        'header' => 'Sukses',
    ])
@endif
</div>

<script data-navigate-once>
    document.addEventListener("livewire:navigated", () => {
        console.log('nav');
        window.HSStaticMethods.autoInit();
    });
</script>