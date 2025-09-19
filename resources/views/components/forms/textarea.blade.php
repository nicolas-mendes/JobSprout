@props(['label', 'name', 'value' => ''])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'rows' => "6",
        'class' => 'block w-full rounded-xl bg-white/10 border border-white/10 px-5 py-4',
        // A chave 'value' foi REMOVIDA daqui
    ];
@endphp

<x-forms.field :$label :$name>
    <textarea {{ $attributes->merge($defaults) }}>{{ old($name, $value) }}</textarea>
</x-forms.field>
