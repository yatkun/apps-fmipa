<th scope="col" class="py-2 font-semibold group text-start focus:outline-none">
    <div wire:click="setsortBy('{{ $nama }}')"
        class="cursor-pointer py-1 px-2.5 inline-flex items-center border border-transparent text-sm text-gray-500 rounded-md hover:border-gray-200 dark:text-neutral-500 dark:hover:border-neutral-700">
       {{  $displayname }}

        @if ($sortBy !== $nama)
            <svg class="size-3.5 ms-1 -me-0.5 text-gray-400 dark:text-neutral-500"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path class="hs-datatable-ordering-asc:text-blue-600 dark:hs-datatable-ordering-asc:text-blue-500"
                    d="m7 15 5 5 5-5"></path>
                <path
                    class="hs-datatable-ordering-desc:text-blue-600 dark:hs-datatable-ordering-desc:text-blue-500"
                    d="m7 9 5-5 5 5"></path>
            </svg>
        @elseif($sortDir === 'ASC')
            <svg class="size-3.5 ms-1 -me-0.5 text-gray-400 dark:text-neutral-500"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path class=" dark:hs-datatable-ordering-asc:text-blue-500"
                    d="m7 15 5 5 5-5"></path>
                <path
                    class="text-blue-600 dark:hs-datatable-ordering-desc:text-blue-500"
                    d="m7 9 5-5 5 5"></path>
            </svg>
        @else
        <svg class="size-3.5 ms-1 -me-0.5 text-gray-400 dark:text-neutral-500"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path class="text-blue-600 dark:hs-datatable-ordering-asc:text-blue-500"
                    d="m7 15 5 5 5-5"></path>
                <path
                    class=" dark:hs-datatable-ordering-desc:text-blue-500"
                    d="m7 9 5-5 5 5"></path>
            </svg>
        @endif
        
    </div>
</th>