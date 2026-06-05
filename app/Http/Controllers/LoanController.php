<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Validates the requested expiration date
        $min = now()->addDay()->toDateString();
        $max = now()->addDays(60)->toDateString();

        $data = $request->validate([
            'fecha' => [
                'required',
                'date',
                "after:$min",
                "before_or_equal:$max",
            ],
        ]);

        $loan = Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'status' => 'requested',
            'loan_date' => now(),
            'due_date' => $data['fecha'],
            'quantity' => 1,
        ]);

        // Goes back to the own user loan list
        return redirect()->action([LoanController::class, 'list_user_loans'], ['user' => Auth::user()])
            ->with('success', 'El prestamo se ha registrado con exito, pasese por la biblioteca para recogerlo.');
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

        return view('loans.user', compact('user', 'loans'));
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
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:loan_date',
            'quantity' => 'required|integer|min:1',
            'returned_at' => 'nullable|date',
        ]);

        $loan->update($data);

        return redirect()->action([LoanController::class, 'list_loans'])
            ->with('success', 'El prestamo se ha actualizado correctamente');
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
        $loan->delete();

        return redirect()->action([LoanController::class, 'list_loans'])
            ->with('success', 'El prestamo se ha actualizado correctamente');
    }
}
