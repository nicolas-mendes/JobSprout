@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{!! __('Pagination Navigation') !!}" class="flex items-center justify-between">
        {{-- Botão "Anterior" --}}
        <div>
            @if ($paginator->onFirstPage())
                {{-- ESTILO DESABILITADO --}}
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-white/5 border border-white/10 text-white/50 cursor-default leading-5 rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                {{-- ESTILO HABILITADO (COM COR BASE) --}}
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-white/10 border border-white/25 text-gray-200 rounded-md leading-5 font-bold hover:text-sprout hover:border-sprout transition-colors duration-300">
                    {!! __('pagination.previous') !!}
                </a>
            @endif
        </div>

        {{-- Botão "Próximo" --}}
        <div>
            @if ($paginator->hasMorePages())
                {{-- ESTILO HABILITADO (COM COR BASE) --}}
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-white/10 border border-white/25 text-gray-200 rounded-md leading-5 font-bold hover:text-sprout hover:border-sprout transition-colors duration-300">
                    {!! __('pagination.next') !!}
                </a>
            @else
                {{-- ESTILO DESABILITADO --}}
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-white/5 border border-white/10 text-white/50 cursor-default leading-5 rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>
    </nav>
@endif