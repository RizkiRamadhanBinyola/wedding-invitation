<x-app-layout>
<main class="max-w-3xl mx-auto p-4">
    <h2 class="text-xl font-semibold mb-4">Galeri Foto</h2>

    @if(session('success'))
        <div class="mb-3 rounded bg-green-100 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form upload --}}
    <form action="{{ route('invitations.galeri.store',$invitation->id) }}"
          method="POST" enctype="multipart/form-data"
          class="mb-6 space-y-3">
        @csrf
        <input type="file" name="image" required>
        <input type="text" name="caption"
               placeholder="Caption (opsional)"
               class="border rounded px-2 py-1 w-full">
        <x-button>Upload</x-button>
    </form>

    {{-- List foto --}}
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($invitation->galleries as $g)
            <div class="relative">
                <img src="{{ asset('storage/'.$g->path) }}"
                     alt="" class="w-full h-40 object-cover rounded">
                @if($g->caption)
                    <p class="text-sm mt-1">{{ $g->caption }}</p>
                @endif
                <form method="POST"
                      action="{{ route('invitations.galeri.destroy',
                               [$invitation->id,$g->id]) }}"
                      onsubmit="return confirm('Hapus foto?')"
                      class="absolute top-1 right-1">
                    @csrf @method('DELETE')
                    <button class="text-red-600 bg-white/80 rounded-full px-2">✕</button>
                </form>
            </div>
        @endforeach
    </div>
</main>
</x-app-layout>
