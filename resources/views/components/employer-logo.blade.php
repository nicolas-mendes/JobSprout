@props(['logo', 'width' => 90])
<div><img src="{{ $logo ? asset('storage/' . $logo) : 'http://placehold.co/' . $width }}" alt="Employer Logo" class="rounded-xl" width="{{ $width }}"></div>