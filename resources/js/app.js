import './bootstrap';
import 'preline';




document.addEventListener("livewire:navigated", ()=> {
    window.HSStaticMethods.autoInit();
});




    // Tangkap event dari Livewire di frontend
    Livewire.on('answerUpdated', (answers) => {
        console.log('Answers updated:', answers);
    });

    
