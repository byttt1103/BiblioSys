<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Hold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HoldController extends Controller
{
    // ==== Holds ====



    public function toggle(Book $book)
    {
        $user = Auth::user();

        $existing = Hold::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $message = 'Se ha cancelado tu aviso de disponibilidad.';
        } else {
            Hold::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
            ]);
            $message = '¡Listo! Te avisaremos cuando el libro esté disponible.';
        }

        return redirect()->route('book.list')->with('success', $message);
    }
}
