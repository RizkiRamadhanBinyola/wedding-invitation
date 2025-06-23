<x-app-layout>
    <div class="max-w-full overflow-x-auto p-3">
        <a href="{{ route('invitations.create') }}" class="btn btn-primary mb-4">+ Tambah Undangan</a>

        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-2 text-left dark:bg-meta-4">
                    <th class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11">
                        Judul
                    </th>
                    <th class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">
                        Dibuat
                    </th>
                    <th class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">
                        Tema
                    </th>
                    <th class="min-w-[200px] px-4 py-4 font-medium text-black dark:text-white">
                        Pembuat
                    </th>
                    <th class="px-4 py-4 font-medium text-black dark:text-white">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invitations as $inv)
                <tr>
                    <td class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark xl:pl-11">
                        <h5 class="font-medium text-black dark:text-white">
                            {{ $inv->nama_pria }} & {{ $inv->nama_wanita }}
                        </h5>
                    </td>
                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                        <p class="text-black dark:text-white">
                            {{ $inv->created_at->format('d M Y') }}
                        </p>
                    </td>
                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                        <p class="text-black dark:text-white">{{ $inv->theme->name }}</p>
                    </td>
                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                        <div class="font-medium text-black dark:text-white">{{ $inv->user->name }}</div>
                        <div class="text-xs text-bodydark2">{{ $inv->user->email }}</div>
                    </td>
                    <td class="border-b px-4 py-5">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('invitations.kelola', $inv->id) }}"
                                class="inline-flex items-center justify-center gap-2.5 rounded-full border border-primary
                  px-4 py-2 text-primary hover:bg-opacity-90">
                                🛠️<small>Kelola</small>
                            </a>
                            <a href="/{{ $inv->slug }}" target="_blank"
                                class="inline-flex items-center justify-center gap-2.5 rounded-full border border-primary
                  px-4 py-2 text-primary hover:bg-opacity-90">
                                👁️<small>Preview</small>
                            </a>
                        </div>
                    </td>


                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-6 text-center">Belum ada undangan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $invitations->links() }}</div>
    </div>
</x-app-layout>