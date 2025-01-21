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
    
            <!-- Bagian 2 & 3: Main Content dibagi dua secara fleksibel dengan rounded-xl -->
            <div id="content" class="flex flex-grow rounded-lg overflow-hidden bg-seventh mb-2">
                <!-- Bagian 2: Kolom Kiri -->
                <div id="left-column" class="left-column flex-shrink-0">
                    <div class="w-full h-full">
                        <x-aside/>
                    </div>                
                    <!-- Resizer handle berada di sisi kanan dari left-column -->
                    <div id="resizer" class="resize-handle bg-black hover:bg-primary w-1 flex justify-center h-full">
                        <div class="w-1/6 h-full bg-neutral-700"></div>
                    </div>
                </div>
                <!-- Bagian 3: Kolom Kanan -->
                <div id="right-column" class="right-column w-full">
                    <div class="w-full h-full">
                        <main class="h-full overflow-y-scroll scrollbar-thin">
                            {{ $slot }}
                        </main>
                    </div>
                </div>
            </div>
    
            <!-- Bagian 4: Footer -->   
            <x-footer />                 
        </div>
        <script src="https://kit.fontawesome.com/d9a94bae06.js" crossorigin="anonymous"></script>
    </body>
</html>
