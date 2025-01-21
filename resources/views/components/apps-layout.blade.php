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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js', 'resources/js/custom.js', 'resources/js/music.js', 'resources/js/aside.js', 'resources/css/aside.css'])
    </head>
    <body class="font-sans antialiased bg-black scrollbar-thin">

        <div class="min-h-screen max-h-screen flex flex-col px-3">
            <!-- Bagian 1: Navbar -->
            <x-navbar />
    
            <!-- Bagian 2 Main Content dengan rounded-xl -->
            <div class="flex flex-grow rounded-lg overflow-hidden bg-primary">
                <div id="right-column" class="right-column w-full">
                    <div class="w-full h-full">
                        <main class="h-full overflow-y-scroll scrollbar-thin">
                            {{ $slot }}
                        </main>
                    </div>
                </div>
            </div>                
        </div>
        <script src="https://kit.fontawesome.com/d9a94bae06.js" crossorigin="anonymous"></script>
    </body>
</html>
