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
                        <div class="flex items-center gap-2">
                            {{-- Edit --}}
                            <a href="{{ route('themes.edit', $theme->id) }}"
                                class="inline-flex items-center justify-center gap-2.5 rounded-full border border-primary px-4 py-2 text-center font-medium text-primary hover:bg-opacity-90 lg:px-8 xl:px-10"
                                title="Edit">
                                ✏️<small>edit</small>
                            </a>

                            {{-- Preview --}}
                            <a href="{{ route('themes.preview', $theme->slug) }}" target="_blank"
                                class="inline-flex items-center justify-center gap-2.5 rounded-full border border-primary px-4 py-2 text-center font-medium text-primary hover:bg-opacity-90 lg:px-8 xl:px-10"
                                title="Preview">
                                👁️<small>Lihat</small>
                            </a>

                            {{-- Hapus --}}
                            <form action="{{ route('themes.destroy', $theme->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus tema ini?')"
                                class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center justify-center gap-2.5 rounded-full border border-primary px-4 py-2 text-center font-medium text-primary hover:bg-opacity-90 lg:px-8 xl:px-10"
                                    title="Hapus">
                                    🗑️ <small>Hapus</small>
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