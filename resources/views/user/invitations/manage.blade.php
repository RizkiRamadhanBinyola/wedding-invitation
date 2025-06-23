<x-app-layout>
<main class="max-w-md mx-auto p-4">
    <h1 class="text-2xl font-bold text-center mb-6">{{ $invitation->nama_pria }} & {{ $invitation->nama_wanita }}</h1>

    <div class="grid grid-cols-3 gap-4">

        <a href="{{ route('invitations.pengantin.edit', $invitation->id) }}" class="tile">
            <i class="fa-solid fa-user-group text-2xl mb-2"></i>
            Pengantin
        </a>

        <a href="{{ route('invitations.tema.edit', $invitation->id) }}" class="tile">
            <i class="fa-solid fa-palette text-2xl mb-2"></i>
            Tema
        </a>

        <a href="{{ route('invitations.acara.edit', $invitation->id) }}" class="tile">
            <i class="fa-solid fa-calendar-days text-2xl mb-2"></i>
            Acara
        </a>

        {{-- Tambah menu lain jika sudah ada --}}
    </div>

    <style>
        .tile{display:flex;flex-direction:column;align-items:center;padding:1rem;border-radius:8px;
              background:#b1125c;color:#fff;font-size:.85rem;text-align:center}
        .tile:hover{background:#8c0d49}
    </style>
</main>
</x-app-layout>
