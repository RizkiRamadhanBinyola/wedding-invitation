

@props(['type'=>'submit'])
<button
    {{ $attributes->merge(['class'=>'rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700']) }}
    type="{{ $type }}"
>
    {{ $slot }}
</button>
