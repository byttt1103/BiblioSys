<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'loan_date',
        'due_date',
        'quantity',
        'returned_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

     protected function displayStatus(): Attribute
    {
    return Attribute::make(
        get: function () {
                return match ($this->status) {
                    'requested' => 'Solicitado',
                    'approved' => 'Aprobado',
                    'rejected' => 'Rechazado',
                    'returned' => 'Devuelto',
                default => $this->status,
                };
            }
        );
    }

}
