<x-app-layout>
    <div class="max-w-full overflow-x-auto p-3">
        <div class="mb-4 flex items-center justify-between">
            <h3 class="text-lg font-semibold">Daftar User</h3>
            <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah User</a>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded bg-green-100 px-4 py-3 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-2 text-left dark:bg-meta-4">
                    <th class="px-4 py-4 font-medium">Nama</th>
                    <th class="px-4 py-4 font-medium">Email</th>
                    <th class="px-4 py-4 font-medium">Role</th>
                    <th class="px-4 py-4 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="border-b px-4 py-3">{{ $user->name }}</td>
                        <td class="border-b px-4 py-3">{{ $user->email }}</td>
                        <td class="border-b px-4 py-3 capitalize">{{ $user->role }}</td>
                        <td class="border-b px-4 py-3">
                            <div class="flex items-center space-x-3.5">                                
                                <a href="{{ route('users.edit', $user) }}" class="hover:text-primary" title="Edit">✏️</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                    @csrf @method('DELETE')
                                    <button class="hover:text-primary" title="Hapus">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada data user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>