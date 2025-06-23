<x-app-layout>
    <main class="max-w-xl mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">Data Pengantin</h2>

        @if(session('success'))
        <div class="mb-3 rounded bg-green-100 p-3 text-green-700">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('invitations.pengantin.update', $invitation->id) }}"
            method="POST" class="space-y-4">
            @csrf @method('PUT')

            <x-input label="Nama Pria" name="nama_pria" :value="$invitation->nama_pria" />
            <x-input label="Nama Wanita" name="nama_wanita" :value="$invitation->nama_wanita" />
            <x-input label="Ortu Pria" name="ortu_pria" :value="$invitation->ortu_pria" />
            <x-input label="Ortu Wanita" name="ortu_wanita" :value="$invitation->ortu_wanita" />
            <x-input label="Anak ke-" name="anak_ke" :value="$invitation->anak_ke" />

            <x-button>Simpan</x-button>
            <a href="{{ route('invitations.index') }}" class="text-sm text-blue-600">← Kembali</a>
        </form>
    </main>
</x-app-layout>