@props(['href'])

<a href="{{ $href }}" {{ $attributes(['class' => 'flex rounded text-white py-2 px-6 font-bold text-md justify-self-center bg-white/5 rounded-md border border-transparent hover:border-sprout hover:text-sprout transition-colors duration-300']) }} > {{ $slot }} </a>
