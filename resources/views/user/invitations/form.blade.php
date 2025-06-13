<x-app-layout>
    <main class="p-4">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">
                    {{ $title ?? 'Tambahkan Data Undangan' }}
                </h3>
            </div>

            @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4 mx-6.5">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="flex flex-col gap-5.5 p-6.5">
                @csrf
                @if($method === 'PUT') @method('PUT') @endif

                {{-- Nama Pria --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Nama Pria</label>
                    <input type="text" name="nama_pria" value="{{ old('nama_pria', $data->nama_pria ?? '') }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" placeholder="Contoh: John Doe" required>
                </div>

                {{-- Nama Wanita --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Nama Wanita</label>
                    <input type="text" name="nama_wanita" value="{{ old('nama_wanita', $data->nama_wanita ?? '') }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" placeholder="Contoh: Jane Smith" required>
                </div>

                {{-- Orang Tua Pria --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Orang Tua Pria</label>
                    <input type="text" name="ortu_pria" value="{{ old('ortu_pria', $data->ortu_pria ?? '') }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" placeholder="Contoh: Bpk. & Ibu Doe" required>
                </div>

                {{-- Orang Tua Wanita --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Orang Tua Wanita</label>
                    <input type="text" name="ortu_wanita" value="{{ old('ortu_wanita', $data->ortu_wanita ?? '') }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" placeholder="Contoh: Bpk. & Ibu Smith" required>
                </div>

                {{-- Anak ke --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Anak ke</label>
                    <input type="text" name="anak_ke" value="{{ old('anak_ke', $data->anak_ke ?? '') }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" placeholder="Contoh: 1" required>
                </div>

                {{-- Tanggal Acara --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Tanggal Acara</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $data->tanggal ?? '') }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required>
                </div>

                {{-- Waktu Akad --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Waktu Akad</label>
                    <input type="text" name="waktu_akad" value="{{ old('waktu_akad', $data->waktu_akad ?? '') }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" placeholder="Contoh: 08.00 WIB" required>
                </div>

                {{-- Waktu Resepsi --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Waktu Resepsi</label>
                    <input type="text" name="waktu_resepsi" value="{{ old('waktu_resepsi', $data->waktu_resepsi ?? '') }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" placeholder="Contoh: 11.00 - 14.00 WIB" required>
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $data->lokasi ?? '') }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" placeholder="Contoh: Gedung ABC, Jakarta" required>
                </div>

                {{-- Telepon --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Telepon</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp', $data->no_telp ?? '') }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" placeholder="Contoh: +62 812 3456 7890" required>
                </div>

                {{-- Email --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Email</label>
                    <input type="email" name="email" value="{{ old('email', $data->email ?? '') }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" placeholder="Contoh: email@example.com" required>
                </div>

                {{-- Nomor Rekening --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Nomor Rekening</label>
                    <input type="text" name="no_rekening" value="{{ old('no_rekening', $data->no_rekening ?? '') }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" placeholder="Contoh: 1234567890">
                </div>

                {{-- Instagram --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Instagram</label>
                    <input type="text" name="instagram" value="{{ old('instagram', $data->instagram ?? '') }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" placeholder="Contoh: @username">
                </div>

                {{-- Musik --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Latar Musik</label>
                    <input type="text" name="musik" value="{{ old('musik', $data->musik ?? '') }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" placeholder="URL musik atau judul lagu">
                </div>

                {{-- Pilih Tema --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">Pilih Tema</label>
                    <select name="theme_id" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary appearance-none" required>
                        @foreach($themes as $theme)
                        <option value="{{ $theme->id }}" {{ (old('theme_id', $data->theme_id ?? '') == $theme->id) ? 'selected' : '' }}>
                            {{ $theme->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90">
                    {{ $buttonText ?? 'Simpan' }}
                </button>
            </form>
        </div>
    </main>
</x-app-layout>