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
        @vite(['resources/css/app.css?v='.filemtime(public_path('build/assets/app.css')), 'resources/js/app.js?v='.filemtime(public_path('build/assets/app.js'))])
        {{-- <link rel="preload" as="style" href="/build/assets/app-CG22RtD6.css?v={{ time() }}" /> --}}
        {{-- <link rel="modulepreload" href="/build/assets/app-DUfqXmJT.js?v={{ time() }}" /> --}}
        {{-- <link rel="modulepreload" href="/build/assets/axios-B4uVmeYG.js?v={{ time() }}" /> --}}
        {{-- <link rel="stylesheet" href="/build/assets/app-CG22RtD6.css?v={{ time() }}" /> --}}
        {{-- <script type="module" src="/build/assets/app-DUfqXmJT.js?v={{ time() }}"></script> --}}
    </head>
    <body class="font-sans text-white antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/" class="text-5xl">
                    <img src="/adslay.png" class="h-12 rounded-lg w-full"/>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
