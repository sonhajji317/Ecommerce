@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-amber-200']) }}>
    {{ $value ?? $slot }}
</label>
