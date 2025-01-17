<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary focus:bg-third active:bg-third focus:outline-none focus:ring-2 focus:ring-third focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
