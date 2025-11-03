@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#EDEDEC]']) }}>
    {{ $value ?? $slot }}
</label>
