<x-app-layout>
    <div class="p-3">
        <a href="{{ route('invitations.create') }}" class="btn btn-primary mb-4">
            + Tambah Undangan
        </a>

        <table class="w-full table-auto text-sm">
            <thead>
                <tr class="bg-gray-2 text-left dark:bg-meta-4">
                    <th class="px-4 py-3">Judul</th>
                    {{-- ubah label kolom --}}
                    <th class="px-4 py-3">Dibuat</th>
                    <th class="px-4 py-3">Tema</th>
                    <th class="px-4 py-3">Pembuat</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($invitations as $inv)
                <tr>
                    <td class="border-b px-4 py-4">
                        {{ $inv->nama_pria }} & {{ $inv->nama_wanita }}
                    </td>

                    {{-- gunakan created_at --}}
                    <td class="border-b px-4 py-4">
                        {{ $inv->created_at->format('d M Y') }}
                    </td>

                    <td class="border-b px-4 py-4">{{ $inv->theme->name }}</td>

                    <td class="border-b px-4 py-4">
                        <div class="font-medium">{{ $inv->user->name }}</div>
                        <div class="text-xs text-bodydark2">{{ $inv->user->email }}</div>
                    </td>

                    <td class="border-b px-4 py-4">
                        <a href="{{ route('invitations.edit', $inv->id) }}">✏️</a>
                        <a href="/{{ $inv->slug }}" target="_blank">👁️</a>
                        <form class="inline" method="POST"
                              action="{{ route('invitations.destroy', $inv->id) }}"
                              onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button>🗑️</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="py-6 text-center">Belum ada undangan.</td></tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $invitations->links() }}</div>
    </div>
</x-app-layout>
