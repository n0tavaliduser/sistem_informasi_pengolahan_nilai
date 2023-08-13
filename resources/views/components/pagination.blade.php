<div class="d-flex justify-content-end">
    <div class="pagination-wrap hstack gap-2">
        @if($data->currentPage() != 1)
        <a class="page-item pagination-prev" href="{{ route($route, ['page' => $data->currentPage() - 1]) }}">
            Previous
        </a>
        @endif
        @if($data->currentPage() > 3)
            <a class="page-item pagination-next" href="{{ route($route, ['page' => 1]) }}">
                ...
            </a>
        @endif
        @for ($i = $data->currentPage() - 1; $i < $data->currentPage() + 2; $i++)
            @if($i != 0 && $i <= $data->lastPage())
                <a class="page-item pagination-next {{ $i === $data->currentPage() ? 'disabled' : '' }}" href="{{ route($route, ['page' => $i]) }}">
                    {{ $i }}
                </a>
            @endif
        @endfor
        @if($data->currentPage() < $data->lastPage() - 1)
            <a class="page-item pagination-next" href="{{ route($route, ['page' => $data->lastPage()]) }}">
                ...
            </a>
        @endif
        @if($data->currentPage() != $data->lastPage())
        <a class="page-item pagination-next" href="{{ route($route, ['page' => $data->currentPage() + 1]) }}">
            Next
        </a>
        @endif
    </div>
</div>