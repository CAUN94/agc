@props(['value'])

<label {{ $attributes->merge(['class' => 'mt-1.5 block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
