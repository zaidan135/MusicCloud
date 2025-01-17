<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=New+Amsterdam&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js', 'resources/js/parallax.js'])
    </head>
    <body class="scrollbar-thin">
    <!-- Navigator -->
    <div class="z-50 fixed w-full h-20 flex justify-center backdrop-blur-md bg-opacity-90 bg-black shadow-lg">
        <nav class="flex justify-between items-center w-full md:w-3/4 px-4 md:px-0 h-full">
            <!-- Logo -->
            <div class="flex items-center">
                <h1 class="text-primary text-2xl sm:text-3xl font-bold">
                    <a href="/">Music<span class="text-third">Cloud</span></a>
                </h1>
            </div>
            
            <!-- Navigation Links -->
            <div class="hidden md:flex gap-8">
                <button id="navJoin" class="text-primary font-medium text-lg lg:text-xl hover:text-secondary transition duration-300">JOIN</button>
                <button id="navQuotes" class="text-primary font-medium text-lg lg:text-xl hover:text-secondary transition duration-300">QUOTES</button>
                <button id="navAbout" class="text-primary font-medium text-lg lg:text-xl hover:text-secondary transition duration-300">ABOUT</button>
            </div>
    
            <!-- Hamburger Menu for Mobile -->
            <div class="md:hidden">
                <button id="hamburgerMenu" class="text-primary text-2xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="fixed top-20 left-0 w-full bg-black bg-opacity-90 hidden sm:hidden flex-col items-center gap-6 p-4 z-50">
        <button id="navJoinMobile" class="text-primary font-medium text-lg hover:text-secondary transition duration-300">JOIN</button>
        <button id="navQuotesMobile" class="text-primary font-medium text-lg hover:text-secondary transition duration-300">QUOTES</button>
        <button id="navAboutMobile" class="text-primary font-medium text-lg hover:text-secondary transition duration-300">ABOUT</button>
    </div>
    
    
        <!-- Background Section -->
        <div class="w-full min-h-screen bg-black">

            <div class="container-img">
                <!-- Layered Images -->
                <div class="img-layer img2 fixed flex w-full bottom-0">
                    <img id="img2-1" class="w-1/2 md:w-1/3 z-10" src="{{ asset('storage/imgResource/component-3-1.png') }}" alt="">
                    <img id="img2-2" class="w-1/2 md:w-1/3 z-10" src="{{ asset('storage/imgResource/component-3-2.png') }}" alt="">
                </div>
                <div class="img-layer img1 fixed flex w-full bottom-0">
                    <img id="img1-1" class="w-full z-20" src="{{ asset('storage/imgResource/component-4.png') }}" alt="">
                </div>
                <div class="img-layer img3 fixed flex w-full bottom-0">
                    <img id="img3-1" class="w-full z-30" src="{{ asset('storage/imgResource/component-2.png') }}" alt="">
                </div>
                <div class="img-layer img4 fixed flex w-full bottom-0">
                    <img id="img4-1" class="w-full z-40" src="{{ asset('storage/imgResource/component-1.png') }}" alt="">
                </div>
                <div class="fixed flex items-center justify-center w-full h-screen backdrop-blur-sm">
                    <h1 class="text-sixth text-4xl sm:text-9xl font-bold z-50">WELCOME</h1>
                </div>
                
                <!-- Mouse Indicator -->
                <div class="fixed bottom-10 w-full flex justify-center items-center">
                    <div class="animate-bounce flex flex-col items-center">
                        <!-- Mouse Icon -->
                        <div class="w-4 h-10 border-2 border-primary rounded-full flex justify-center items-start">
                            <div class="w-2 h-2 bg-secondary rounded-full mt-2 animate-scroll-indicator"></div>
                        </div>
                        <!-- Arrow Down -->
                        <div class="mt-4 text-primary grid grid-row-2">
                            <i class="fa-solid fa-angle-down text-2xl"></i>
                            <i class="fa-solid fa-angle-down text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Content -->
        <div class="z-40 w-full min-h-screen bg-black absolute overflow-hidden">
            <!-- Main Content Section -->
            <div id="mainContent" class="flex items-center justify-center w-full h-screen flex-col gap-10 text-center opacity-40">
                <div class="police-line-wrapper opacity-40">
                    <div class="police-line">
                        <div class="police-text">p</div>
                    </div>
                    <div class="police-line">
                        <div class="police-text">p</div>
                    </div>
                    <div class="police-line">
                        <div class="police-text">p</div>
                    </div>
                    <div class="police-line">
                        <div class="police-text">p</div>
                    </div>
                </div>
                <!-- Title Section -->
                <h1 class="text-sixth text-9xl font-bold drop-shadow-lg">Music Cloud</h1>

                <!-- Subtitle/Call to Action -->
                <div class="subtitle z-50">
                    <p class="text-white text-2xl font-semibold mb-8 px-4 sm:px-0">
                        Welcome to the future of music. Discover, share, and enjoy your favorite tracks.
                    </p>
                    <p class="text-white text-lg mb-6">
                        Dive into the rhythm of endless possibilities!
                    </p>
                </div>

                <!-- Authentication Links -->
                <div class="grid grid-rows-2 gap-2">
                    @if (Route::has('login'))
                        @auth
                            <p class="text-white text-lg font-medium">
                                Welcome back! <a href="{{ url('/dashboard') }}" class="text-primary font-semibold">Go to your Dashboard</a>
                            </p>
                        @else
                            <p class="text-white text-lg font-medium">
                                <a href="{{ route('register') }}" class="text-white font-semibold bg-primary p-5 rounded-xl">Join us today!</a>
                            </p>
                            <p class="text-white text-lg font-medium mt-4">
                                Already have an account? <a href="{{ route('login') }}" class="text-primary font-semibold">Log in here</a>
                            </p>
                        @endauth
                    @endif
                </div>
            </div>

            <div class="con min-h-fit flex flex-col bg-primary relative">
                <img class="w-full max-h-fit z-50 absolute" src="{{ asset('storage/imgResource/asset.png') }}" alt="">
                <!-- Layer Blur + Quotes -->
                <div id="quotesSection" class="w-full flex justify-center items-center text-fuchsia-50 text-2xl h-screen relative">
                    <!-- Background Music Notes -->
                    <div class="absolute inset-0 flex justify-center items-center z-10 opacity-10">
                        <img class="h-full w-full" src="{{ asset('storage/imgResource/assetcos.webp') }}" alt="">
                    </div>
                    <!-- Blurred Background for Quotes -->
                    <div class="absolute inset-0 backdrop-blur-sm bg-black bg-opacity-50"></div>
                    <!-- Quotes Content -->
                    <div class="relative z-20 text-center px-4">
                        <p class="text-fuchsia-50 text-2xl font-semibold">
                            "Without music, life would be a mistake."<br> — Friedrich Nietzsche
                        </p>
                    </div>
                </div>
                <img class="w-full max-h-fit z-50 absolute bottom-0" src="{{ asset('storage/imgResource/assett.png') }}" alt="">
            </div>
            
            
            <div id="additionalContent" class="con min-h-fit bg-black overflow-y-hidden">
                <footer class="w-full bg-black text-gray-400">
                    <div id="footer" class="container mx-auto py-16 px-8">
                        <!-- Logo or Title -->
                        <div class="text-center mb-12">
                            <h1 class="text-white text-4xl font-bold mb-4">Music Cloud</h1>
                            <p class="text-lg">
                                Discover the future of music. Stream, share, and explore tracks like never before.
                            </p>
                        </div>
                
                        <!-- Quick Navigation Links -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
                            <div>
                                <h2 class="text-primary font-bold mb-4">Quick Links</h2>
                                <ul>
                                    <li><a href="#" class="hover:text-primary">Home</a></li>
                                    <li><a href="#" class="hover:text-primary">About Us</a></li>
                                    <li><a href="#" class="hover:text-primary">Features</a></li>
                                    <li><a href="#" class="hover:text-primary">Contact</a></li>
                                </ul>
                            </div>
                            <div>
                                <h2 class="text-primary font-bold mb-4">Support</h2>
                                <ul>
                                    <li><a href="#" class="hover:text-primary">Help Center</a></li>
                                    <li><a href="#" class="hover:text-primary">Privacy Policy</a></li>
                                    <li><a href="#" class="hover:text-primary">Terms of Service</a></li>
                                </ul>
                            </div>
                            <div>
                                <h2 class="text-primary font-bold mb-4">Social Media</h2>
                                <div class="flex space-x-4">
                                    <a href="#" class="text-2xl hover:text-primary"><i class="fab fa-facebook"></i></a>
                                    <a href="#" class="text-2xl hover:text-primary"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="text-2xl hover:text-primary"><i class="fab fa-instagram"></i></a>
                                    <a href="#" class="text-2xl hover:text-primary"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                            <div>
                                <h2 class="text-primary font-bold mb-4">Newsletter</h2>
                                <p class="text-sm mb-4">
                                    Subscribe to our newsletter to stay updated!
                                </p>
                                <form>
                                    <input type="email" placeholder="Your email" class="p-3 rounded-lg w-full bg-gray-800 text-white mb-4">
                                    <button type="submit" class="bg-primary text-white py-2 px-4 rounded-lg hover:bg-secondary transition duration-300 w-full">
                                        Subscribe
                                    </button>
                                </form>
                            </div>
                        </div>
                
                        <!-- Copyright -->
                        <div class="text-center border-t border-gray-700 pt-8">
                            <p class="text-sm">
                                &copy; 2024 Music Cloud. All rights reserved. Designed with ❤️ by <a href="#" class="text-primary hover:underline">ZSPALL</a>.
                            </p>
                        </div>
                    </div>
                </footer>
                
            </div>
        </div>
        <script src="https://kit.fontawesome.com/d9a94bae06.js" crossorigin="anonymous"></script>
    </body>
</html>
