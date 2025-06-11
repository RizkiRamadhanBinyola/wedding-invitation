{{-- views/user/invitations/form.blade.php --}}

<form method="POST" action="{{ $action }}">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    <label>Nama Pria:</label>
    <input type="text" name="nama_pria" value="{{ old('nama_pria', $data->nama_pria ?? '') }}" required>

    <label>Nama Wanita:</label>
    <input type="text" name="nama_wanita" value="{{ old('nama_wanita', $data->nama_wanita ?? '') }}" required>

    <label>Orang Tua Pria:</label>
    <input type="text" name="ortu_pria" value="{{ old('ortu_pria', $data->ortu_pria ?? '') }}" required>

    <label>Orang Tua Wanita:</label>
    <input type="text" name="ortu_wanita" value="{{ old('ortu_wanita', $data->ortu_wanita ?? '') }}" required>

    <label>Anak ke:</label>
    <input type="text" name="anak_ke" value="{{ old('anak_ke', $data->anak_ke ?? '') }}" required>

    <label>Tanggal Acara:</label>
    <input type="date" name="tanggal" value="{{ old('tanggal', $data->tanggal ?? '') }}" required>

    <label>Waktu Akad:</label>
    <input type="text" name="waktu_akad" value="{{ old('waktu_akad', $data->waktu_akad ?? '') }}" required>

    <label>Waktu Resepsi:</label>
    <input type="text" name="waktu_resepsi" value="{{ old('waktu_resepsi', $data->waktu_resepsi ?? '') }}" required>

    <label>Lokasi:</label>
    <input type="text" name="lokasi" value="{{ old('lokasi', $data->lokasi ?? '') }}" required>

    <label>Telepon:</label>
    <input type="text" name="no_telp" value="{{ old('no_telp', $data->no_telp ?? '') }}" required>

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email', $data->email ?? '') }}" required>

    <label>Nomor Rekening:</label>
    <input type="text" name="no_rekening" value="{{ old('no_rekening', $data->no_rekening ?? '') }}">

    <label>Instagram:</label>
    <input type="text" name="instagram" value="{{ old('instagram', $data->instagram ?? '') }}">

    <label>Latar Musik:</label>
    <input type="text" name="musik" value="{{ old('musik', $data->musik ?? '') }}">

    <label>Pilih Tema:</label>
    <select name="theme_id" required>
        @foreach($themes as $theme)
            <option value="{{ $theme->id }}" {{ (old('theme_id', $data->theme_id ?? '') == $theme->id) ? 'selected' : '' }}>
                {{ $theme->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">{{ $buttonText }}</button>
</form>
