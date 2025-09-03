<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased">
    {{-- Inclusion de ta nav personnalisée --}}
    @include('layouts.Components.nav')

    <div class="min-h-screen bg-gray-100 mt-32 ms-10 me-10">
        {{-- Contenu des pages --}}
        @yield('content')
    </div>
</body>
</html>
