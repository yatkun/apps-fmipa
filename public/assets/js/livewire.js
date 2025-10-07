// Global Livewire event listeners - Livewire 3 syntax
document.addEventListener('livewire:init', () => {
    console.log('Livewire initialized - livewire.js');
    
    // Listen for notification events
    Livewire.on('notif', () => {
        setTimeout(() => {
            const alertBox = document.getElementById('custom-alert');

            if (alertBox) {
                alertBox.style.display = 'flex';
                alertBox.classList.remove('hidden');
                alertBox.classList.add('fade-in');

                setTimeout(() => {
                    alertBox.classList.remove('fade-in');
                    alertBox.classList.add('fade-out-up');
                    
                    setTimeout(() => {
                        alertBox.style.display = 'none';
                        alertBox.classList.remove('fade-out-up');
                    }, 300);
                }, 3000);
            }
        }, 100);
    });
    
    // Listen for modal close events
    Livewire.on('closemodal', () => {
        setTimeout(() => {
            // Close Bootstrap modals
            const modals = document.querySelectorAll('.modal.show');
            modals.forEach(modal => {
                const bsModal = bootstrap.Modal.getInstance(modal);
                if (bsModal) {
                    bsModal.hide();
                }
            });
            
            // Remove modal backdrop if any left behind
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());
            
            // Remove modal-open class from body
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        }, 100);
    });
    
    // Listen for iku1store event to refresh page state
    Livewire.on('iku1store', () => {
        console.log('IKU1 data stored/updated - state refreshed');
    });
    
    // Listen for delete confirmation
    Livewire.on('showDeleteConfirmation', (event) => {
        console.log('Delete confirmation triggered for ID:', event.id);
        if (confirm('Apakah anda yakin menghapus data ini?')) {
            Livewire.dispatch('confirmDelete', { id: event.id });
        }
    });
});