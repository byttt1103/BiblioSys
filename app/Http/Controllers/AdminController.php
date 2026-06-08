<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Library;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {


        //? admin badges
        $users = User::query()->count();
        $books = Book::query()->count();
        $loans = Loan::query()->count();
        $overdueLoans = Loan::query()
            ->whereNull('returned_at') // If not returned
            ->where('due_date', '<', now()) // If overdue date
            ->count();

        //? administrative charts
        //* Retrieve the 5 most recent loans ordered by loan_date descending
        $recentLoans = Loan::with(['user', 'book'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        //* Retrieve top 5 books with the most loans
        $topBorrowedBooks = Book::withCount('loans')
            ->with('authors')
            ->orderBy('loans_count', 'desc')
            ->take(5)
            ->get();


        //* Retrieve top 5 users with the most loans
        $topUsers = User::withCount('loans')
            ->orderBy('loans_count', 'desc')
            ->take(5)
            ->get();

        //* Retrieve top 5 books with the lowest stock
        $lowStockBooks = Book::query()
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();
            
        return view('management.index', compact('books', 'loans', 'recentLoans', 'topBorrowedBooks', 'users', 'topUsers', 'lowStockBooks', 'overdueLoans'));
    }


    public function show_config_form()
    {
        $config = Library::first();

        return view('management.config.index', compact('config'));
    }

    public function update_config(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string|max:1000',
            'opening_hour_weekday' => 'date_format:H:i',
            'closing_hour_weekday' => 'date_format:H:i',
            'opening_hour_weekend' => 'date_format:H:i',
            'closing_hour_weekend' => 'date_format:H:i',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'address.max' => 'La dirección no puede exceder 255 caracteres.',
            'phone_number.max' => 'El número de teléfono no puede exceder 20 caracteres.',
            'email.max' => 'El correo electrónico no puede exceder 255 caracteres.',
            'description.max' => 'La descripción no puede exceder 1000 caracteres.',
            'opening_hour_weekday.required' => 'El horario de apertura de la semana es obligatorio.',
            'closing_hour_weekday.required' => 'El horario de cierre de la semana es obligatorio.',
            'opening_hour_weekend.required' => 'El horario de apertura de fin de semana es obligatorio.',
            'closing_hour_weekend.required' => 'El horario de cierre de fin de semana es obligatorio.',
        ]);

        $config = Library::first();
        $config->update($data);

        return redirect()->route('admin.index')->with('success', 'Configuración actualizada correctamente.');
    }
}
