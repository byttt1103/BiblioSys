<?php

use App\Http\Controllers\LoanController;
use App\Http\Controllers\NewsController;
use App\Models\Loan;
use App\Models\News;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Tests\TestCase;

uses(TestCase::class);

final class FakeLoanRelationBuilder
{
    public array $columns = [];

    public function where(string $column, string $operator, string $value): static
    {
        $this->columns[] = $column;

        return $this;
    }

    public function orWhere(string $column, string $operator, string $value): static
    {
        $this->columns[] = $column;

        return $this;
    }
}

final class FakeLoanWhereBuilder
{
    public array $statusColumns = [];

    public array $orWhereHasRelations = [];

    public array $relationColumns = [];

    public function where(string $column, string $operator, string $value): static
    {
        $this->statusColumns[] = $column;

        return $this;
    }

    public function orWhereHas(string $relation, callable $callback): static
    {
        $builder = new FakeLoanRelationBuilder;

        $callback($builder);

        $this->orWhereHasRelations[] = $relation;
        $this->relationColumns[$relation] = array_values(array_unique($builder->columns));

        return $this;
    }
}

final class FakeLoanBuilder
{
    public array $with = [];

    public ?FakeLoanWhereBuilder $whereBuilder = null;

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
        $builder = new FakeLoanWhereBuilder;

        $callback($builder);

        $this->whereBuilder = $builder;

        return $this;
    }

    public function get(): array
    {
        return [];
    }
}

final class FakeNewsBuilder
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

    public function get(): array
    {
        return [];
    }
}

test('LoanController::list_loans filtra por search y carga user y book', function () {
    $loanBuilder = new FakeLoanBuilder;

    Mockery::mock('alias:'.Loan::class)
        ->shouldReceive('query')
        ->once()
        ->andReturn($loanBuilder);

    $request = Request::create('/admin/loan', 'GET', [
        'search' => 'ana',
    ]);

    $view = app(LoanController::class)->list_loans($request);

    expect($view)->toBeInstanceOf(View::class);
    expect($view->name())->toBe('management.loans.index');
    expect($loanBuilder->with)->toEqualCanonicalizing(['user', 'book']);

    expect($loanBuilder->whereBuilder?->statusColumns)->toContain('status');
    expect($loanBuilder->whereBuilder?->orWhereHasRelations)->toEqualCanonicalizing(['user', 'book']);
    expect($loanBuilder->whereBuilder?->relationColumns['user'])->toEqualCanonicalizing(['first_name', 'last_name', 'email', 'document_number']);
    expect($loanBuilder->whereBuilder?->relationColumns['book'])->toEqualCanonicalizing(['title', 'isbn']);
});

test('NewsController::search usa el query string search (no query)', function () {
    $newsBuilder = new FakeNewsBuilder;

    Mockery::mock('alias:'.News::class)
        ->shouldReceive('query')
        ->once()
        ->andReturn($newsBuilder);

    $request = Request::create('/news/search', 'GET', [
        'search' => 'laravel',
    ]);

    $view = app(NewsController::class)->search($request);

    expect($view)->toBeInstanceOf(View::class);
    expect($view->name())->toBe('news_list');
    expect($newsBuilder->wheres[0][0])->toBe('title');
    expect($newsBuilder->wheres[0][2])->toContain('laravel');
});

test('NewsController::search no ejecuta query si falta search', function () {
    Mockery::mock('alias:'.News::class)
        ->shouldReceive('query')
        ->never();

    $request = Request::create('/news/search', 'GET', [
        'query' => 'laravel',
    ]);

    $view = app(NewsController::class)->search($request);

    expect($view)->toBeInstanceOf(View::class);
    expect($view->name())->toBe('news_list');
    expect($view->getData()['news'])->toBeEmpty();
});
