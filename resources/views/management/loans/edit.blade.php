@extends('layouts.admin')

@section('title', 'Editar préstamo')

@section('content')
    <section class="section admin">
        <div class="admin_actions">
            <a href="{{ route('admin.loans') }}" class="button button-small">
                <span class="text long medium short">Volver a la lista de préstamos</span>
            </a>
        </div>

        <div class="form">
            <h1>Editar préstamo</h1>

            <form method="POST" action="{{ route('admin.loans.update', $loan->id) }}">
                @csrf
                @method('PUT')
                <div class="form_group">
                    <p>Préstamo de: {{ $loan->user->first_name }}</p>
                </div>

                <div class="form_group">
                    <label for="status">Estado</label>
                    <select id="status" name="status" required>
                        <option value="requested" {{ old('status', $loan->status) === 'requested' ? 'selected' : '' }}>
                            Solicitado
                        </option>
                        <option value="approved" {{ old('status', $loan->status) === 'approved' ? 'selected' : '' }}>En
                            curso
                        </option>
                        <option value="rejected" {{ old('status', $loan->status) === 'rejected' ? 'selected' : '' }}>
                            Rechazado
                        </option>
                        <option value="returned" {{ old('status', $loan->status) === 'returned' ? 'selected' : '' }}>
                            Devuelto
                        </option>
                    </select>
                </div>
                <div class="form_group">
                    <label for="loan_date">Fecha desde que se pidió</label>
                    <input type="date" id="loan_date" name="loan_date" value="{{ old('loan_date', $loan->loan_date) }}">
                </div>

                <div class="form_group">
                    <label for="due_date">Fecha de expiración</label>
                    <input type="date" id="due_date" name="due_date" value="{{ old('due_date', $loan->due_date) }}">
                </div>

                <div class="form_group">
                    <label for="quantity">Cantidad</label>
                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $loan->quantity) }}">
                </div>

                <div class="form_group">
                    <label for="returned_at">Fecha de devolución</label>
                    <input type="datetime-local" id="returned_at" name="returned_at"
                        value="{{ old('returned_at', $loan->returned_at) }}">
                </div>

                <button type="submit">Actualizar préstamo</button>
            </form>
        </div>
    </section>
@endsection
