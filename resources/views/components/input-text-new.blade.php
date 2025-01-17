@props(['disabled' => false])

<input 
    @disabled($disabled) 
    {{ $attributes->merge([
        'class' => 'border-b-2 border-gray-300 bg-transparent text-gray-100 placeholder-gray-400 
                    focus:border-primary focus:ring-0 focus:outline-none
                    disabled:border-gray-500 disabled:bg-gray-700 disabled:text-gray-400 transition duration-200'
    ]) }} 
    placeholder="{{ $attributes->get('placeholder', 'Enter text...') }}"
>
