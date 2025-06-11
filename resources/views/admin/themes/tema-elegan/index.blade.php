<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Undangan Pernikahan</title>
    <link rel="stylesheet" href="{{ asset('assets/tema-elegan/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Undangan Pernikahan</h1>

        <p><strong>Pria:</strong> {{ $data['nama_pria'] }}</p>
        <p><strong>Wanita:</strong> {{ $data['nama_wanita'] }}</p>
        <p><strong>Tanggal Acara:</strong> {{ $data['tanggal'] }}</p>
        <p><strong>Lokasi:</strong> {{ $data['lokasi'] }}</p>

        <hr>
        <p><strong>Ucapan:</strong> {{ $data['ucapan'] }}</p>

        @if($isDummy)
            <p style="color:red;">[Mode Preview Dummy]</p>
        @endif
    </div>

    <script src="{{ asset('assets/tema-elegan/script.js') }}"></script>
</body>
</html>