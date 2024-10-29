<div>

    <!-- Notifikasi -->
    {{-- @if (session('success'))
        @include('livewire.includes.alert-success', [
            'header' => 'Sukses',
        ])
    @endif --}}

    @if (session('success'))
        @include('livewire.includes.alert-success', [
            'header' => 'Sukses',
        ])
    @endif
    <!-- Hero -->
    <div
        class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/squared-bg-element.svg')] dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/squared-bg-element.svg')] before:bg-no-repeat before:bg-top before:size-full before:-z-[1] before:transform before:-translate-x-1/2">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
            <!-- Announcement Banner -->

            <!-- End Announcement Banner -->
            <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                <!-- Grid -->
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
                    <!-- Card -->
                    <div
                        class="flex flex-col h-full bg-white border border-gray-200 lg:col-start-2 group rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                        <div class="flex flex-col items-center justify-center h-32 bg-blue-600 rounded-t-xl">
                            <svg class="size-16" width="56" height="56" viewBox="0 0 56 56" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="56" height="56" rx="10" fill="white" />
                                <path
                                    d="M20.2819 26.7478C20.1304 26.5495 19.9068 26.4194 19.6599 26.386C19.4131 26.3527 19.1631 26.4188 18.9647 26.5698C18.848 26.6622 18.7538 26.78 18.6894 26.9144L10.6019 43.1439C10.4874 43.3739 10.4686 43.6401 10.5496 43.884C10.6307 44.1279 10.805 44.3295 11.0342 44.4446C11.1681 44.5126 11.3163 44.5478 11.4664 44.5473H22.7343C22.9148 44.5519 23.0927 44.5037 23.2462 44.4084C23.3998 44.3132 23.5223 44.1751 23.5988 44.011C26.0307 38.9724 24.5566 31.3118 20.2819 26.7478Z"
                                    fill="url(#paint0_linear_2204_541)" />
                                <path
                                    d="M28.2171 11.9791C26.201 15.0912 25.026 18.6755 24.8074 22.3805C24.5889 26.0854 25.3342 29.7837 26.9704 33.1126L32.403 44.0113C32.4833 44.1724 32.6067 44.3079 32.7593 44.4026C32.912 44.4973 33.088 44.5475 33.2675 44.5476H44.5331C44.6602 44.5479 44.7861 44.523 44.9035 44.4743C45.0209 44.4257 45.1276 44.3543 45.2175 44.2642C45.3073 44.1741 45.3785 44.067 45.427 43.9492C45.4755 43.8314 45.5003 43.7052 45.5 43.5777C45.5001 43.4274 45.4659 43.2791 45.3999 43.1441L29.8619 11.9746C29.7881 11.8184 29.6717 11.6864 29.5261 11.594C29.3805 11.5016 29.2118 11.4525 29.0395 11.4525C28.8672 11.4525 28.6984 11.5016 28.5529 11.594C28.4073 11.6864 28.2908 11.8184 28.2171 11.9746V11.9791Z"
                                    fill="#2684FF" />
                                <defs>
                                    <linearGradient id="paint0_linear_2204_541" x1="24.734" y1="29.2284"
                                        x2="16.1543" y2="44.0429" gradientUnits="userSpaceOnUse">
                                        <stop offset="0%" stop-color="#0052CC" />
                                        <stop offset="0.92" stop-color="#2684FF" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="p-4 md:p-6">
                            <span class="block mb-1 text-xs font-semibold text-blue-600 uppercase dark:text-blue-500">
                                Apps
                            </span>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-neutral-300 dark:hover:text-white">
                                APLIKASI IKU
                            </h3>

                        </div>
                        <div
                            class="flex mt-auto border-t border-gray-200 divide-x divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
                            <button wire:click="iku1" class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-gray-800 bg-white shadow-sm gap-x-2 rounded-xl hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                             >
                                MASUK
                            </button>

                        </div>
                    </div>
                    <!-- End Card -->


                    <!-- Card -->
                    <div
                        class="flex flex-col h-full bg-white border border-gray-200 shadow-sm group rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                        <div class="flex flex-col items-center justify-center h-32 bg-amber-500 rounded-t-xl">
                            <svg class="size-16" width="56" height="56" viewBox="0 0 56 56" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="56" height="56" rx="10" fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M23.7326 11.968C21.9637 11.9693 20.5321 13.4049 20.5334 15.1738C20.5321 16.9427 21.965 18.3782 23.7339 18.3795H26.9345V15.1751C26.9358 13.4062 25.5029 11.9706 23.7326 11.968C23.7339 11.968 23.7339 11.968 23.7326 11.968M23.7326 20.5184H15.2005C13.4316 20.5197 11.9987 21.9553 12 23.7242C11.9974 25.4931 13.4303 26.9286 15.1992 26.9312H23.7326C25.5016 26.9299 26.9345 25.4944 26.9332 23.7255C26.9345 21.9553 25.5016 20.5197 23.7326 20.5184V20.5184Z"
                                    fill="#36C5F0" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M44.0001 23.7242C44.0014 21.9553 42.5684 20.5197 40.7995 20.5184C39.0306 20.5197 37.5977 21.9553 37.599 23.7242V26.9312H40.7995C42.5684 26.9299 44.0014 25.4944 44.0001 23.7242ZM35.4666 23.7242V15.1738C35.4679 13.4062 34.0363 11.9706 32.2674 11.968C30.4985 11.9693 29.0656 13.4049 29.0669 15.1738V23.7242C29.0643 25.4931 30.4972 26.9286 32.2661 26.9312C34.035 26.9299 35.4679 25.4944 35.4666 23.7242Z"
                                    fill="#2EB67D" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M32.2661 44.0322C34.035 44.0309 35.4679 42.5953 35.4666 40.8264C35.4679 39.0575 34.035 37.622 32.2661 37.6207H29.0656V40.8264C29.0642 42.594 30.4972 44.0295 32.2661 44.0322ZM32.2661 35.4804H40.7995C42.5684 35.4791 44.0013 34.0436 44 32.2747C44.0026 30.5058 42.5697 29.0702 40.8008 29.0676H32.2674C30.4985 29.0689 29.0656 30.5045 29.0669 32.2734C29.0656 34.0436 30.4972 35.4791 32.2661 35.4804V35.4804Z"
                                    fill="#ECB22E" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 32.2746C11.9987 34.0435 13.4316 35.479 15.2005 35.4804C16.9694 35.479 18.4024 34.0435 18.401 32.2746V29.0688H15.2005C13.4316 29.0702 11.9987 30.5057 12 32.2746ZM20.5334 32.2746V40.825C20.5308 42.5939 21.9637 44.0295 23.7326 44.0321C25.5016 44.0308 26.9345 42.5952 26.9332 40.8263V32.2772C26.9358 30.5083 25.5029 29.0728 23.7339 29.0702C21.9637 29.0702 20.5321 30.5057 20.5334 32.2746C20.5334 32.2759 20.5334 32.2746 20.5334 32.2746Z"
                                    fill="#E01E5A" />
                            </svg>
                        </div>
                        <div class="p-4 md:p-6">
                            <span class="block mb-1 text-xs font-semibold uppercase text-amber-500">
                                ON-GOING
                            </span>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-neutral-300 dark:hover:text-white">
                                APLIKASI DATABASE
                            </h3>

                        </div>
                        <div
                            class="flex mt-auto border-t border-gray-200 divide-x divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">

                            <a class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-gray-800 bg-white shadow-sm gap-x-2 rounded-xl hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                href="#">
                                MASUK
                            </a>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <!-- End Grid -->
            </div>
            <!-- End Card Blog -->
        </div>

    </div>


   
</div>
<!-- End Hero -->

<!-- Card Blog -->

