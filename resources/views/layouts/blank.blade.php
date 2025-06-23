<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Undangan' }}</title>
    <link rel="stylesheet" href="{{ asset('assets/'.$slug.'/style.css') }}">
    <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
    @yield('content')

    <script src="{{ asset('assets/'.$slug.'/script.js') }}"></script>
</body>
</html>
