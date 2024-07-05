<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="manifest" href="/build/manifest.json" />
        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <link rel="preload" as="style" href="/build/assets/app-CG22RtD6.css?v={{ time() }}" />
        <link rel="modulepreload" href="/build/assets/app-8tW6TGey.js?v={{ time() }}" />
        <link rel="modulepreload" href="/build/assets/axios-B4uVmeYG.js?v={{ time() }}" />
        <link rel="stylesheet" href="/build/assets/app-CG22RtD6.css?v={{ time() }}" />
        <script type="module" src="/build/assets/app-8tW6TGey.js?v={{ time() }}"></script>
        <script type="module" src="/build/assets/app-DUfqXmJT.js?v={{ time() }}"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
