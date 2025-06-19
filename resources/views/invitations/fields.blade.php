{{-- Partial berisi SELURUH input yang ada di migration invitations --}}
@php( $old = fn($key,$default='') => old($key, $data->$key ?? $default) )

{{-- =====================  TEMA  ===================== --}}
<div>
    <label class="mb-2 block text-sm font-medium">Tema</label>
    <select name="theme_id" class="w-full rounded border px-4 py-2" required>
        @foreach($themes as $theme)
            <option value="{{ $theme->id }}"
                    {{ $old('theme_id') == $theme->id ? 'selected' : '' }}>
                {{ $theme->name }}
            </option>
        @endforeach
    </select>
</div>

{{-- ===================  DATA PASANGAN  =================== --}}
<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium">Nama Pria</label>
        <input type="text" name="nama_pria" value="{{ $old('nama_pria') }}"
               class="w-full rounded border px-4 py-2" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium">Nama Wanita</label>
        <input type="text" name="nama_wanita" value="{{ $old('nama_wanita') }}"
               class="w-full rounded border px-4 py-2" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium">Ortu Pria</label>
        <input type="text" name="ortu_pria" value="{{ $old('ortu_pria') }}"
               class="w-full rounded border px-4 py-2" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium">Ortu Wanita</label>
        <input type="text" name="ortu_wanita" value="{{ $old('ortu_wanita') }}"
               class="w-full rounded border px-4 py-2" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium">Anak ke‑</label>
        <input type="text" name="anak_ke" value="{{ $old('anak_ke') }}"
               class="w-full rounded border px-4 py-2" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium">Tanggal Acara</label>
        <input type="date" name="tanggal" value="{{ $old('tanggal') }}"
               class="w-full rounded border px-4 py-2" required>
    </div>
</div>

{{-- ===================  LOKASI & KONTAK  =================== --}}
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 mt-4">
    <div>
        <label class="mb-2 block text-sm font-medium">Lokasi</label>
        <input type="text" name="lokasi" value="{{ $old('lokasi') }}"
               class="w-full rounded border px-4 py-2" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium">Telepon</label>
        <input type="text" name="no_telp" value="{{ $old('no_telp') }}"
               class="w-full rounded border px-4 py-2" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium">Email</label>
        <input type="email" name="email" value="{{ $old('email') }}"
               class="w-full rounded border px-4 py-2" required>
    </div>
</div>

{{-- ===================  WAKTU ACARA  =================== --}}
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 mt-4">
    <div>
        <label class="mb-2 block text-sm font-medium">Waktu Akad</label>
        <input type="text" name="waktu_akad" value="{{ $old('waktu_akad') }}"
               class="w-full rounded border px-4 py-2" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium">Waktu Resepsi</label>
        <input type="text" name="waktu_resepsi" value="{{ $old('waktu_resepsi') }}"
               class="w-full rounded border px-4 py-2" required>
    </div>
</div>

{{-- ===================  OPSIONAL  =================== --}}
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 mt-4">
    <div>
        <label class="mb-2 block text-sm font-medium">No Rekening (opsional)</label>
        <input type="text" name="no_rekening" value="{{ $old('no_rekening') }}"
               class="w-full rounded border px-4 py-2">
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium">Instagram (opsional)</label>
        <input type="text" name="instagram" value="{{ $old('instagram') }}"
               class="w-full rounded border px-4 py-2">
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium">Musik (Lagu URL / Judul)</label>
        <input type="text" name="musik" value="{{ $old('musik') }}"
               class="w-full rounded border px-4 py-2">
    </div>
</div>
