{{-- Partial kolom inti undangan (sesuai migration) --}}
@php($old = fn($key,$default='') => old($key, $data->$key ?? $default))

{{-- ============  TEMA  ============ --}}
<div>
    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
        Tema
    </label>
    <select name="theme_id"
        class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white"
        required>
        @foreach($themes as $theme)
            <option value="{{ $theme->id }}"
                {{ $old('theme_id') == $theme->id ? 'selected' : '' }}>
                {{ $theme->name }}
            </option>
        @endforeach
    </select>
</div>

{{-- ============  DATA PASANGAN  ============ --}}
<div class="grid grid-cols-1 gap-5.5 md:grid-cols-2">
    {{-- Nama Pria --}}
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Nama Pria
        </label>
        <input type="text" name="nama_pria" value="{{ $old('nama_pria') }}"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white"
            required>
    </div>
    {{-- Nama Wanita --}}
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Nama Wanita
        </label>
        <input type="text" name="nama_wanita" value="{{ $old('nama_wanita') }}"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white"
            required>
    </div>

    {{-- Ortu Pria --}}
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Ortu Pria
        </label>
        <input type="text" name="ortu_pria" value="{{ $old('ortu_pria') }}"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white"
            required>
    </div>
    {{-- Ortu Wanita --}}
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Ortu Wanita
        </label>
        <input type="text" name="ortu_wanita" value="{{ $old('ortu_wanita') }}"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white"
            required>
    </div>

    {{-- Anak ke --}}
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Anak ke‑
        </label>
        <input type="text" name="anak_ke" value="{{ $old('anak_ke') }}"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white"
            required>
    </div>
    {{-- Tanggal --}}
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Tanggal Acara
        </label>
        <input type="date" name="tanggal" value="{{ $old('tanggal') }}"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white"
            required>
    </div>
</div>

{{-- ============  LOKASI & KONTAK  ============ --}}
<div class="grid grid-cols-1 gap-5.5 md:grid-cols-2 mt-5.5">
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Lokasi
        </label>
        <input type="text" name="lokasi" value="{{ $old('lokasi') }}"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white"
            required>
    </div>
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Telepon
        </label>
        <input type="text" name="no_telp" value="{{ $old('no_telp') }}"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white"
            required>
    </div>
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Email
        </label>
        <input type="email" name="email" value="{{ $old('email') }}"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white"
            required>
    </div>
</div>

{{-- ============  WAKTU ACARA  ============ --}}
<div class="grid grid-cols-1 gap-5.5 md:grid-cols-2 mt-5.5">
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Waktu Akad
        </label>
        <input type="text" name="waktu_akad" value="{{ $old('waktu_akad') }}"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white"
            required>
    </div>
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Waktu Resepsi
        </label>
        <input type="text" name="waktu_resepsi" value="{{ $old('waktu_resepsi') }}"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white"
            required>
    </div>
</div>

{{-- ============  OPSIONAL  ============ --}}
<div class="grid grid-cols-1 gap-5.5 md:grid-cols-2 mt-5.5">
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            No Rekening (opsional)
        </label>
        <input type="text" name="no_rekening" value="{{ $old('no_rekening') }}"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white">
    </div>
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Instagram (opsional)
        </label>
        <input type="text" name="instagram" value="{{ $old('instagram') }}"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white">
    </div>
    <div>
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Musik (URL / Judul)
        </label>
        <input type="text" name="musik" value="{{ $old('musik') }}"
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:text-white">
    </div>
</div>
