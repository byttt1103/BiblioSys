@php
    // Initialize reset URL to clear all search filters
    $resetUrl = url()->current();
    $selectedCategoryNames = collect();
    $action = $action ?? '';
    $placeholder = $placeholder ?? 'Busca...';
    $search = $search ?? old('search', request('search'));
    $mode = $mode ?? null;
    $required = $required ?? false;
    $categories = $categories ?? collect();
    $selectedCategories = $selectedCategories ?? request('categories', []);

    // Get names of selected categories for display
    if (!empty($selectedCategories)) {
        $selectedCategoryNames = $categories->whereIn('id', $selectedCategories)->pluck('name');
    }
@endphp

<form  class="searchBar_form" action="{{ $action }}" method="GET">
    <div class="searchBar_fields">
        <div class="searchBar_field">
            <input class="searchBar_input" type="text" name="search" placeholder="{{ $placeholder }}"
                value="{{ $search }}" aria-label="{{ $placeholder }}"
                @if ($required) required @endif />
        </div>

        @if ($mode === 'books')

            @php
                $selectedCategoryIds = array_map('strval', (array) $selectedCategories);
            @endphp

            <div class="searchBar_field">
                <div class="multi_select">
                    @foreach ($categories as $category)
                        <div class="select_item">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                id="category_{{ $category->id }}" @checked(in_array((string) $category->id, $selectedCategoryIds, true))>

                            <label for="category_{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

        @endif

        {{-- Display selected category names --}}
        @if ($mode === 'books' && $selectedCategoryNames->isNotEmpty())
            <p class="searchBar_current" aria-label="Categorías seleccionadas">
                Categoría: {{ implode(', ', $selectedCategoryNames->toArray()) }}
            </p>
        @endif
    </div>
    <div class="buttons">
        <button class="button button-small" type="submit">
            <div class="text">Buscar</div>
        </button>
        <a href="{{ $resetUrl }}" class="button button-small searchBar__reset">
            <div class="text">Reiniciar búsqueda</div>
        </a>
    </div>
</form>
