    <ul class="pagination">

        @if ($paginator->onFirstPage())
            <li>
                <a title="Previous"
                   class="m-datatable__pager-link m-datatable__pager-link--first m-datatable__pager-link--disabled"
                   data-page="1" disabled="disabled">Primero</a></li>
        @else
            <li>
                <a href="{{$paginator->previousPageUrl()}}" title="Previous"
                   class="m-datatable__pager-link m-datatable__pager-link--first m-datatable__pager-link--active"
                   data-page="1" disabled="disabled">Primero</a></li>

        @endif

            <li style="display: none;"><a title="More pages"
                                          class="m-datatable__pager-link m-datatable__pager-link--more-prev"
                                          data-page="1"><i class="la la-ellipsis-h"></i></a></li>
            <li style="display: none;"><input type="text" class="m-pager-input form-control" title="Page number"></li>

            {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                    <li><a class="m-datatable__pager-link m-datatable__pager-link-number m-datatable__pager-link--disabled"
                           data-page="1" title="{{ $element }}">{{ $element }}</a></li>
            @endif



            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                            <li><a class="m-datatable__pager-link m-datatable__pager-link-number m-datatable__pager-link--active"
                                   data-page="{{$page}}" title="{{ $page }}">{{ $page }}</a></li>
                    @else
                            <li><a href="{{ $url }}" class="m-datatable__pager-link m-datatable__pager-link-number m-datatable__pager-link"
                                   data-page="" title="">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" title="Next" class="m-datatable__pager-link m-datatable__pager-link--active" data-page="">
                Ultimo</a></li>
            @else
                <li><a title="Next" class="m-datatable__pager-link m-datatable__pager-link--disabled" data-page="" disabled="disabled">Ultimo</a></li>
            @endif



    </ul>
