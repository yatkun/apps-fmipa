<div>
    <div id="iku1-edit-modal" wire:ignore.self
        class="hs-overlay hidden  size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="iku1-edit-modal-label">

        <form wire:submit="save">
            <div
                class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-3xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                <div
                    class="flex flex-col w-full bg-white border shadow-sm pointer-events-auto rounded-xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                        <h3 id="iku1-edit-modal-label" class="font-bold text-gray-800 dark:text-white">
                            Edit Data IKU 1
                        </h3>
                        <button type="button" wire:click="cancelEdit"
                            class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                            aria-label="Close" data-hs-overlay="#iku1-edit-modal">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
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
                                        placeholder="Masukkan nama lengkap alumni" name="nama"
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
                                    Program Studi
                                </label>
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-9">
                                <div class="sm:flex">
                                    <label for="matematika"
                                        class="relative flex w-full px-3 py-2 -mt-px text-sm border border-gray-200 shadow-sm -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <input type="radio" name="program_studi"
                                            class="shrink-0 mt-0.5 border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-500 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                            id="matematika" checked wire:model="form.program_studi" value="Matematika">
                                        <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Matematika</span>
                                    </label>

                                    <label for="statistika"
                                        class="relative flex w-full px-3 py-2 -mt-px text-sm border border-gray-200 shadow-sm -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <input type="radio" name="program_studi"
                                            class="shrink-0 mt-0.5 border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-500 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                            id="statistika" wire:model="form.program_studi" value="Statistika">
                                        <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Statistika</span>
                                    </label>
                                    <label for="aktuaria"
                                        class="relative flex w-full px-3 py-2 -mt-px text-sm border border-gray-200 shadow-sm -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <input type="radio" name="program_studi"
                                            class="shrink-0 mt-0.5 border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-500 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                            id="aktuaria" wire:model=form.program_studi" value="Aktuaria">
                                        <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Aktuaria</span>
                                    </label>

                                    <label for="bioteknologi"
                                        class="relative flex w-full px-3 py-2 -mt-px text-sm border border-gray-200 shadow-sm -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <input type="radio" name="program_studi"
                                            class="shrink-0 mt-0.5 border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-500 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                            id="bioteknologi" wire:model="form.program_studi" value="Bioteknologi">
                                        <span
                                            class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Bioteknologi</span>
                                    </label>
                                </div>
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-3">
                                <label for="tanggal_lulus"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Tanggal Lulus
                                </label>
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-9">
                                <input id="tanggal_lulus" type="date"
                                    class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="masukkan tanggal lulus" name="tanggal_lulus"
                                    wire:model="form.tanggal_lulus">
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-3">
                                <label for="af-account-password"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Pekerjaan
                                </label>
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-9">
                                <div class="space-y-2">
                                    <select id="af-submit-app-category" name="pekerjaan" wire:model="form.pekerjaan"
                                        class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option selected>Pilih pekerjaan</option>
                                        <option value="Bekerja">Bekerja</option>
                                        <option value="Wirausaha">Wirausaha</option>
                                        <option value="Lanjut studi">Lanjut studi</option>

                                    </select>
                                </div>
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-3">
                                <label for="af-account-password"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Pendapatan
                                </label>
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-9">
                                <div class="sm:flex">
                                    <input id="pendapatan" type="text"
                                        class="relative block w-full px-3 py-2 -mt-px text-sm border border-gray-200 rounded-lg shadow-sm pe-11 -ms-px sm:mt-0 sm:first:ms-0 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Masukkan gaji / pendapatan" name="pendapatan"
                                        wire:model="form.pendapatan">

                                </div>

                            </div>
                            <!-- End Col -->


                            <div class="sm:col-span-3">
                                <label for="af-account-password"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Masa tunggu
                                </label>
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-9">
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <select name="masa_tunggu" id="af-submit-app-category"
                                            wire:model="form.masa_tunggu"
                                            class="block w-full px-3 py-2 text-sm border border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected>Pilih masa tunggu</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>

                                        </select>
                                        <div class="w-1/2 ml-2 text-sm text-gray-800 dark:text-neutral-200">
                                            Bulan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Grid -->



                    </div>
                    <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 dark:border-neutral-700">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                            data-hs-overlay="#iku1-edit-modal">
                            Batal
                        </button>
                        <button type="submit" wire:click="update"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Update
                        </button>
                    </div>

                </div>
            </div>
        </form>

    </div>
</div>
