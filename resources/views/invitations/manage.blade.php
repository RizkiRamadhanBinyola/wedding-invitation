<x-app-layout>
<main class="p-4">
    <a href="{{ route('invitations.index') }}" class="text-sm text-blue-600 mb-4 inline-block">
        ← Kembali ke daftar
    </a>

    <section class="max-w-md mx-auto text-center">
        <h2 class="text-2xl font-bold mb-6">
            {{ $invitation->nama_pria }} &amp; {{ $invitation->nama_wanita }}
        </h2>

        {{-- GRID MENU --}}
        <div class="grid grid-cols-3 gap-4">

            @php($id = $invitation->id)

            <a href="{{ route('invitations.pengantin.edit',  $id) }}" class="menu-tile">👩‍❤️‍👨 <span>Pengantin</span></a>
            <a href="{{ route('invitations.tema.edit',       $id) }}" class="menu-tile">🎨 <span>Tema</span></a>
            <a href="{{ route('invitations.acara.edit',      $id) }}" class="menu-tile">📅 <span>Acara</span></a>

            <a href="{{ route('invitations.galeri.edit',     $id) }}" class="menu-tile">🖼️ <span>Galeri</span></a>
            <a href="{{ route('invitations.musik.edit',      $id) }}" class="menu-tile">🎵 <span>Musik</span></a>
            <a href="{{ url('/'.$invitation->slug) }}"        class="menu-tile" target="_blank">👁️ <span>Preview</span></a>

            {{-- Contoh slot kosong --}}
            <div class="menu-tile opacity-40 cursor-not-allowed">📦 <span>Kado</span></div>
            <div class="menu-tile opacity-40 cursor-not-allowed">💌 <span>RSVP</span></div>
            <div class="menu-tile opacity-40 cursor-not-allowed">⚙️ <span>Setting</span></div>
        </div>
    </section>
</main>

{{-- Tailwind mini helper --}}
<style>
    .menu-tile{
        @apply flex flex-col items-center justify-center rounded-lg bg-primary text-white h-28 space-y-1
               hover:bg-opacity-80 transition;
    }
    .menu-tile span{ @apply text-sm; }
</style>
</x-app-layout>
