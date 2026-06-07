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
        //administrative statistics
        // Retrieve the 5 most recent loans ordered by loan_date descending
        $recentLoans = Loan::orderBy('loan_date', 'desc')->take(5)->get();
        // Retrieve top 5 books with the most loans
        $topBorrowedBooks = Book::withCount('loans')
            ->with('authors')
            ->orderBy('loans_count', 'desc')
            ->take(5)
            ->get();
        $users = User::query()->count();

        return view('management.index', compact('recentLoans', 'topBorrowedBooks', 'users'));
    }


    public function show_config_form(){
        $config = Library::first();

        return view('management.config.index', compact('config'));
    }

    public function update_config(Request $request){
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
        ]);

        $config = Library::first();
        $config->update($data);

        return redirect()->route('admin.index')->with('success', 'Configuración actualizada correctamente.');
    }
}
