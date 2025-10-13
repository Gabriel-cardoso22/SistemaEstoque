<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navBar.css') }}">
</head>
<body>
    {{-- Header --}}
    @include('layouts.header')

    {{-- NavBar --}}
    @include('layouts.navBar')

    {{-- Conteúdo --}}
    <main style="margin-top: 80px;">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')
</body>
</html>
