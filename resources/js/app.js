import './bootstrap';
import 'preline';


document.addEventListener("livewire:navigated", ()=> {
    console.log('nav');
    window.HSStaticMethods.autoInit(); 
});




    // Tangkap event dari Livewire di frontend
    Livewire.on('answerUpdated', (answers) => {
        console.log('Answers updated:', answers);
    });

    
