<div id="custom-alert" class="fixed left-0 right-0 z-50 flex justify-center hidden top-5" role="alert">
  <div 
      class="px-2 transition-opacity bg-red-200 rounded-full opacity-100 ring-red-300/90 ring-2 max-w-max">
      <div class="flex items-center gap-2 p-2">
          <div class="shrink-0">
              <!-- Icon -->
              <span
                  class="inline-flex items-center justify-center p-1 text-red-200 bg-red-400 border-4 border-red-300 rounded-full">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>
                  
              </span>
              <!-- End Icon -->
          </div>
          <div class="">
              <h3 id="hs-bordered-green-style-label" class="text-sm font-medium text-gray-700">
                  {{ session('error') }}
              </h3>
          </div>
      </div>
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