<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>
        @auth
            @if (Auth::user()->role === 'admin')
                Admin Dashboard
            @elseif (Auth::user()->role === 'user')
                User Dashboard
            @endif
        @endauth
    </title>

    <link rel="icon" href="{{ asset('tailadmin/build/favicon.ico') }}">
    <link href="{{ asset('tailadmin/build/style.css') }}" rel="stylesheet">
</head>
