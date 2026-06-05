<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Tests\TestCase;

uses(TestCase::class);

final class FakePaginator
{
    public function withQueryString(): static
    {
        return $this;
    }
}

final class FakeTextFilterBuilder
{
    public array $wheres = [];

    public function where(string $column, string $operator, string $value): static
    {
        $this->wheres[] = [$column, $operator, $value];

        return $this;
    }

    public function orWhere(string $column, string $operator, string $value): static
    {
        $this->wheres[] = [$column, $operator, $value];

        return $this;
    }
}

final class FakeCategoryFilterBuilder
{
    public array $whereIns = [];

    public function whereIn(string $column, iterable $values): static
    {
        $this->whereIns[] = [$column, is_array($values) ? $values : collect($values)->all()];

        return $this;
    }
}

final class FakeBookBuilder
{
    public array $with = [];

    public array $textFilterColumns = [];

    public array $categoryFilterIds = [];

    public function with(string|array $relations): static
    {
        $this->with = is_array($relations) ? $relations : [$relations];

        return $this;
    }

    public function when(bool $condition, callable $callback): static
    {
        if ($condition) {
            $callback($this);
        }

        return $this;
    }

    public function where(callable $callback): static
    {
        $builder = new FakeTextFilterBuilder;

        $callback($builder);

        $this->textFilterColumns = array_values(array_unique(array_map(
            static fn (array $where): string => $where[0],
            $builder->wheres,
        )));

        return $this;
    }

    public function whereHas(string $relation, callable $callback): static
    {
        $builder = new FakeCategoryFilterBuilder;

        $callback($builder);

        $ids = $builder->whereIns[0][1] ?? [];
        $this->categoryFilterIds = $ids;

        return $this;
    }

    public function paginate(int $perPage): FakePaginator
    {
        return new FakePaginator;
    }

    public function get(): array
    {
        return [];
    }
}

test('HomeController::book_list pasa categories a book_list', function () {
    $categories = collect([(object) ['id' => 1, 'name' => 'Ficción']]);

    $bookBuilder = new FakeBookBuilder;

    Mockery::mock('alias:'.Book::class)
        ->shouldReceive('query')
        ->once()
        ->andReturn($bookBuilder);

    $categoryQuery = Mockery::mock();
    $categoryQuery->shouldReceive('orderBy')->once()->andReturnSelf();
    $categoryQuery->shouldReceive('get')->once()->andReturn($categories);

    Mockery::mock('alias:'.Category::class)
        ->shouldReceive('query')
        ->once()
        ->andReturn($categoryQuery);

    $view = app(HomeController::class)->book_list();

    expect($view)->toBeInstanceOf(View::class);
    expect($view->getData()['categories'])->toEqual($categories);
});

test('BookController::search filtra por search y categories[] y mantiene query string', function () {
    $categories = collect([(object) ['id' => 1, 'name' => 'Ficción']]);

    $bookBuilder = new FakeBookBuilder;

    Mockery::mock('alias:'.Book::class)
        ->shouldReceive('query')
        ->once()
        ->andReturn($bookBuilder);

    $categoryQuery = Mockery::mock();
    $categoryQuery->shouldReceive('orderBy')->once()->andReturnSelf();
    $categoryQuery->shouldReceive('get')->once()->andReturn($categories);

    Mockery::mock('alias:'.Category::class)
        ->shouldReceive('query')
        ->once()
        ->andReturn($categoryQuery);

    $request = Request::create('/books/search', 'GET', [
        'search' => 'Harry',
        'categories' => ['2', '3'],
    ]);

    $view = app(BookController::class)->search($request);

    expect($view)->toBeInstanceOf(View::class);
    expect($view->name())->toBe('book_list');
    expect($view->getData())->toHaveKeys(['books', 'categories']);

    expect($bookBuilder->with)->toBe(['authors', 'categories']);
    expect($bookBuilder->textFilterColumns)->toEqualCanonicalizing(['title', 'publisher', 'synopsis', 'isbn']);
    expect($bookBuilder->categoryFilterIds)->toEqual([2, 3]);
});

test('BookController::index filtra por search y categories[] y carga authors', function () {
    $categories = collect([(object) ['id' => 1, 'name' => 'Ficción']]);

    $bookBuilder = new FakeBookBuilder;

    Mockery::mock('alias:'.Book::class)
        ->shouldReceive('query')
        ->once()
        ->andReturn($bookBuilder);

    $categoryQuery = Mockery::mock();
    $categoryQuery->shouldReceive('orderBy')->once()->andReturnSelf();
    $categoryQuery->shouldReceive('get')->once()->andReturn($categories);

    Mockery::mock('alias:'.Category::class)
        ->shouldReceive('query')
        ->once()
        ->andReturn($categoryQuery);

    $request = Request::create('/admin/books', 'GET', [
        'search' => 'Harry',
        'categories' => ['2', '3'],
    ]);

    $view = app(BookController::class)->index($request);

    expect($view)->toBeInstanceOf(View::class);
    expect($view->name())->toBe('management.books.index');
    expect($view->getData())->toHaveKeys(['books', 'categories']);

    expect($bookBuilder->with)->toBe(['authors']);
    expect($bookBuilder->textFilterColumns)->toEqualCanonicalizing(['title', 'publisher', 'synopsis', 'isbn']);
    expect($bookBuilder->categoryFilterIds)->toEqual([2, 3]);
});
