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
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">IKU 4 : Kualifikasi Dosen / Pengajar
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">Persentase dosen yang memiliki sertifikat kompetensi/profesi yang diakui oleh dunia usaha/industri atau pengajar yang berasal dari kalangan praktisi profesional, dunia usaha/industri
                            </p>
                        </div>


                    </div>
                    <!-- End Header -->
                    <div class="hs-accordion-group">
                        <div class="-mt-px bg-white border border-t border-b-0 border-l-0 border-r-0 hs-accordion dark:bg-neutral-800 dark:border-neutral-700"
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
                                            Dosen yang bekerja di perguruan tinggi dan mempunyai NIDN, NIDK, atau NUP
                                        </li>
                                        <li>
                                            Sertifikasi kompetensi atau profesi yang dihitung adalah yang masih berlaku pada tahun perhitungan IKU
                                        </li>
                                        <li>
                                            Kegiatan praktisi yang dihitung adalah yang dilakukan selama tahun 2023
                                        </li>
                                        <li>
                                            Akan ditambahkan data dari praktisi mengajar flagship dan mandiri
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                       

                    </div>
                </div>
            </div>

            <div class="col-span-12">
                @include('livewire.includes.tables.table-iku4')
            </div>


        </div>

    </div>

    <div id="ModalAddIku4" wire:ignore.self
        class="hs-overlay hidden  size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="ModalAddIku4-label">
        <form wire:submit="save">
            <div
                class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-3xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                <div
                    class="flex flex-col w-full bg-white border shadow-sm pointer-events-auto rounded-xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                        <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800 dark:text-white">
                            {{ $mode == 'edit' ? 'Edit' : 'Tambah' }} Data IKU 4 | Kualifakasi Dosen / Pengajar
                        </h3>
                        <button type="button" wire:click="cancelEdit"
                            class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                            aria-label="Close" data-hs-overlay="#ModalAddIku4">
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
                                    Nama Lengkap
                                </label>
                            </div>
                            <!-- End Col -->



                            <div class="sm:col-span-9">
                                <div class="sm:flex">
                                    <input id="af-account-full-name" type="text"
                                        class="relative block w-full px-3 py-2 -mt-px text-sm border border-gray-200 rounded-lg shadow-sm pe-11 -ms-px sm:mt-0 sm:first:ms-0 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukkan nama lengkap" name="nama"
                                        wire:model="form.nama">

                                </div>
                            </div>
                            <!-- End Col -->

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
                                    <option name="kriteria" value="Memiliki Sertifikasi">DOSEN dengan NIDN/NIDK memiliki sertifikasi kompetensi / profesi</option>
                                    <option name="kriteria" value="Belum Memiliki Sertifikasi">DOSEN dengan NIDN/NIDK belum memiliki sertifikasi kompetensi / profesi</option>
                                    <option name="kriteria" value="Praktisi">Pengajar dari kalangan praktisi profesional, dunia usaha/industri</option>
                                   
                                 
                                  </select>
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

                            <div class="sm:col-span-3">
                                <label for="bukti"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Bukti Dokumen
                                </label>
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-9">
                                <input id="bukti" type="text"
                                    class="block w-full px-3 py-2 text-sm text-gray-800 border border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    name="bukti" wire:model="form.bukti" placeholder="Masukkan link google drive">
                            </div>


                        </div>
                        <!-- End Grid -->



                    </div>
                    <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                        <button type="button" wire:click="cancelEdit"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                            data-hs-overlay="#ModalAddIku4">
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
