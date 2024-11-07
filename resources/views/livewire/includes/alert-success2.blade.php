
<div id="custom-alert" class="fixed left-0 right-0 z-50 flex justify-center hidden top-5" role="alert">
    <div 
        class="transition-opacity bg-white border rounded-full opacity-100 dark:text-white dark:border-neutral-700 dark:bg-neutral-900 max-w-max">
        <div class="flex items-center gap-2 p-2">
            <div class="shrink-0">
                <!-- Icon -->
                <span
                    class="inline-flex items-center justify-center p-1 text-green-200 border-4 rounded-full bg-green-400/100 border-green-300/100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </span>
                <!-- End Icon -->
            </div>
            <div class="">
                <h3 id="hs-bordered-green-style-label" class="text-sm font-medium text-gray-700 dark:text-white">
                    {{ session('success') }}
                </h3>
            </div>
        </div>
    </div>
</div>



{{-- <script>
    // Membuat alert hilang setelah 3 detik
    setTimeout(() => {
        const alertBox = document.getElementById('custom-alert');

        // alertBox.classList.remove('hidden'); // Ensure the alert is shown
        alertBox.classList.add('fade-in'); 
        if (alertBox) {
            alertBox.classList.add('fade-out-up'); // Tambahkan kelas opacity-0 untuk efek fade-out
            setTimeout(() => alertBox.remove(), 1000); // Hapus elemen setelah durasi fade-out selesai (1 detik)
        }
    }, 3000);
</script> --}}

<script>
    // Function to show the alert
    function showAlert(message) {
        const alertBox = document.getElementById('custom-alert');
        const messageLabel = document.getElementById('hs-bordered-green-style-label');

        // If no message is provided, do not show the alert
        if (!message) {
            return;
        }

        // Set the message
        messageLabel.textContent = message;

        // Remove hidden class and add fade-in class
        alertBox.classList.remove('hidden'); // Ensure the alert is shown
        alertBox.classList.add('fade-in'); // Apply fade-in effect

        // Set timeout to fade out after 3 seconds
        setTimeout(() => {
            alertBox.classList.add('fade-out-up'); // Add fade-out animation
            setTimeout(() => alertBox.remove(), 1000); // Remove element after fade-out
        }, 3000);
    }

    // Check if the success message exists in the session
    document.addEventListener("DOMContentLoaded", function () {
        const sessionMessage = "{{ session('success') }}"; // Retrieve session message

        // Show alert if there is a session message
        if (sessionMessage) {
            showAlert(sessionMessage); // Call showAlert with the session message
        }
    });
</script>


