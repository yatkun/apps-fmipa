<div>
    <li class="hs-accordion" id="{{ $id }}">
        <button type="button"
            class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-3 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:text-neutral-200"
            aria-expanded="true" aria-controls="{{ $id }}-child">
           {{ $icon }}
            {{ $label }}

            <svg class="hidden hs-accordion-active:block ms-auto size-4" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="m18 15-6-6-6 6" />
            </svg>

            <svg class="block hs-accordion-active:hidden ms-auto size-4" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6" />
            </svg>
        </button>

        <div id="{{ $id }}-child"
            class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden" role="region"
            aria-labelledby="{{ $id }}">
            <ul class="pt-1 space-y-1 hs-accordion-group ps-8" data-hs-accordion-always-open>
                {{ $slot }}
            </ul>
        </div>
    </li>

</div>
