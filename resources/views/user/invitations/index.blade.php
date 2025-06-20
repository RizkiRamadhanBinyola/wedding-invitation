<x-app-layout>
    <div class="max-w-full overflow-x-auto p-3">
        <a href="{{ route('invitations.create') }}" class="btn btn-primary mb-4">+ Buat Undangan</a>

        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-2 text-left dark:bg-meta-4">
                    <th class="min-w-[220px] px-4 py-4 font-medium">Judul</th>
                    {{-- ganti label --}}
                    <th class="min-w-[150px] px-4 py-4 font-medium">Dibuat</th>
                    <th class="min-w-[120px] px-4 py-4 font-medium">Tema</th>
                    <th class="px-4 py-4 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invitations as $inv)
                    <tr>
                        <td class="border-b px-4 py-5">{{ $inv->nama_pria }} &amp; {{ $inv->nama_wanita }}</td>

                        {{-- tampilkan created_at --}}
                        <td class="border-b px-4 py-5">
                            {{ $inv->created_at->format('d M Y') }}
                        </td>

                        <td class="border-b px-4 py-5">{{ $inv->theme->name }}</td>

                        <td class="border-b px-4 py-5">
                            <div class="flex items-center space-x-3.5">
                                <a href="{{ route('invitations.edit', $inv->id) }}">✏️</a>
                                <a href="/{{ $inv->slug }}" target="_blank">👁️</a>
                                <form method="POST" action="{{ route('invitations.destroy', $inv->id) }}"
                                      onsubmit="return confirm('Yakin ingin menghapus undangan ini?')">
                                    @csrf @method('DELETE')
                                    <button>🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $invitations->links() }}</div>
    </div>
</x-app-layout>
