<x-app-layout>
    <div class="max-w-full overflow-x-auto p-3">
        <a href="{{ route('invitations.create') }}" class="btn btn-primary">+ Buat Undangan</a>
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-2 text-left dark:bg-meta-4">
                    <th class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11">
                        Judul
                    </th>
                    <th class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">
                        Tanggal
                    </th>
                    <th class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">
                        Tema
                    </th>
                    <th class="px-4 py-4 font-medium text-black dark:text-white">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($invitations as $item)
                    <tr>
                        <td class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark xl:pl-11">
                            <h5 class="font-medium text-black dark:text-white">{{ $item->nama_pria }} &amp; {{ $item->nama_wanita }}</h5>
                        </td>
                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</p>
                        </td>
                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{ $item->theme->name }}</p>
                        </td>
                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <div class="flex items-center space-x-3.5">
                                <a href="{{ route('invitations.edit', $item->id) }}" class="hover:text-primary" title="Edit">
                                    ✏️
                                </a>
                                <a href="/{{ $item->slug }}" class="hover:text-primary" title="Preview" target="_blank">
                                    👁️
                                </a>
                                <form method="POST" action="{{ route('invitations.destroy', $item->id) }}" onsubmit="return confirm('Yakin ingin menghapus undangan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="hover:text-primary" title="Hapus">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
