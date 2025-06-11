<x-app-layout>
    <div
        class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div
            class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
            <h3 class="font-medium text-black dark:text-white">
                Tambahkan Tema
            </h3>
        </div>
        @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('themes.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5.5 p-6.5">
            @csrf

            <div>
                <label
                    class="mb-3 block text-sm font-medium text-black dark:text-white">
                    Nama Tema
                </label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    placeholder="Contoh: Tema Elegan" required>

            </div>

            <div>
                <label
                    class="mb-3 block text-sm font-medium text-black dark:text-white">
                    Slug (nama folder tema)
                </label>
                <input type="text" name="slug" value="{{ old('slug') }}"
                    class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    placeholder="Contoh: tema-elegan" required>
            </div>

            <div class="flex flex-col">
                <div>
                    <label
                        class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Preview Gambar
                    </label>
                    <input type="file" name="preview"
                        class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:px-5 file:py-3 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary">

                </div>
            </div>
            
            <button type="submit"
                class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>