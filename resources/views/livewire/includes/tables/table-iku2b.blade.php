<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div
                class="overflow-hidden bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <!-- Header -->
                <div
                    class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
                    <div class="relative max-w-xs">
                        <label for="hs-table-input-search" class="sr-only">Cari nama</label>
                        <input wire:model.live.debounce.300ms="searchb" type="text" name="hs-table-search"
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


                            <a class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-full gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                aria-haspopup="dialog" aria-expanded="false"
                                aria-controls="ModalAddIku2b" data-hs-overlay="#ModalAddIku2b">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14" />
                                    <path d="M12 5v14" />
                                </svg>
                                Tambah Data
                            </a>
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
                                                'displayname' => 'Nama Lengkap',
                                            ])

                                            @include('livewire.includes.kolom-table', [
                                                'nama' => 'program_studi',
                                                'displayname' => 'Program Studi',
                                            ])

                                            @include('livewire.includes.kolom-table', [
                                                'nama' => 'sks_juara',
                                                'displayname' => 'Juara',
                                            ])
                                            @include('livewire.includes.kolom-table', [
                                                'nama' => 'level',
                                                'displayname' => 'Level',
                                            ])

                                            @include('livewire.includes.kolom-table', [
                                                'nama' => 'keterangan',
                                                'displayname' => 'Keterangan',
                                            ])

                                            @include('livewire.includes.kolom-table', [
                                                'nama' => 'bobot',
                                                'displayname' => 'Bobot',
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
                                        @foreach ($b as $item)
                                            <tr>
                                                <td
                                                    class="p-3 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                    {{ $item->nama }}</td>
                                                <td
                                                    class="p-3 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                    <span
                                                        class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">

                                                        {{ $item->program_studi }}
                                                    </span>
                                                </td>
                                                <td
                                                    class="p-3 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                    {{ $item->sks_juara }}</td>
                                                <td
                                                    class="p-3 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                    {{ $item->level }}</td>
                                                <td
                                                    class="p-3 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                    {{ $item->keterangan }}</td>
                                                <td
                                                    class="p-3 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                    {{ $item->bobot }}</td>
                                                <td>
                                                    <div class="flex gap-2">
                                                        <button aria-label="Close" data-hs-overlay="#iku1-edit-modal"
                                                            wire:click="updateiku1({{ $item }})"
                                                            class="px-2 py-1 text-sm text-white bg-yellow-600 rounded-md hover:bg-yellow-700 dark:bg-yellow-500/10 dark:text-yellow-500 hover:dark:bg-yellow-500/30">Edit</button>
                                                        <button wire:click="deleteIku1({{ $item->id }})"
                                                            class="px-2 py-1 text-sm text-white bg-red-600 rounded-md hover:bg-red-700 dark:bg-red-500/10 dark:text-red-500 hover:dark:bg-red-500/30">Hapus</button>
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
