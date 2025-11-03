@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-blue-600 text-start text-base font-medium text-[#EDEDEC] bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700 focus:border-blue-700 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-400 hover:text-[#EDEDEC] hover:bg-gray-800 hover:border-gray-600 focus:outline-none focus:text-[#EDEDEC] focus:bg-gray-800 focus:border-gray-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
