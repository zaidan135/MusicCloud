<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-text-input id="name" class="block mt-1 w-full bg-gray-200 text-gray-900 rounded-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-text-input id="username" class="block mt-1 w-full bg-gray-200 text-gray-900 rounded-lg" type="text" name="username" :value="old('username')" required autocomplete="username" placeholder="Username"/>
            <x-input-error :messages="$errors->get('username')" class="mt-2 text-red-500" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-text-input id="email" class="block mt-1 w-full bg-gray-200 text-gray-900 rounded-lg" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-text-input id="password" class="block mt-1 w-full bg-gray-200 text-gray-900 rounded-lg"
                          type="password" name="password" required autocomplete="new-password" placeholder="Password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-gray-200 text-gray-900 rounded-lg"
                          type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-primary hover:text-third rounded-md" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-primary hover:bg-secondary">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
