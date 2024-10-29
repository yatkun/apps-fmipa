@props(['active' => false, 'href' => '#', 'label' => ''])


@php
    $classes = $active ? 'bg-gray-100' : '';
@endphp


<div>
    <li>
        <a wire:navigate class="flex items-center gap-x-3.5 py-3 px-2.5 {{ $classes }}  text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-700 dark:text-white"
           href="{{ $href }}">
            {{$slot}}
            {{ $label }}
        </a>
    </li>    
</div>