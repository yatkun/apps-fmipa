<div class="error-notif" id="custom-alert" role="alert">
    <div id="toast" class="notif-content"
        style="box-shadow: rgba(0, 0, 0, 0.1) 0px 3px 10px, rgba(0, 0, 0, 0.05) 0px 3px 3px;">
        <svg viewBox="0 0 32 32" width="1.25rem" height="1.25rem" style="overflow: visible;">
            <circle cx="16" cy="16" r="0" fill="#FF3B30">
                <animate attributeName="opacity" values="0; 1; 1" dur="0.35s" begin="100ms" fill="freeze"
                    calcMode="spline" keyTimes="0; 0.6; 1" keySplines="0.25 0.71 0.4 0.88; .59 .22 .87 .63"></animate>
                <animate attributeName="r" values="0; 17.5; 16" dur="0.35s" begin="100ms" fill="freeze"
                    calcMode="spline" keyTimes="0; 0.6; 1" keySplines="0.25 0.71 0.4 0.88; .59 .22 .87 .63"></animate>
            </circle>
            <circle cx="16" cy="16" r="12" opacity="0" fill="#FF3B30">
                <animate attributeName="opacity" values="1; 0" dur="1s" begin="320ms" fill="freeze"
                    calcMode="spline" keyTimes="0; 1" keySplines="0.0 0.0 0.2 1"></animate>
                <animate attributeName="r" values="12; 26" dur="1s" begin="320ms" fill="freeze"
                    calcMode="spline" keyTimes="0; 1" keySplines="0.0 0.0 0.2 1"></animate>
            </circle>
            <path fill="none" stroke-width="4" stroke-dasharray="9" stroke-dashoffset="9" stroke-linecap="round"
                d="M16,7l0,9" stroke="#FFFFFF">
                <animate attributeName="stroke-dashoffset" values="9;0" dur="0.2s" begin="250ms" fill="freeze"
                    calcMode="spline" keyTimes="0; 1" keySplines="0.0, 0.0, 0.58, 1.0"></animate>
            </path>
            <circle cx="16" cy="23" r="2.5" opacity="0" fill="#FFFFFF">
                <animate attributeName="opacity" values="0;1" dur="0.25s" begin="350ms" fill="freeze"
                    calcMode="spline" keyTimes="0; 1" keySplines="0.0, 0.0, 0.58, 1.0"></animate>
            </circle>
        </svg>
        <div id="hs-bordered-red-style-label">{{ session('error') }}</div>
    </div>
</div>


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

        // Trigger the animations inside the toast
        const svgElements = toast.querySelectorAll("animate");
        svgElements.forEach((anim) => {
            anim.beginElement(); // Start each animation
        });
        // Set timeout to fade out after 3 seconds
        setTimeout(() => {
            alertBox.classList.add('fade-out-up'); // Add fade-out animation
            setTimeout(() => alertBox.remove(), 1000); // Remove element after fade-out
        }, 3000);
    }

    // Check if the success message exists in the session
    document.addEventListener("DOMContentLoaded", function() {
        const sessionMessage = "{{ session('success') }}"; // Retrieve session message

        // Show alert if there is a session message
        if (sessionMessage) {
            showAlert(sessionMessage); // Call showAlert with the session message
        }
    });
</script>
