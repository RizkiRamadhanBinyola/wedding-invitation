<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Undangan Pernikahan</title>
    <link rel="stylesheet" href="{{ asset('assets/{$slug}/style.css') }}">
    <style>
        body {font-family: Arial, sans-serif; line-height:1.5;}
        .container {max-width:640px;margin:auto;padding:2rem;}
        input,textarea {width:100%;padding:.5rem;margin-top:.25rem;border:1px solid #ccc;border-radius:4px;}
        button {padding:.5rem 1rem;background:#2563eb;color:#fff;border:none;border-radius:4px;cursor:pointer;}
        button:hover {background:#1e40af;}
    </style>
</head>
<body>
<div class="container">
    <h1 style="text-align:center;margin-bottom:1.5rem;">Undangan Pernikahan</h1>

    {{-- ======= DATA INTI ======= --}}
    <p><strong>Pria:</strong> {{ $invitation->nama_pria ?? $data['nama_pria'] ?? '' }}</p>
    <p><strong>Wanita:</strong> {{ $invitation->nama_wanita ?? $data['nama_wanita'] ?? '' }}</p>
    <p><strong>Tanggal:</strong>
        {{ \Carbon\Carbon::parse($invitation->tanggal ?? $data['tanggal'])->format('d M Y') }}</p>
    <p><strong>Lokasi:</strong> {{ $invitation->lokasi ?? $data['lokasi'] ?? '' }}</p>

    <hr style="margin:2rem 0">

    {{-- ======= FORM UCAPAN ======= --}}
    @if(!$isDummy)
    <h2>Kirim Ucapan &amp; Doa</h2>
    @if(session('success'))
        <div style="color:green;margin-bottom:1rem;">{{ session('success') }}</div>
    @endif

    <form action="{{ url()->current() }}/greetings" method="POST" style="margin-bottom:2rem;">
        @csrf
        <label>Nama Anda
            <input type="text" name="nama_pengirim" required>
        </label>
        <label>Ucapan
            <textarea name="isi_ucapan" rows="3" required></textarea>
        </label>
        <button type="submit">Kirim Ucapan</button>
    </form>
    @endif

    {{-- ======= LIST UCAPAN ======= --}}
    <h2>Ucapan Tamu</h2>
    @php($greetList = $invitation->greetings ?? ($data['greetings'] ?? collect()))
    @if($greetList->count())
        @foreach($greetList as $greet)
            <div style="margin-bottom:1rem;border-bottom:1px dashed #ddd;padding-bottom:.5rem;">
                <strong>{{ $greet->nama_pengirim }}</strong><br>
                {{ $greet->isi_ucapan }}
            </div>
        @endforeach
    @else
        <p>Belum ada ucapan.</p>
    @endif

    @if($isDummy)
        <p style="color:red;margin-top:2rem;">[Mode Preview Dummy]</p>
    @endif
</div>

<script src="{{ asset('assets/{$slug}/script.js') }}"></script>
</body>
</html>