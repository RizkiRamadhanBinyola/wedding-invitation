{{-- resources/views/invitations/sections/musik.blade.php --}}
<x-app-layout>
<main class="max-w-xl mx-auto p-6">
    <h2 class="text-xl font-semibold mb-6">Latar Musik</h2>

    @if(session('success'))
        <div class="mb-4 rounded bg-green-100 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('invitations.musik.update', $invitation->id) }}"
          class="space-y-5">
        @csrf @method('PUT')

        <x-input label="URL / Judul Lagu"
                 name="musik" :value="$invitation->musik" />

        <div class="flex gap-3">
            <x-button>Simpan</x-button>
            <a href="{{ route('invitations.index') }}"
               class="self-center text-sm text-blue-600">← Kembali</a>
        </div>
    </form>
</main>
</x-app-layout>
