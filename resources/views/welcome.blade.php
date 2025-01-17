<div class="absolute min-h-screen min-w-full bg-transparent z-50">
    <main class="h-screen flex items-center justify-center">
        @if (Route::has('login'))
        <nav class="text-white">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-black">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="">
                    Log in
                </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="">
                    Register
                </a>
            @endif
            @endauth
        </nav>
        @endif
    </main>
</div> 