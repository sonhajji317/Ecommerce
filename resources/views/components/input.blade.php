@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-stone-700 focus:border-stone-700 focus:ring-stone-700 rounded-md shadow-sm',
]) !!}>
