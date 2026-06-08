<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Library;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\LoanRequested;
use App\Mail\LoanStatusUpdated;
use Illuminate\Support\Facades\Mail;

class LoanController extends Controller
{
    // Returns the form where the user can fill a request
    // for a loan for a book
    public function form_new(Book $book)
    {
        return view('loans.request', compact('book'));
    }

    // Posts the form data
    public function confirm_loan(Request $request, Book $book)
    {
        //? Validates the requested expiration date
        $min = now()->addDay()->toDateTimeString();
        $max = now()->addDays(28)->toDateTimeString();

        $data = $request->validate(
            [
                'date' => [
                    'required',
                    'date',
                    "after:$min",
                    "before_or_equal:$max",
                ],

                'quantity' => 'required|integer|min:1|max:' . $book->stock,
                'confirmacion_documento' => 'required|digits_between:1,10|exists:users,document_number',

            ],
            [
                'date.after' => "La fecha de devolución debe ser al menos un día después de hoy.",
                'date.before_or_equal' => "La fecha de devolución no puede ser más de 60 días después de hoy.",
                'quantity.max' => "No hay suficiente stock para esa cantidad. Stock disponible: {$book->stock}.",
                'confirmacion_documento.exists' => "El número de documento no coincide con el usuario autenticado.",
            ]
        );

        $loan = Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'status' => 'requested',
            'due_date' => $data['date'],
            'quantity' => $data['quantity'],
        ]);

        //? Sends the loan requested email
        if ($loan->user->email) {
            Mail::to($loan->user->email)->send(new LoanRequested($loan));
        }

        // Goes back to the own user loan list
        return redirect()->action([LoanController::class, 'list_user_loans'], ['user' => Auth::user()])
            ->with('success', 'El préstamo se ha registrado con éxito, pásese por la biblioteca para recogerlo.');
    }

    // Returns a view with all the loans of a user
    // It can be seen by either the own user or an admin
    public function list_user_loans(User $user)
    {
        // Abort if the user given is not the user logged in
        // And if the user logged in is not admin
        if (
            $user->id !== Auth::user()->id &&
            ! Auth::user()->roles->pluck('id')->contains(2)
        ) {
            abort(403);
        }

        // Retrieves every loan from the user
        $loans = $user->loans()->get();

        $library = Library::query()->first();

        return view('loans.user', compact('user', 'loans', 'library'));
    }

    // Returns a view with a form for editing a current loan
    public function show_edit_form(Loan $loan)
    {
        return view('management.loans.edit', compact('loan'));
    }

    // Updates a loan with the data from the edit form
    public function update_loan(Request $request, Loan $loan)
    {
        $data = $request->validate([
            'status' => 'required|in:requested,approved,rejected,returned',
            'due_date' => 'required|date|after_or_equal:created_at',
            'quantity' => 'required|integer|min:1',
            'returned_at' => 'nullable|date|after_or_equal:created_at',
        ], [
            'status.required' => 'El estado es obligatorio.',
            'due_date.required' => 'La fecha de devolución es obligatoria.',
            'quantity.required' => 'La cantidad es obligatoria.',
        ]);



        if ($data['status'] === 'returned' || $data['status'] === 'rejected') {
            $data['is_archived'] = 1;
        }

        $loan->update($data);

        //? Sends the loan status updated email
        $notify = ['approved', 'rejected', 'returned'];

        if (in_array($data['status'], $notify) && $loan->user->email) {
            Mail::to($loan->user->email)->send(new LoanStatusUpdated($loan));
        }

        return redirect()->action([LoanController::class, 'list_loans'])
            ->with('success', "El prestamo '{$loan->id}' se ha actualizado correctamente");
    }

    // Returns a view with every existent loan
    public function list_loans(Request $request): View
    {
        $search = $request->string('search')->toString();

        $loans = Loan::query()
            ->with(['user', 'book'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('status', 'LIKE', "%{$search}%")
                        ->orWhereHas('user', function ($query) use ($search) {
                            $query
                                ->where('first_name', 'LIKE', "%{$search}%")
                                ->orWhere('last_name', 'LIKE', "%{$search}%")
                                ->orWhere('email', 'LIKE', "%{$search}%")
                                ->orWhere('document_number', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('book', function ($query) use ($search) {
                            $query
                                ->where('title', 'LIKE', "%{$search}%")
                                ->orWhere('isbn', 'LIKE', "%{$search}%");
                        });
                });
            })
            ->get();

        return view('management.loans.index', compact('loans'));
    }

    // Drops a loan
    public function destroy(Loan $loan)
    {
        $loan->update(['is_archived' => 1]);

        return redirect()->action([LoanController::class, 'list_loans'])
            ->with('success', '¡El prestamo se ha archivado con éxito!');
    }

    // Restores a loan from the archived list
    public function restore(Request $request, Loan $loan)
    {
        $loan->update(['is_archived' => 0]);

        return redirect()->action([LoanController::class, 'list_loans'])
            ->with('success', '¡El prestamo se ha restaurado con éxito!');
    }
}
