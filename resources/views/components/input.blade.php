
@props(['label','name','value'=>'','type'=>'text'])

<div>
    <label class="mb-2 block text-sm font-medium">{{ $label }}</label>
    <input
        {{ $attributes->merge(['class'=>'w-full rounded border px-3 py-2']) }}
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        required
    >
</div>
