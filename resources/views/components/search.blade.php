<input 
    type="text" 
    name="search" 
    {{ $attributes->merge(['placeholder' => 'Search...', 'class' => 'p-2 bg-black border-t-0 border-l-0 border-r-0 border-b-2 border-b-primary outline-none focus:border-primary focus:ring-transparent text-center text-gray-400 w-1/2']) }}
    onfocus="this.dataset.placeholder=this.placeholder; this.placeholder='';" 
    onblur="this.placeholder=this.dataset.placeholder"
/>
