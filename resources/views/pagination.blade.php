{{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>--}}
{{--@if ($paginator->hasPages())--}}
{{--    <ul class="pagination">--}}
{{--        --}}{{-- Previous Page Link --}}
{{--        @if ($paginator->onFirstPage())--}}
{{--            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>--}}
{{--        @else--}}
{{--            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>--}}
{{--        @endif--}}

{{--        --}}{{-- Pagination Elements --}}
{{--        @foreach ($elements as $element)--}}
{{--            --}}{{-- "Three Dots" Separator --}}
{{--            @if (is_string($element))--}}
{{--                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>--}}
{{--            @endif--}}

{{--            --}}{{-- Array Of Links --}}
{{--            @if (is_array($element))--}}
{{--                @foreach ($element as $page => $url)--}}
{{--                    @if ($page == $paginator->currentPage())--}}
{{--                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>--}}
{{--                    @else--}}
{{--                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--        @endforeach--}}

{{--        --}}{{-- Next Page Link --}}
{{--        @if ($paginator->hasMorePages())--}}
{{--            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>--}}
{{--        @else--}}
{{--            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>--}}
{{--        @endif--}}
{{--    </ul>--}}
{{--@endif--}}
@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
    </ul>
@endif

<style>
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        margin-top: 20px;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination li a, .pagination li span {
        color: #000;
        text-decoration: none;
        display: block;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .pagination li.active span, .pagination li a:hover {
        background-color: #2E5CFE;
        color: #fff;
    }

    .pagination li.disabled span, .pagination li.disabled a {
        color: #777;
        cursor: not-allowed;
    }

    .pagination li.disabled a:hover {
        background-color: #fff;
    }
</style>
