@php($isEdit = isset($invitation))
<form action="{{ $action }}" method="POST" class="flex flex-col gap-5">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    {{-- FIELD INTI (tidak ada pemilik) --}}
    @include('invitations.fields', ['data' => $invitation ?? null, 'themes' => $themes])

    <button class="rounded bg-primary px-6 py-2 text-white">{{ $buttonText }}</button>
</form>
