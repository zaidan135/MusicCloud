<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css'])

    </head>
    <body class="font-sans bg-black text-gray-100 scrollbar-thin">
        <!-- Main Content -->
        <div class="min-h-screen flex flex-col items-center justify-center relative z-10">
            <!-- Content Slot -->
            <div class="w-full sm:max-w-md bg-opacity-80 shadow-md rounded-lg relative">
                <!-- Logo -->
                <div class="w-full h-20 flex justify-center items-center bg-fifth rounded-t-lg">
                    <a href="/">
                        <h1 class="text-primary text-4xl font-bold">Music<span class="text-third">Cloud</span></h1>
                    </a>
                </div>
                <div class="w-full sm:max-w-md px-6 py-4 bg-gray-200 shadow-md rounded-b-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/d9a94bae06.js" crossorigin="anonymous"></script>
    </body>
</html>