@php($isEdit = isset($invitation))

<form action="{{ $action }}" method="POST" class="flex flex-col gap-5.5 p-6.5">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    {{-- PILIH PEMILIK --}}
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Pemilik (User)
        </label>
        <select name="user_id"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white"
            required>
            @foreach($users as $u)
                <option value="{{ $u->id }}"
                    {{ old('user_id', $invitation->user_id ?? '') == $u->id ? 'selected' : '' }}>
                    {{ $u->name }} — {{ $u->email }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- FIELD INTI --}}
    @include('invitations.fields', [
        'data'   => $invitation ?? null,
        'themes' => $themes
    ])

    <button type="submit"
        class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90">
        {{ $buttonText }}
    </button>
</form>
