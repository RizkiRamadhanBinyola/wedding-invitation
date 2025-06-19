@php($isEdit = isset($invitation))
<form action="{{ $action }}" method="POST" class="flex flex-col gap-5">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    {{-- PILIH PEMILIK --}}
    <div>
        <label class="mb-2 block text-sm font-medium">Pemilik (User)</label>
        <select name="user_id" class="w-full rounded border px-4 py-2" required>
            @foreach($users as $u)
                <option value="{{ $u->id }}"
                    {{ old('user_id', $invitation->user_id ?? '') == $u->id ? 'selected' : '' }}>
                    {{ $u->name }} — {{ $u->email }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- FIELD INTI --}}
    @include('invitations.fields', ['data' => $invitation ?? null, 'themes' => $themes])

    <button class="rounded bg-primary px-6 py-2 text-white">{{ $buttonText }}</button>
</form>
