@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" style="display: flex; justify-content: center; gap: 8px; flex-wrap: wrap;">
        @if ($paginator->onFirstPage())
            <span class="pill" style="opacity: 0.5; cursor: not-allowed;">&laquo; Sebelumnya</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pill">&laquo; Sebelumnya</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="pill">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pill active" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pill">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pill">Berikutnya &raquo;</a>
        @else
            <span class="pill" style="opacity: 0.5; cursor: not-allowed;">Berikutnya &raquo;</span>
        @endif
    </nav>
@endif
