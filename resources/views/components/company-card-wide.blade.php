@props(['employer'])
<x-panel class="flex gap-x-6" >
    <x-employer-logo :width="90" :logo="$employer->logo" class="flex-shrink-0" />

    <div class="flex flex-col grow overflow-hidden">
    
        <div class="flex justify-between items-start">
            <a href="/company/{{$employer->id}}" class="font-bold text-xl group-hover:text-sprout transition-colors duration-300">{{ $employer->name }}</a>
            <p class="text-sm text-gray-400">{{ $employer->email }}</p>
        </div>

        <div class="my-2 text-sm text-gray-400">
             <p class="line-clamp-3"> {{ $employer->description }} </p>
        </div>
    </div>
</x-panel>  