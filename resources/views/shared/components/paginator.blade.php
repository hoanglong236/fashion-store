@php
    $firstPage = 1;
    $currentPage = $paginator->currentPage();
    $lastPage = $paginator->lastPage();
@endphp
<div class="paginator">
    <ul class="pagination">
        <li>
            <a href="{{ $paginator->url($firstPage) }}" @disabled($currentPage <= $firstPage)>
                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
            </a>
        </li>
        <li>
            <a href="{{ $paginator->url(max($currentPage - 1, $firstPage)) }}" @disabled($currentPage <= $firstPage)>
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
        </li>
        <li><a class="paginator-current-link" href="#">{{ $currentPage . '/' . $lastPage }}</a></li>
        <li>
            <a href="{{ $paginator->url(min($currentPage + 1, $lastPage)) }}" @disabled($currentPage >= $lastPage)>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
        </li>
        <li>
            <a href="{{ $paginator->url($lastPage) }}" @disabled($currentPage >= $lastPage)>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
</div>
