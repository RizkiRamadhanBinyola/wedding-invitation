@props(['title' => null])

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>
        {{ $title ?? (
            View::hasSection('title') ? trim(View::yieldContent('title')) :
            (Auth::check() ? (Auth::user()->role === 'admin' ? 'Admin Dashboard' : 'User Dashboard') : 'Wedding Invitation')
        ) }}
    </title>

    <link rel="icon" href="{{ asset('tailadmin/build/favicon.ico') }}">
    <link href="{{ asset('tailadmin/build/style.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
