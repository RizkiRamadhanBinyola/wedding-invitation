<x-app-layout>
    <div class="max-w-full overflow-x-auto p-3">
        <a href="{{ route('themes.create') }}" class="btn btn-primary">+ Tambah Tema</a>
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-2 text-left dark:bg-meta-4">
                    <th class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11">
                        Nama
                    </th>
                    <th class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">
                        Slug
                    </th>
                    <th class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">
                        Preview
                    </th>
                    <th class="px-4 py-4 font-medium text-black dark:text-white">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($themes as $theme)
                    <tr>
                        <td class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark xl:pl-11">
                            <h5 class="font-medium text-black dark:text-white">{{ $theme->name }}</h5>
                        </td>
                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <p class="text-black dark:text-white">{{ $theme->slug }}</p>
                        </td>
                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            {{-- Contoh: tampilkan preview gambar tema --}}
                            <img src="{{ asset($theme->preview) }}" alt="Preview Tema" width="200">

                        </td>
                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <div class="flex items-center space-x-3.5">
                                <a href="{{ route('themes.edit', $theme->id) }}" class="hover:text-primary"
                                    title="Edit">
                                    ✏️
                                </a>
                                <a href="{{ route('themes.preview', $theme->slug) }}" class="hover:text-primary"
                                    title="Preview" target="_blank">
                                    👁️
                                </a>
                                <form action="{{ route('themes.destroy', $theme->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus tema ini?')">
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
