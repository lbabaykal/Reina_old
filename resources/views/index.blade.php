<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="256x256" href="{{ asset('favicon.png') }}">
    <title>@yield('title', config('app.name'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
{{--    @vite(['resources/js/app.js'])--}}
</head>

<body class="w-full bg-black font-main text-white antialiased">

    @include('layouts.header')

    <main>
        @yield('content')
    </main>

</body>
</html>


{{--Success--}}
{{--Error--}}
{{--Info--}}
{{--Warning--}}
