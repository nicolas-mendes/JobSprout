@props(['size'=> 'base'])

@php
    $classes = "bg-white/10 hover:bg-white/30 transition-colors duration-300 font-bold rounded-xl";

    if ($size == 'base'){
        $classes .= " px-5 py-1 text-ms";
    }
    
    if ($size == 'small'){
        $classes .= " px-3 py-1 text-2-xs";
    }

@endphp

<a href="" class="{{ $classes }}">{{ $slot }}</a>
