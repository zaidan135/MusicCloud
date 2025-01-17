@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-primary']) }}>
    {{ $value ?? $slot }}
</label>
