@props(['type' => 'submit'])
<button type="{{ $type }}" {{ $attributes(['class' => 'bg-blue-800 rounded py-2 px-6 font-bold']) }}>{{ $slot }}</button>

