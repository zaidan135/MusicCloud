<nav class="bg-transparent p-4 flex flex-col sm:flex-row items-center sm:justify-between">
    <!-- Bagian 1: Logo dan Hamburger -->
    <div class="flex justify-between items-center w-full sm:w-auto mb-4 sm:mb-0">
        <!-- Logo -->
        <div class="h-10">
            <x-mc-logo class="h-8 w-auto text-white" />
        </div>

        <!-- Hamburger -->
        <div class="flex items-center sm:hidden">
            <div x-data="{ open: false }" class="sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
    
                <!-- Mobile Menu -->
                <div x-show="open" class="mt-2 space-y-2 absolute z-50 w-screen left-0 bg-black">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('music.create')">
                        {{ __('Upload') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian 2: Search -->
    <div class="w-full sm:flex-1 sm:mx-4">
        <form action="#" method="GET" class="flex items-center justify-center">
            <x-search placeholder="Explore music from everyone..." class="w-full sm:w-1/2" />
        </form>
    </div>

    <!-- Bagian 3: Profile -->
    <div class="flex-shrink-0">
        <!-- Profile Menu for Desktop -->
        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <div x-data="{ open: false }" class="relative">
                <!-- Trigger: Nama dan Lingkaran -->
                <div class="flex items-center cursor-pointer" @click="open = !open">
                    <!-- Nama User -->
                    <span class="text-sm font-medium text-gray-500 hover:text-gray-700">
                        {{ Auth::user()->name }}
                    </span>
    
                    <!-- Lingkaran dengan Inisial -->
                    <div class="flex items-center justify-center h-8 w-8 bg-gray-300 text-gray-800 rounded-full ml-3">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
    
                <!-- Dropdown -->
                <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('music.create')">
                        {{ __('Upload') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
