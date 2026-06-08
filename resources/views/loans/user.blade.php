@extends('layouts.main')

@section('title', 'Préstamos de ' . $user->first_name)

@section('content')
    <section class="section admin">
        <h2>Préstamos de {{ $user->first_name }}</h2>
        @if ($loans->isEmpty())
            <p>No se encontraron préstamos.</p>
        @else
            <div class="grid">
                @foreach ($loans as $loan)
                    <div class="elementBox">
                        <div class="loanInfo">
                            <h2>{{ $loan->book->title }}</h2>
                            <div class="loanInfoItem">
                                <h5>Estado:</h5>
                                <p>{{ $loan->displayStatus }}</p>
                            </div>

                            <div class="loanInfoItem">
                                <h5>Fecha de préstamo:</h5>
                                <p>{{ $loan->created_at_formatted }}</p>
                            </div>

                            <div class="loanInfoItem">
                                <h5>Fecha de devolución:</h5>
                                <p>{{ $loan->due_date_formatted }}</p>
                            </div>
                            <div class="loanInfoItem">
                                <h5>Cantidad:</h5>
                                <p>{{ $loan->quantity }}</p>
                            </div>
                        </div>


                        <div class="actions">
                            @if (Auth::user()->roles->pluck('name')->contains('admin'))
                                <a class="button button-small" href="{{ route('admin.loans.edit', $loan) }}">
                                    <div class="text">Editar</div>
                                </a>
                            @endif

                            @if ($loan->status === 'requested' && Auth::user()->roles->pluck('name')->contains('admin'))
                                <form method="POST" action="{{ route('admin.loans.destroy', $loan->id) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button button-small button-danger"
                                        onclick="return confirm('Estás seguro?')">
                                        <div class="text">Cancelar</div>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            </div>
        @endif
    </section>
@endsection
