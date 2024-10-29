<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        #hs-application-sidebar {
            @apply hidden;
            /* Menggunakan Tailwind untuk menyembunyikan */
        }

        #hs-application-sidebar.show {
            @apply block;
            /* Menampilkan sidebar */
        }
    </style>

</head>

<body class="bg-gray-50 dark:bg-neutral-900">

    <x-navbar></x-navbar>

    @extends('panel.menu-sidebar')

    <!-- Content -->
    <div class="w-full lg:ps-64" id="content">
        <div class="flex justify-between p-5">
            <h2 class="text-2xl dark:text-white">Paket Tryout CPNS Premium 1</h2>
            <x-button-outline href="#" class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                  </svg>
                  
                LAPORKAN SOAL</x-button-outline>
        </div>

        <div class="px-5">
            <div class="grid grid-cols-12 gap-4">
                <div
                    class="flex flex-col col-span-12 bg-white border md:col-span-8 rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div
                        class="px-4 py-3 bg-gray-100 border-b rounded-t-xl md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700">
                        <div class="flex items-center justify-between">
                            <div class="text-xl font-medium dark:text-white">Soal Nomor 1</div>

                            <span
                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">Tes
                                Wawasan
                                Kebangsaan</span>
                        </div>
                    </div>
                    <div class="p-4 md:p-5">

                        <p class="mt-2 text-gray-500 dark:text-neutral-400">
                            Kemenangan tanpa syarat Jepang atas sekutu berakhir dengan adanya perjanjian kalijati yang
                            diadakan di subang, Jawa Barat. Isi perjanjian tersebut adalah penyerahan hak atas tanah
                            penjajahan Belanda di Indonesia kepada pemerintahan pendudukan Jepang. meskipun kedatangan
                            jepang tersebut sama halnya dengan Belanda mempunyai tujuan untuk menjajah, namun Jepang
                            pada awalnya diterima dan disambut baik oleh bangsa Indonesia. Di bawah ini yang bukan
                            merupakan alasan diterimanya Jepang oleh bangsa Indonesia adalah ….
                        </p>
                        <a class="inline-flex items-center mt-3 text-sm font-semibold text-blue-600 border border-transparent rounded-lg gap-x-1 decoration-2 hover:text-blue-700 hover:underline focus:underline focus:outline-none focus:text-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-600 dark:focus:text-blue-600"
                            href="#">
                            Card link
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </a>
                    </div>
                </div>
        
                <div class="col-span-12 md:col-span-4">
                    <div class="flex flex-col p-4 bg-white border border-gray-200 rounded-xl md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                              </svg>
                              <div class="text-2xl font-bold dark:text-white">01 : 22 : 34</div>
                        </div>
                         
                      </div>
                </div>
            </div>
            
        </div>

    </div>
    <!-- End Content -->
    {{-- Main Content  --}}


    <!-- Required plugins -->
    <script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.min.js"></script>
    <script>
        document.getElementById('focus').addEventListener('click', function() {
            const content = document.getElementById('content');
            content.classList.toggle('lg:ps-0');

        });
    </script>
    <script src="../scripts/js/open-modals-on-init.js"></script>


</body>

</html>
