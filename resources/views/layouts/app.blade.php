<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Soporte Patitos S.A') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{ asset('img/logo_empresa.png') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.sidenav')

        <!-- Page Heading -->
        @if (isset($header))
        <header>
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main class="ml-64">
            @if(session('status'))
            <div class="bg-green-500 text-green-100 text-center text-xl font-bold p-2 -mb-2 mt-1">{{ session('status') }}</div>
            @endif
            @if(session('destroy'))
            <div class="bg-red-500 text-red-100 text-center text-xl font-bold p-2 -mb-2 mt-1">{{ session('destroy') }}</div>
            @endif
            {{ $slot }}
        </main>
    </div>
</body>

</html>