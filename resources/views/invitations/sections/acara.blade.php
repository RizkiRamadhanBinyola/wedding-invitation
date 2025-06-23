{{-- resources/views/invitations/sections/acara.blade.php --}}
<x-app-layout>
<main class="max-w-xl mx-auto p-6">
    <h2 class="text-xl font-semibold mb-6">Data Acara</h2>

    @if(session('success'))
        <div class="mb-4 rounded bg-green-100 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('invitations.acara.update', $invitation->id) }}"
          class="space-y-5">
        @csrf @method('PUT')

        <x-input label="Tanggal Acara" name="tanggal"
                 type="date" :value="$invitation->tanggal->format('Y-m-d')"/>
        <x-input label="Lokasi"         name="lokasi"         :value="$invitation->lokasi"/>
        <x-input label="Waktu Akad"     name="waktu_akad"     :value="$invitation->waktu_akad"/>
        <x-input label="Waktu Resepsi"  name="waktu_resepsi"  :value="$invitation->waktu_resepsi"/>

        <div class="flex gap-3">
            <x-button>Simpan</x-button>
            <a href="{{ route('invitations.index') }}"
               class="self-center text-sm text-blue-600">← Kembali</a>
        </div>
    </form>
</main>
</x-app-layout>
