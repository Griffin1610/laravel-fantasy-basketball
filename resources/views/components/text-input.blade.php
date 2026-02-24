@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-600 bg-gray-800 text-[#EDEDEC] focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm']) }}>
