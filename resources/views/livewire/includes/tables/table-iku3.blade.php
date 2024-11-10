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
                            Data Mahasiswa Berkegiatan di Luar Program Studi
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
                                aria-haspopup="dialog" aria-expanded="false" aria-controls="ModalAddIku3"
                                data-hs-overlay="#ModalAddIku3">
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
                                                'displayname' => 'Nama Lengkap',
                                            ])

                                            @include('livewire.includes.kolom-table', [
                                                'nama' => 'kriteria',
                                                'displayname' => 'Kriteria',
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
                                        @foreach ($a as $item)
                                            <tr>
                                                <td
                                                    class="p-3 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                    {{ $item->nama }}</td>
                                                <td
                                                    class="p-3 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                    <span
                                                        class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">

                                                        {{ $item->kriteria }}
                                                    </span>
                                                </td>
                                                <td
                                                    class="p-3 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                    {{ $item->keterangan }}</td>

                                                <td
                                                    class="p-3 text-sm text-gray-800 whitespace-nowrap dark:text-neutral-200">
                                                    {{ $item->bobot }}</td>
                                                <td>
                                                    <div class="flex gap-2">
                                                        <div class="flex gap-2">
                                                            <button aria-label="Close"
                                                                data-hs-overlay="#iku1-edit-modal"
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
                                                            <button wire:click="deleteIku3({{ $item->id }})"
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
