<?php

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

uses(TestCase::class);

test('book_list and news_list include the shared search partial', function () {
    $bookList = file_get_contents(resource_path('views/book_list.blade.php'));
    $newsList = file_get_contents(resource_path('views/news_list.blade.php'));
    $managementBooksIndex = file_get_contents(resource_path('views/management/books/index.blade.php'));
    $managementAuthorsIndex = file_get_contents(resource_path('views/management/authors/index.blade.php'));
    $managementCategoriesIndex = file_get_contents(resource_path('views/management/categories/index.blade.php'));
    $managementUsersIndex = file_get_contents(resource_path('views/management/users/index.blade.php'));
    $managementLoansIndex = file_get_contents(resource_path('views/management/loans/index.blade.php'));
    $managementNewsIndex = file_get_contents(resource_path('views/management/news/index.blade.php'));

    expect($bookList)->toContain('partials.search');
    expect($newsList)->toContain('partials.search');
    expect($managementBooksIndex)->toContain('partials.search');
    expect($managementAuthorsIndex)->toContain('partials.search');
    expect($managementCategoriesIndex)->toContain('partials.search');
    expect($managementUsersIndex)->toContain('partials.search');
    expect($managementLoansIndex)->toContain('partials.search');
    expect($managementNewsIndex)->toContain('partials.search');
});

test('search partial renders categories select in books mode', function () {
    $html = Blade::render(
        '@include("partials.search", ["action" => "/books/search", "mode" => "books", "categories" => $categories])',
        [
            'categories' => collect([
                (object) ['id' => 1, 'name' => 'Ficción'],
            ]),
        ],
    );

    expect($html)->toContain('name="categories[]"');
    expect($html)->toContain('multiple');
});
