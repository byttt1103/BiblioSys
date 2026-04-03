{{-- Paginator

The paginator is a handful tool if we have too much elements
to show in a grid or a list, and want to divide them in more
"subpages", without making another and another page.

--}}

{{-- this if is to wether to show the paginator or not,
depending if the content can be divided in various pages by
the paginator or not  --}}
@if ($paginator->haspages())

    {{-- If the paginator is on the first page,
    disable the previous page button --}}
    @if ($paginator->onFirstPage())
        <a class="disabled_button">
            <div class="text long"><span aria-hidden="true">🠔</span> Página Anterior</div>
            <div class="text medium" aria-hidden="true"> 🠔 Anterior</div>
            <div class="text short" aria-hidden="true"> 🠔 </div>
        </a>

        {{-- if not, enable the previous page button --}}
    @else
        <a class="button" href="{{ $paginator->previousPageUrl() }}">
            <div class="text long"><span aria-hidden="true">🠔</span> Página Anterior</div>
            <div class="text medium" aria-hidden="true"> 🠔 Anterior</div>
            <div class="text short" aria-hidden="true"> 🠔 </div>
        </a>
    @endif

    <div class="page_links">
        {{-- Array of elements (page links) --}}
        {{-- For each element (link) in this array, sort the page numbers and the gaps between them --}}
        @foreach ($elements as $element)

        {{-- if there are too many pages, to tidy up the paginator, there will be dots --}}
            @if (is_string($element))
            <span class="dots">{{ $element }}</span>
            @endif
        {{-- If there are pages' links, make an element for them --}}
            @if (is_array($element))
            @foreach ($element as $page => $url )

                {{-- If the current page matches the current page number, disable it --}}
                @if ($page == $paginator->currentPage())
                    <div class="disabled_button" aria-current="page"><span class="text">{{ $page }}</span></div>

                    {{-- for other pages' links, enable them --}}
                @else
                    <a href="{{ $url }}" class="button"><span class="text">{{ $page }}</span></a>
                @endif

            @endforeach
            @endif
        @endforeach
    </div>

    {{-- If the paginator has more pages to show, enable the next page button --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="button">
            <div class="text long">Página Siguiente <span aria-hidden="true">🠚</span></div>
            <div class="text medium" aria-hidden="true">Siguiente 🠚 </div>
            <div class="text short" aria-hidden="true"> 🠚 </div>
        </a>

        {{-- but if not, leave it disabled --}}
    @else
        <a href="" class="disabled_button">
            <div class="text long">Página Siguiente <span aria-hidden="true">🠚</span></div>
            <div class="text medium" aria-hidden="true">Siguiente 🠚 </div>
            <div class="text short" aria-hidden="true"> 🠚 </div>
        </a>
    @endif
@endif
