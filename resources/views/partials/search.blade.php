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

<form id="searchBar" class="searchBar" action="{{ $action }}" method="GET">
    <div class="searchBar__fields">
        <div class="searchBar__field">
            <input
                class="searchBar__input"
                type="text"
                name="search"
                placeholder="{{ $placeholder }}"
                value="{{ $search }}"
                aria-label="{{ $placeholder }}"
                @if($required) required @endif
            />
        </div>

        @if ($mode === 'books')
            <div class="searchBar__field">
                <select class="searchBar__select" name="categories[]" multiple aria-label="Categorías">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(in_array((string) $category->id, array_map('strval', (array) $selectedCategories), true))>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        {{-- Display selected category names --}}
        @if ($mode === 'books' && $selectedCategoryNames->isNotEmpty())
            <p class="searchBar__selected-categories" aria-label="Categorías seleccionadas">
               Categoría: {{ implode(', ', $selectedCategoryNames->toArray()) }}
            </p>
        @endif
    </div>
    <div class="buttons">
        <button class=" button searchBar__submit" type="submit"><div class="text">Buscar</div></button>
        <a href="{{ $resetUrl }}" class="button searchBar__reset"><div class="text">Reiniciar búsqueda</div></a>
    </div>
</form>
