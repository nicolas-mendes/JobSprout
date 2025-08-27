<x-panel class="flex flex-col text-center ">
    <div class="self-start text-sm">Company</div>

    <div class="py-4">
        <h3 class="text-xl group-hover:text-blue-800 font-bold transition-colors duration-300">Job Title</h3>
        <p class="text-sm mt-4">Description</p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div>
            <x-tag size="small">PHP</x-tag>
            <x-tag size="small">Developer</x-tag>
            <x-tag size="small">Home-Office</x-tag>
        </div>

        <x-employer-logo :width="42"></x-employer-logo>
    </div>
</x-panel>
