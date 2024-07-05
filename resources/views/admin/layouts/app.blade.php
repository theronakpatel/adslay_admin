<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="manifest" href="/build/manifest.json" />
        <!-- Scripts -->
        @vite(['resources/css/app.css?v='.filemtime(public_path('build/assets/app.css')), 'resources/js/app.js?v='.filemtime(public_path('build/assets/app.js'))])
        {{-- <link rel="preload" as="style" href="/build/assets/app-CG22RtD6.css?v={{ time() }}" /> --}}
        {{-- <link rel="modulepreload" href="/build/assets/app-DUfqXmJT.js?v={{ time() }}" /> --}}
        {{-- <link rel="modulepreload" href="/build/assets/axios-B4uVmeYG.js?v={{ time() }}" /> --}}
        {{-- <link rel="stylesheet" href="/build/assets/app-CG22RtD6.css?v={{ time() }}" /> --}}
        {{-- <script type="module" src="/build/assets/app-DUfqXmJT.js?v={{ time() }}"></script> --}}
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('admin.layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="shadow">
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
