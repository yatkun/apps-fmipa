<div>
    <div class="w-full mb-5 lg:ps-64">
        @if (session('success'))
            @include('livewire.includes.alert-success', [
                'header' => 'Sukses',
            ])
        @endif


        <div class="grid grid-cols-12 gap-5 px-5 mt-5">

            <div class="col-span-12">
                <div class="bg-white border border-gray-200 rounded-lg dark:bg-neutral-800 dark:border-neutral-700">
                    <!-- Header -->
                    <div
                        class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">IKU 5 : Penerapan Karya
                                Dosen
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">Jumlah keluaran dosen yang berhasil
                                mendapat rekognisi internasional atau diterapkan oleh masyarakat/industri/pemerintah per
                                jumlah dosen.
                            </p>
                        </div>


                    </div>
                    <!-- End Header -->
                    <div class="hs-accordion-group">
                        <div class="-mt-px bg-white border border-t border-l-0 border-r-0 hs-accordion dark:bg-neutral-800 dark:border-neutral-700"
                            id="hs-bordered-heading-one">
                            <button
                                class="inline-flex items-center w-full px-5 py-4 text-sm font-medium text-gray-800 hs-accordion-toggle hs-accordion-active:text-blue-600 gap-x-3 text-start hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400"
                                aria-expanded="true" aria-controls="hs-basic-bordered-collapse-one">
                                <svg class="hs-accordion-active:hidden block size-3.5"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5v14"></path>
                                </svg>
                                <svg class="hs-accordion-active:block hidden size-3.5"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                </svg>
                                Karya Tulis Ilmiah
                            </button>
                            <div id="hs-basic-bordered-collapse-one"
                                class="hs-accordion-content w-full hidden overflow-hidden transition-[height] duration-300"
                                role="region" aria-labelledby="hs-bordered-heading-one">
                                <div class="px-5 pb-4">
                                    <ul
                                        class="space-y-2 text-sm text-gray-600 list-disc marker:text-blue-600 ps-5 dark:text-neutral-400">
                                        <li>
                                            Artikel ilmiah, buku akademik, dan bab (chapter) dalam buku akademik;
                                        </li>
                                        <li>
                                            Karya rujukan: buku saku (handbook), pedoman (guidelines), manual, buku teks
                                            (textbook), monograf, ensiklopedia, kamus; Studi kasus; dan/atau
                                        </li>

                                        <li>
                                            Laporan penelitian untuk mitra.
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="-mt-px bg-white border border-t border-l-0 border-r-0 hs-accordion dark:bg-neutral-800 dark:border-neutral-700"
                            id="hs-bordered-heading-two">
                            <button
                                class="inline-flex items-center w-full px-5 py-4 text-sm font-medium text-gray-800 hs-accordion-toggle hs-accordion-active:text-blue-600 gap-x-3 text-start hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400"
                                aria-expanded="false" aria-controls="hs-basic-bordered-collapse-two">
                                <svg class="hs-accordion-active:hidden block size-3.5"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5v14"></path>
                                </svg>
                                <svg class="hs-accordion-active:block hidden size-3.5"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                </svg>
                                Karya Terapan
                            </button>
                            <div id="hs-basic-bordered-collapse-two"
                                class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                role="region" aria-labelledby="hs-bordered-heading-two">
                                <div class="px-5 pb-4">
                                    <ul
                                        class="space-y-2 text-sm text-gray-600 list-disc marker:text-blue-600 ps-5 dark:text-neutral-400">
                                        <li>
                                            Produk fisik, digital, dan algoritme (termasuk prototipe); dan/atau
                                        </li>
                                        <li>
                                            Pengembangan invensi dengan mitra.
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="-mt-px bg-white border border-t border-l-0 border-r-0 hs-accordion dark:bg-neutral-800 dark:border-neutral-700"
                            id="hs-bordered-heading-two">
                            <button
                                class="inline-flex items-center w-full px-5 py-4 text-sm font-medium text-gray-800 hs-accordion-toggle hs-accordion-active:text-blue-600 gap-x-3 text-start hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400"
                                aria-expanded="false" aria-controls="hs-basic-bordered-collapse-two">
                                <svg class="hs-accordion-active:hidden block size-3.5"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5v14"></path>
                                </svg>
                                <svg class="hs-accordion-active:block hidden size-3.5"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                </svg>
                                Karya Seni
                            </button>
                            <div id="hs-basic-bordered-collapse-two"
                                class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                role="region" aria-labelledby="hs-bordered-heading-two">
                                <div class="px-5 pb-4">
                                    <ul
                                        class="space-y-2 text-sm text-gray-600 list-disc marker:text-blue-600 ps-5 dark:text-neutral-400">
                                        <li>
                                            Visual, audio, audio-visual, pertunjukan (performance);
                                        </li>
                                        <li>
                                            Desain konsep, desain produk, desain komunikasi visual, desain arsitektur,
                                            desain kriya;
                                        </li>
                                        <li>
                                            Karya tulis novel, sajak, puisi, notasi musik; dan/atau
                                        </li>

                                        <li>
                                            Karya preservasi (contoh: modernisasi seni tari daerah).
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="-mt-px bg-white border border-t border-b-0 border-l-0 border-r-0 hs-accordion first:rounded-t-lg last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700"
                            id="hs-bordered-heading-three">
                            <button
                                class="inline-flex items-center w-full px-5 py-4 text-sm font-medium text-gray-800 hs-accordion-toggle hs-accordion-active:text-blue-600 gap-x-3 text-start hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400"
                                aria-expanded="false" aria-controls="hs-basic-bordered-collapse-three">
                                <svg class="hs-accordion-active:hidden block size-3.5"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5v14"></path>
                                </svg>
                                <svg class="hs-accordion-active:block hidden size-3.5"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                </svg>
                                Pembobotan
                            </button>
                            <div id="hs-basic-bordered-collapse-three"
                                class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                role="region" aria-labelledby="hs-bordered-heading-three">
                                <div class="px-5 pb-4">
                                    <div class="grid grid-cols-12 gap-4">
                                        <div class="col-span-12 md:col-span-12">
                                            <div class="bg-white dark:bg-neutral-800">
                                                <div class="flex flex-col">
                                                    <div class="-m-1.5 overflow-x-auto">
                                                        <div class="p-1.5 min-w-full inline-block align-middle">
                                                            <div
                                                                class="overflow-hidden border rounded-lg dark:border-neutral-700">
                                                                <div
                                                                    class="grid px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
                                                                    <div>

                                                                        <p
                                                                            class="text-sm text-gray-600 dark:text-neutral-400">
                                                                            Matriks Pembobotan
                                                                        </p>
                                                                    </div>


                                                                </div>

                                                                <table
                                                                    class="min-w-full text-center divide-y divide-gray-200 dark:divide-neutral-700">
                                                                    <thead class="bg-gray-50 dark:bg-neutral-800">
                                                                        <tr>
                                                                            <th scope="col"
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-r dark:border-neutral-700 dark:text-neutral-400">
                                                                                Jenis Karya</th>
                                                                            <th scope="col"
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-r dark:text-neutral-400">
                                                                                Bobot</th>
                                                                            <th scope="col"
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                                                Kriteria</th>


                                                                        </tr>
                                                                    </thead>
                                                                    <tbody
                                                                        class="divide-y divide-gray-200 dark:divide-neutral-700">
                                                                        <tr>
                                                                            <td rowspan="3"
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-r dark:bg-neutral-800 bg-gray-50 dark:border-neutral-700 dark:text-neutral-400">
                                                                                Karya Tulis Ilmiah</td>
                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 border-r whitespace-nowrap dark:text-neutral-200">
                                                                                0.8</td>
                                                                            <td style="text-align: left"
                                                                                class="px-6 py-4 text-sm text-left text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                                                Karya tulis ilmiah yang dipublikasikan
                                                                                dalam bentuk:
                                                                                <ul style="text-align: left"
                                                                                    class="text-sm text-gray-600 list-disc marker:text-blue-600 ps-5 dark:text-neutral-400">
                                                                                    <li>
                                                                                        Buku referensi,
                                                                                    </li>
                                                                                    <li>
                                                                                        Jurnal internasional bereputasi,
                                                                                    </li>
                                                                                    <li>
                                                                                        Buku nasional/internasional yang
                                                                                        mempunyai ISBN
                                                                                    </li>
                                                                                </ul>

                                                                            </td>
                                                                        </tr>
                                                                        <tr>

                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 border-r dark:text-neutral-200">
                                                                                0.6</td>
                                                                            <td style="text-align: left"
                                                                                class="px-6 py-4 text-sm text-left text-gray-800 dark:text-neutral-200">
                                                                                Karya tulis ilmiah yang dipublikasikan
                                                                                dalam bentuk:
                                                                                <ul style="text-align: left"
                                                                                    class="text-sm text-gray-600 list-disc marker:text-blue-600 ps-5 dark:text-neutral-400">
                                                                                    <li>
                                                                                        Book chapter internasional,
                                                                                    </li>
                                                                                    <li>
                                                                                        Jurnal nasional berbahasa
                                                                                        inggris atau bahasa resmi PBB
                                                                                        terindeks pada DOAJ
                                                                                    </li>
                                                                                    <li>
                                                                                        Prosiding internasional dalam
                                                                                        seminar internasional dalam
                                                                                        bentuk monograf, atau hasil
                                                                                        penelitian kerjasama industri
                                                                                        termasuk penugasan dari
                                                                                        kementerian atau
                                                                                        LPNK yang tidak dipublikasika
                                                                                    </li>

                                                                                </ul>

                                                                            </td>


                                                                        </tr>
                                                                        <tr>

                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 border-r dark:text-neutral-200">
                                                                                0.4</td>
                                                                            <td style="text-align: left"
                                                                                class="px-6 py-4 text-sm text-left text-gray-800 dark:text-neutral-200">
                                                                                Untuk Karya Tulis Ilmiah yang tidak
                                                                                masuk dalam Kriteria di atas
                                                                            </td>


                                                                        </tr>
                                                                        <tr>
                                                                            <td rowspan="2"
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-r dark:bg-neutral-800 bg-gray-50 dark:border-neutral-700 dark:text-neutral-400">
                                                                                Karya Terapan</td>
                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 border-r dark:text-neutral-200">
                                                                                1.0</td>
                                                                            <td style="text-align: left"
                                                                                class="px-6 py-4 text-sm text-left text-gray-800 dark:text-neutral-200">

                                                                                <ul style="text-align: left"
                                                                                    class="text-sm text-gray-600 list-disc marker:text-blue-600 ps-5 dark:text-neutral-400">
                                                                                    <li>
                                                                                        Karya Terapan yang
                                                                                        diterapkan/digunakan/diaplikasikan
                                                                                        pada Dunia Usaha dan Dunia
                                                                                        Industri atau Masyarakat pada
                                                                                        tingkat internasional atau
                                                                                        Nasional; atau
                                                                                    </li>
                                                                                    <li>
                                                                                        Hasil Rancangan Teknologi/Seni
                                                                                        yang dipatenkan secara
                                                                                        internasional
                                                                                    </li>

                                                                                </ul>

                                                                            </td>
                                                                        </tr>
                                                                        <tr>

                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 border-r dark:text-neutral-200">
                                                                                0.8</td>
                                                                            <td style="text-align: left"
                                                                                class="px-6 py-4 text-sm text-left text-gray-800 dark:text-neutral-200">

                                                                                <ul style="text-align: left"
                                                                                    class="text-sm text-gray-600 list-disc marker:text-blue-600 ps-5 dark:text-neutral-400">
                                                                                    <li>
                                                                                        Karya Terapan yang belum
                                                                                        diterapkan tetapi sudah
                                                                                        mendapatkan ijin edar atau sudah
                                                                                        terstandarisasi;
                                                                                    </li>
                                                                                    <li>
                                                                                        Hasil Rancangan Teknologi/Seni
                                                                                        yang dipatenkan secara Nasional;
                                                                                        atau melaksanakan pengembangan
                                                                                        hasil pendidikan dan penelitian
                                                                                    </li>


                                                                                </ul>

                                                                            </td>


                                                                        </tr>
                                                                        <tr>
                                                                            <td rowspan="3"
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-r dark:bg-neutral-800 bg-gray-50 dark:border-neutral-700 dark:text-neutral-400">
                                                                                Karya Seni</td>
                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 border-r dark:text-neutral-200">
                                                                                0.9</td>
                                                                            <td style="text-align: left"
                                                                                class="px-6 py-4 text-sm text-left text-gray-800 dark:text-neutral-200">

                                                                                <ul style="text-align: left"
                                                                                    class="text-sm text-gray-600 list-disc marker:text-blue-600 ps-5 dark:text-neutral-400">
                                                                                    <li>
                                                                                        Melaksanakan dan/atau
                                                                                        menghasilkan karya seni atau
                                                                                        kegiatan seni pada tingkat
                                                                                        internasional
                                                                                    </li>
                                                                                </ul>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>

                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 border-r dark:text-neutral-200">
                                                                                0.7</td>
                                                                            <td style="text-align: left"
                                                                                class="px-6 py-4 text-sm text-left text-gray-800 dark:text-neutral-200">

                                                                                <ul style="text-align: left"
                                                                                    class="text-sm text-gray-600 list-disc marker:text-blue-600 ps-5 dark:text-neutral-400">
                                                                                    <li>
                                                                                        Melaksanakan dan/atau
                                                                                        menghasilkan karya seni atau
                                                                                        kegiatan seni pada tingkat
                                                                                        Nasional.
                                                                                    </li>
                                                                                    <li>
                                                                                        Membuat rancangan karya seni
                                                                                        atau kegiatan seni tingkat
                                                                                        internasional; atau
                                                                                    </li>
                                                                                    <li>
                                                                                        Melaksanakan penelitian di
                                                                                        bidang seni yang dipatenkan atau
                                                                                        dipublikasikan dalam seminar
                                                                                        nasional
                                                                                    </li>


                                                                                </ul>

                                                                            </td>


                                                                        </tr>
                                                                        <tr>

                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 border-r dark:text-neutral-200">
                                                                                0.5</td>
                                                                            <td style="text-align: left"
                                                                                class="px-6 py-4 text-sm text-left text-gray-800 dark:text-neutral-200">

                                                                                <ul style="text-align: left"
                                                                                    class="text-sm text-gray-600 list-disc marker:text-blue-600 ps-5 dark:text-neutral-400">
                                                                                    <li>
                                                                                        Melaksanakan dan/atau
                                                                                        menghasilkan karya seni atau
                                                                                        kegiatan seni pada tingkat
                                                                                        lokal.
                                                                                    </li>
                                                                                    <li>
                                                                                        Membuat rancangan karya seni
                                                                                        atau kegiatan seni tingkat
                                                                                        nasional; atau
                                                                                    </li>
                                                                                    <li>
                                                                                        Melaksanakan penelitian di
                                                                                        bidang seni yang tidak
                                                                                        dipatenkan atau dipublikasikan
                                                                                    </li>


                                                                                </ul>

                                                                            </td>


                                                                        </tr>



                                                                    </tbody>

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul
                                                class="mt-3 space-y-2 text-sm text-gray-600 list-disc marker:text-blue-600 ps-5 dark:text-neutral-400">

                                                <li>
                                                    <div>Catatan:
                                                        Jika dosen melakukan lebih dari satu kegiatan akan digunakan
                                                        bobot yang tertinggi</div>
                                                </li>
                                            </ul>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12">
                @include('livewire.includes.tables.table-iku5')
            </div>
        </div>
    </div>

    <div id="ModalAddIku5" wire:ignore.self
        class="hs-overlay hidden  size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="ModalAddIku3-label">
        <form wire:submit="save">
            <div
                class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-3xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                <div
                    class="flex flex-col w-full bg-white border shadow-sm pointer-events-auto rounded-xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                        <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800 dark:text-white">
                            {{ $mode == 'edit' ? 'Edit' : 'Tambah' }} Data IKU 5 | Karya Dosen
                        </h3>
                        <button type="button" wire:click="cancelEdit"
                            class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                            aria-label="Close" data-hs-overlay="#ModalAddIku5">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="p-6 overflow-y-auto">

                        <!-- Grid -->
                        <div class="grid gap-2 sm:grid-cols-12 sm:gap-6">



                            <div class="sm:col-span-3">
                                <label for="af-account-full-name"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Nama Dosen
                                </label>
                            </div>
                            <!-- End Col -->



                            <div class="sm:col-span-9">
                                <div class="sm:flex">
                                    <input id="af-account-full-name" type="text"
                                        class="relative block w-full px-3 py-2 -mt-px text-sm border border-gray-200 rounded-lg shadow-sm pe-11 -ms-px sm:mt-0 sm:first:ms-0 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukkan nama lengkap dosen" name="nama"
                                        wire:model="form.nama">

                                </div>
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-3">
                                <label for="jenis_karya"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Jenis Karya
                                </label>
                            </div>



                            <div class="sm:col-span-9">
                                <select wire:model.change="form.jenis_karya"
                                    class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                    <option selected="">Pilih Jenis Karya</option>
                                    <option name="jenis_karya" value="Karya Tulis Ilmiah">Karya Tulis Ilmiah</option>
                                    <option name="jenis_karya" value="Karya Terapan">Karya Terapan</option>
                                    <option name="jenis_karya" value="Karya Seni">Karya Seni</option>
                                </select>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="kriteria"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Kriteria
                                </label>
                            </div>



                            <div class="sm:col-span-9">
                                <select wire:model="form.kriteria"
                                    class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                    <option selected="">Pilih Kriteria</option>
                                    @foreach ($kriteriaOptions as $kriteria)
                                    <option value="{{ $kriteria }}">{{ $kriteria }}</option>
                                @endforeach
                                   
                                </select>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="tanggal"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Tanggal Terbit
                                </label>
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-9">
                                <input id="tanggal" type="date"
                                    class="block w-full px-3 py-2 text-sm text-gray-800 border border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    name="tanggal" wire:model="form.tanggal">
                            </div>



                            <div class="sm:col-span-3">
                                <label for="keterangan"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Keterangan
                                </label>
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-9">
                                <input id="keterangan" type="text"
                                    class="block w-full px-3 py-2 text-sm text-gray-800 border border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    name="keterangan" wire:model="form.keterangan">
                            </div>
                            <!-- End Col -->


                        </div>
                        <!-- End Grid -->



                    </div>
                    <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                        <button type="button" wire:click="cancelEdit"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                            data-hs-overlay="#ModalAddIku3">
                            Batal
                        </button>
                        <button wire:loading.attr="disabled" wire:click="handleSaveOrUpdate"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            {{ $mode == 'edit' ? 'Update' : 'Simpan' }}
                        </button>
                        <!-- Indikator Loading -->
                        <div wire:loading class="mt-2 text-blue-500">
                            Processing...
                        </div>
                    </div>

                </div>
            </div>
        </form>

    </div>

</div>
