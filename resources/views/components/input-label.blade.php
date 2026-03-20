@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-ink']) }}>
    {{ $value ?? $slot }}
</label>
