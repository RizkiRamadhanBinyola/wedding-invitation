{{-- resources/views/invitations/sections/tema.blade.php --}}
<x-app-layout>
<main class="max-w-xl mx-auto p-6">
    <h2 class="text-xl font-semibold mb-6">Ganti Tema</h2>

    @if(session('success'))
        <div class="mb-4 rounded bg-green-100 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('invitations.tema.update', $invitation->id) }}"
          class="space-y-5">
        @csrf @method('PUT')

        <div>
            <label class="mb-2 block text-sm font-medium">Pilih Tema</label>
            <select name="theme_id"
                    class="w-full rounded border px-3 py-2"
                    required>
                @foreach($themes as $t)
                    <option value="{{ $t->id }}"
                        {{ $invitation->theme_id == $t->id ? 'selected' : '' }}>
                        {{ $t->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-3">
            <x-button>Ganti Tema</x-button>
            <a href="{{ route('themes.preview', $invitation->theme->slug) }}"
               target="_blank" class="self-center text-sm text-blue-600">Preview</a>
        </div>
    </form>
</main>
</x-app-layout>
