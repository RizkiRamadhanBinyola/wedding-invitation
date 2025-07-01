<section class="my-12 max-w-xl mx-auto px-4">
    <h2 class="text-2xl font-semibold mb-4 text-center">Ucapan & Doa</h2>

    {{-- Daftar ucapan --}}
    @if($invitation->greetings->isEmpty())
        <p class="text-center text-gray-500">Belum ada ucapan.</p>
    @else
        <div class="space-y-4">
            @foreach($invitation->greetings as $greeting)
                <div class="border p-4 rounded bg-gray-100 shadow">
                    <p class="font-semibold text-pink-700">{{ $greeting->nama_pengirim }}</p>
                    <p class="text-gray-700">{{ $greeting->isi_ucapan }}</p>
                    <p class="text-xs text-gray-500">{{ $greeting->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Form ucapan --}}
    <form method="POST" action="{{ route('greetings.public', $invitation->slug) }}" class="mt-8 space-y-4">
        @csrf
        <input type="text" name="nama_pengirim" placeholder="Nama Anda" required
            class="w-full border border-gray-300 p-2 rounded focus:outline-pink-500">
        
        <textarea name="isi_ucapan" rows="4" placeholder="Tulis ucapan dan doa..." required
            class="w-full border border-gray-300 p-2 rounded focus:outline-pink-500"></textarea>
        
        <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700 w-full">
            Kirim Ucapan
        </button>
    </form>

    @if(session('success'))
        <div class="mt-4 text-green-600 text-center font-semibold">
            {{ session('success') }}
        </div>
    @endif
</section>
