@if ($paginator->hasPages())
    <nav class="news-pager" role="navigation" aria-label="Pagination">
        @if ($paginator->onFirstPage())
            <span class="news-pager-btn is-disabled">← Sebelumnya</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="news-pager-btn">← Sebelumnya</a>
        @endif

        <span class="news-pager-info">Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}</span>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="news-pager-btn">Selanjutnya →</a>
        @else
            <span class="news-pager-btn is-disabled">Selanjutnya →</span>
        @endif
    </nav>
@endif
