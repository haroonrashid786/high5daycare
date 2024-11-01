<style>
    /* Basic pagination styles */
.pagination {
    display: flex;
    list-style: none;
    padding: 10px 0;
    justify-content: center;
    align-items: center;
}

.pagination li {
    margin: 0 2px;
}

/* Style for previous and next buttons */
.page-link {
    display: inline-block;
    padding: 10px 15px;
    background-color: #eb673a;
    color: #fff;
    border: 1px solid #eb673a;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.page-link:hover {
    background-color: #ff8c5d;
}

/* Style for the current page */
.current {
    background-color: #557239 !important;
    border: 1px solid #557239 !important;
}

/* Disabled state */
.disabled {
    pointer-events: none;
    opacity: 0.6;
}

</style>

@if ($paginator->lastPage() > 1)
    <ul class="pagination pb-[3rem]">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">&laquo;</span>
            </li>
        @else
            <li class="page-item" id="previousPage">
                <a href="{{ $paginator->previousPageUrl() }}" class="page-link">&laquo;</a>
            </li>
        @endif

        @php
            $visiblePages = 5; // Number of visible pages
            $half = floor($visiblePages / 2);
            $start = max(1, $paginator->currentPage() - $half);
            $end = min($paginator->lastPage(), $start + $visiblePages - 1);
        @endphp

        @if ($start > 1)
            <li class="page-item">
                <a href="{{ $paginator->url(1) }}" class="page-link">1</a>
            </li>
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
        @endif

        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $paginator->currentPage())
                <li class="page-item active">
                    <span class="page-link">{{ $i }}</span>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
            @endif
        @endfor

        @if ($end < $paginator->lastPage())
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
            <li class="page-item">
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link">{{ $paginator->lastPage() }}</a>
            </li>
        @endif

        @if ($paginator->hasMorePages())
            <li class="page-item" id="nextPage">
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link">&raquo;</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">&raquo;</span>
            </li>
        @endif
    </ul>
@endif




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Get the current URL parameters
        const currentParams = new URLSearchParams(window.location.search);

        // Add a click event handler to all pagination links
        $('.pagination a.page-link').click(function (event) {
            event.preventDefault();

            // Get the URL from the clicked pagination link
            const url = new URL($(this).attr('href'), window.location.origin);

            // Get the page parameter from the clicked URL
            const pageParam = url.searchParams.get('page');

            if (pageParam) {
                // If the clicked URL contains a page parameter, update it
                currentParams.set('page', pageParam);
            } else {
                // If the clicked URL doesn't contain a page parameter, remove it from the current parameters
                currentParams.delete('page');
            }

            // Update the URL with the modified parameters
            url.search = currentParams.toString();
            window.location.href = url.toString();
        });
    });

</script>
