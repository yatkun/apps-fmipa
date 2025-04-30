import './bootstrap';


document.addEventListener("livewire:navigated", () => {
    console.log("Livewire navigated event triggered");
    $('#datatable').DataTable();
    Livewire.start();
    console.log('Livewire has started');
});

    
