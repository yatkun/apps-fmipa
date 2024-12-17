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
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                IKU 1 : Lulusan Mendapatkan Pekerjaan yang Layak
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                Persentase lulusan yang berhasil memiliki pekerjaan, melanjutkan studi, atau
                                menjadi wiraswasta
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
                                Penjelasan Umum
                            </button>
                            <div id="hs-basic-bordered-collapse-one"
                                class="hs-accordion-content w-full hidden overflow-hidden transition-[height] duration-300"
                                role="region" aria-labelledby="hs-bordered-heading-one">
                                <div class="px-5 pb-4">
                                    <ul
                                        class="space-y-2 text-sm text-gray-600 list-disc marker:text-blue-600 ps-5 dark:text-neutral-400">
                                        <li>
                                            Masa tunggu 12 (dua belas) bulan setelah tanggal terbit ijazah
                                        </li>
                                        <li>
                                            Mahasiswa yang lulus sepanjang 1 (satu) tahun sebelum tahun anggaran yang
                                            sedang
                                            berjalan (lulusan sepanjang tahun 2022)
                                        </li>
                                        <li>
                                            Menggunakan pembanding UMP tahun 2023
                                        </li>
                                        <li>
                                            Provinsi yang dipakai adalah provinsi tempat bekerja lulusan
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
                                Kriteria Lanjut Studi
                            </button>
                            <div id="hs-basic-bordered-collapse-two"
                                class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                role="region" aria-labelledby="hs-bordered-heading-two">
                                <div class="px-5 pb-4">
                                    <ul
                                        class="space-y-2 text-sm text-gray-600 list-disc marker:text-blue-600 ps-5 dark:text-neutral-400">
                                        <li>
                                            Melanjutkan studi di prodi profesi, S1/D4 terapan, S2/S2 terapan, S3/S3
                                            terapan
                                            di dalam negeri atau luar negeri
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
                                Pembobotan
                            </button>
                            <div id="hs-basic-bordered-collapse-three"
                                class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                role="region" aria-labelledby="hs-bordered-heading-three">
                                <div class="px-5 pb-4">
                                    <div class="grid grid-cols-12 gap-4">
                                        <div class="col-span-12 md:col-span-6">
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
                                                                            Matriks Pembobotan untuk kriteria bekerja
                                                                        </p>
                                                                    </div>


                                                                </div>

                                                                <table
                                                                    class="min-w-full text-center divide-y divide-gray-200 dark:divide-neutral-700">
                                                                    <thead class="bg-gray-50 dark:bg-neutral-800">
                                                                        <tr>
                                                                            <th scope="col"
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-r dark:border-neutral-700 dark:text-neutral-400">
                                                                                Gaji / Masa Tunggu</th>
                                                                            <th scope="col"
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                                                ≤ 6 bulan</th>
                                                                            <th scope="col"
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                                                6 < Waktu Tunggu ≤ 12 bulan</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody
                                                                        class="divide-y divide-gray-200 dark:divide-neutral-700">
                                                                        <tr>
                                                                            <td
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-r dark:bg-neutral-800 bg-gray-50 dark:border-neutral-700 dark:text-neutral-400">
                                                                                Gaji ≥ 1.2x UMP</td>
                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                                                1.0</td>
                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                                                0.8</td>

                                                                        </tr>

                                                                        <tr>
                                                                            <td
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-r dark:bg-neutral-800 bg-gray-50 dark:border-neutral-700 dark:text-neutral-400">
                                                                                Gaji < 1.2x UMP</td>
                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                                                0.7</td>
                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                                                0.5</td>

                                                                        </tr>


                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 md:col-span-6">
                                            <div class="bg-white dark:bg-neutral-800">
                                                <div class="flex flex-col">
                                                    <div class="-m-1.5 overflow-x-auto">
                                                        <div class="p-1.5 min-w-full inline-block align-middle">
                                                            <div
                                                                class="overflow-hidden border rounded-lg dark:border-neutral-700">
                                                                <div
                                                                    class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
                                                                    <div>

                                                                        <p
                                                                            class="text-sm text-gray-600 dark:text-neutral-400">
                                                                            Matriks Pembobotan untuk kriteria wirausaha
                                                                        </p>
                                                                    </div>


                                                                </div>

                                                                <table
                                                                    class="min-w-full text-center divide-y divide-gray-200 dark:divide-neutral-700">
                                                                    <thead class="bg-gray-50 dark:bg-neutral-800">
                                                                        <tr>
                                                                            <th scope="col"
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-r dark:border-neutral-700 dark:text-neutral-400">
                                                                                Pendapatan / Masa Tunggu</th>
                                                                            <th scope="col"
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                                                ≤ 6 bulan</th>
                                                                            <th scope="col"
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                                                6 < Waktu Tunggu ≤ 12 bulan</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody
                                                                        class="divide-y divide-gray-200 dark:divide-neutral-700">
                                                                        <tr>
                                                                            <td
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-r dark:bg-neutral-800 bg-gray-50 dark:border-neutral-700 dark:text-neutral-400">
                                                                                Pendapatan ≥ 1.2x UMP</td>
                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                                                1.2</td>
                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                                                1.0</td>

                                                                        </tr>

                                                                        <tr>
                                                                            <td
                                                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-r dark:bg-neutral-800 bg-gray-50 dark:border-neutral-700 dark:text-neutral-400">
                                                                                Pendapatan < 1.2x UMP</td>
                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                                                1.0</td>
                                                                            <td
                                                                                class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                                                0.8</td>

                                                                        </tr>


                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12">
                <!-- Table Section -->

                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div
                                class="overflow-hidden bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                                <!-- Header -->
                                <div
                                    class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
                                    <div>
                                        <h2 class="text-lg font-medium text-gray-800 dark:text-neutral-200">
                                            Data Karya Dosen
                                        </h2>
                
                                    </div>
                                </div>
                                <div
                                    class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
                                    <div class="relative max-w-xs">
                                        <label for="hs-table-input-search" class="sr-only">Cari nama</label>
                                        <input wire:model.live.debounce.300ms="search" type="text" name="hs-table-search"
                                            id="hs-table-input-search"
                                            class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg ps-9 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Cari data">
                                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                                            <svg class="text-gray-400 size-4 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <path d="m21 21-4.3-4.3"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex items-center flex-1 space-x-2">
                                        <!-- Select -->
                
                                        <!-- End Select -->
                
                                        <!-- Select -->
                                        <select
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-20p-2.5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            wire:model.live='perPage'>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>
                                        <!-- End Select -->
                                    </div>
                
                                    <div>
                                        <div class="inline-flex gap-x-2">
                
                
                                            <button type="button" wire:click="modes"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-full cursor-pointer gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                                aria-haspopup="dialog" aria-expanded="false" aria-controls="ModalAddIku5"
                                                data-hs-overlay="#hs-scale-animation-modal">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12h14" />
                                                    <path d="M12 5v14" />
                                                </svg>
                                                Tambah Data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Header -->
                
                                <!-- Table -->
                                <div class="flex flex-col ">
                                    <div class="overflow-x-auto ">
                                        <div class="inline-block min-w-full align-middle">
                                            <div class="px-3 overflow-hidden">
                                                <table class="min-w-full">
                                                    <thead class="border-b border-gray-200 dark:border-neutral-700">
                                                        <tr>
                                                            @include('livewire.includes.kolom-table', [
                                                                'nama' => 'nama',
                                                                'displayname' => 'Nama Mahasiswa',
                                                            ])
                
                                                            @include('livewire.includes.kolom-table', [
                                                                'nama' => 'judul',
                                                                'displayname' => 'Judul Skripsi',
                                                            ])
                
                                                            @include('livewire.includes.kolom-table', [
                                                                'nama' => 'pembimbing_1',
                                                                'displayname' => 'Pembimbing 1',
                                                            ])
                
                
                                                            @include('livewire.includes.kolom-table', [
                                                                'nama' => 'pembimbing_2',
                                                                'displayname' => 'Pembimbing 2',
                                                            ])
                                                            
                
                
                                                            <th scope="col"
                                                                class="py-2 font-semibold group text-start focus:outline-none">
                                                                <div
                                                                    class="cursor-pointer py-1 px-2.5 inline-flex items-center border border-transparent text-sm text-gray-500 rounded-md hover:border-gray-200 dark:text-neutral-500 dark:hover:border-neutral-700">
                                                                    Action
                
                
                                                                </div>
                                                            </th>
                
                
                
                                                        </tr>
                                                    </thead>
                
                                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                                        @foreach ($a as $item)
                                                            <tr>
                                                                <td
                                                                    class="p-3 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                                    {{ $item->nama }}</td>
                                                                <td
                                                                    class="p-3 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                                    <span
                                                                        class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                
                                                                        {{ $item->judul }}
                                                                    </span>
                                                                </td>
                                                                <td
                                                                    class="p-3 text-sm text-gray-800 dark:text-neutral-200">
                                                                    {{ $item->pembimbing_1->user()->name }}</td>
                
                                                                <td
                                                                    class="p-3 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                                    {{ $item->pembimbing_2->user()->name }}</td>
                                                                
                                                               
                                                              
                                                                <td>
                                                                    <div class="flex gap-2">
                                                                        <div class="flex gap-2">
                                                                            <button aria-label="Close"
                                                                                data-hs-overlay="#hs-scale-animation-modal"
                                                                                wire:click="update({{ $item }})"
                                                                                class="object-center p-2.5 text-sm text-white bg-yellow-500 rounded-md hover:bg-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-500 hover:dark:bg-yellow-500/30"><svg
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    viewBox="0 0 24 24" fill="currentColor"
                                                                                    class="size-4">
                                                                                    <path
                                                                                        d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                                                                    <path
                                                                                        d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                                                                </svg>
                
                                                                            </button>
                                                                            <button wire:click="deleteskripsi({{ $item->id }})"
                                                                                class="p-2.5 text-center text-sm text-white bg-red-600 rounded-md hover:bg-red-700 dark:bg-red-500/10 dark:text-red-500 hover:dark:bg-red-500/30"><svg
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    viewBox="0 0 24 24" fill="currentColor"
                                                                                    class="size-4">
                                                                                    <path fill-rule="evenodd"
                                                                                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                                                        clip-rule="evenodd" />
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                
                
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                
                
                
                                    <div class="w-full px-6 py-4 border-t border-gray-200 d:items-center dark:border-neutral-700">
                                        {{ $a->links() }}
                                    </div>
                                </div>
                                <!-- End Table -->
                
                                <!-- Footer -->
                
                                <!-- End Footer -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Table Section -->
            </div>

        </div>



        <div id="hs-scale-animation-modal" wire:ignore.self
            class="hs-overlay hidden  size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
            role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
            <form wire:submit="save">
                <div
                    class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-3xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                    <div
                        class="flex flex-col w-full bg-white border shadow-sm pointer-events-auto rounded-xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                        <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                            <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800 dark:text-white">
                                {{ $mode == 'edit' ? 'Edit' : 'Tambah' }} Data Skripsi
                            </h3>
                            <button type="button" wire:click="cancelEdit"
                                class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                                aria-label="Close" data-hs-overlay="#hs-scale-animation-modal">
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
                                        Nama Mahasiswa
                                    </label>
                                </div>
                                <!-- End Col -->



                                <div class="sm:col-span-9">
                                    <div class="sm:flex">
                                        <input id="af-account-full-name" type="text"
                                            class="relative block w-full px-3 py-2 -mt-px text-sm border border-gray-200 rounded-lg shadow-sm pe-11 -ms-px sm:mt-0 sm:first:ms-0 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Masukkan nama lengkap mahasiswa" name="nama"
                                            wire:model="form.nama">

                                    </div>
                                    @error('name')
                                        <div class="text-sm text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- End Col -->

                                <div class="sm:col-span-3">
                                    <label for="af-account-gender-checkbox"
                                        class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                       Judul Skripsi
                                    </label>
                                </div>
                                <!-- End Col -->

                             

                                <div class="sm:col-span-9">
                                    <input id="judul" type="text"
                                        class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukkan judul skripsi" name="judul"
                                        wire:model="form.judul">
                                </div>
                                <!-- End Col -->

                                <div class="sm:col-span-3">
                                    <label for="af-account-password"
                                        class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                        Pembimbing 1
                                    </label>
                                </div>
                                <!-- End Col -->

                                <div class="sm:col-span-9">
                                    <div class="space-y-2">
                                        <select id="af-submit-app-category" name="pembimbing_1" wire:model="form.pembimbing_1"
                                            class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected>Pilih Dosen</option>
                                            @foreach ($dosen as $a)
                                            <option value="{{ $a->id }}">{{ $a->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <!-- End Col -->

                                <div class="sm:col-span-3">
                                    <label for="af-account-password"
                                        class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                        Pembimbing 2
                                    </label>
                                </div>
                                <!-- End Col -->

                                <div class="sm:col-span-9">
                                    <div class="space-y-2">
                                        <select id="af-submit-app-category" name="pembimbing_2" wire:model="form.pembimbing_2"
                                            class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected>Pilih Dosen</option>
                                            @foreach ($dosen as $a)
                                            <option value="{{ $a->id }}">{{ $a->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <!-- End Col -->


                               
                            </div>
                            <!-- End Grid -->



                        </div>
                        <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                            <button type="button"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                data-hs-overlay="#hs-scale-animation-modal">
                                Batal
                            </button>
                            <button type="submit" wire:loading.attr="disabled"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                Simpan
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

        @include('livewire.IKU.ikusatu-edit')

    </div>


</div>


