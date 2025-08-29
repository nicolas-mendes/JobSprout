@props(['label', 'name'])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'rows' => "6",
        'class' => 'block w-full rounded-xl bg-white/10 border border-white/10 px-5 py-4 focus:outline-2 focus:-outline-offset-2',
        'value' => old($name)
    ];
@endphp

<x-forms.field :$label :$name>
    <textarea {{ $attributes($defaults) }}></textarea>
</x-forms.field>