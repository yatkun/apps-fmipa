<div class="error-notif" id="custom-alert" role="alert">
  <div id="toast" class="notif-content"
      style="box-shadow: rgba(0, 0, 0, 0.1) 0px 3px 10px, rgba(0, 0, 0, 0.05) 0px 3px 3px;">
      <svg viewBox="0 0 32 32" width="1.25rem" height="1.25rem" style="overflow: visible">
          <circle cx="16" cy="16" r="0" fill="#34C759">
              <animate attributeName="opacity" values="0; 1; 1" dur="0.35s" begin="100ms" fill="freeze"
                  calcMode="spline" keyTimes="0; 0.6; 1" keySplines="0.25 0.71 0.4 0.88; .59 .22 .87 .63"></animate>
              <animate attributeName="r" values="0; 17.5; 16" dur="0.35s" begin="100ms" fill="freeze"
                  calcMode="spline" keyTimes="0; 0.6; 1" keySplines="0.25 0.71 0.4 0.88; .59 .22 .87 .63"></animate>
          </circle>
          <circle cx="16" cy="16" r="12" opacity="0" fill="#34C759">
              <animate attributeName="opacity" values="1; 0" dur="1s" begin="350ms" fill="freeze"
                  calcMode="spline" keyTimes="0; 1" keySplines="0.0 0.0 0.2 1"></animate>
              <animate attributeName="r" values="12; 26" dur="1s" begin="350ms" fill="freeze"
                  calcMode="spline" keyTimes="0; 1" keySplines="0.0 0.0 0.2 1"></animate>
          </circle>
          <path fill="none" stroke-width="4" stroke-dasharray="22" stroke-dashoffset="22" stroke-linecap="round"
              stroke-miterlimit="10" d="M9.8,17.2l3.8,3.6c0.1,0.1,0.3,0.1,0.4,0l9.6-9.7" stroke="#F4f4f4">
              <animate attributeName="stroke-dashoffset" values="22;0" dur="0.25s" begin="250ms" fill="freeze"
                  calcMode="spline" keyTimes="0; 1" keySplines="0.0, 0.0, 0.58, 1.0"></animate>
          </path>
      </svg>
      <div id="hs-bordered-red-style-label text-xl">{{ session('success') }}</div>
  </div>
</div>



