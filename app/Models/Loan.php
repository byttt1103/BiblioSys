<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Loan extends Model
{
    protected $fillable = [
        'you', //huh
        'user_id',
        'book_id',
        'status',
        'is_archived',
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
                    'approved' => 'En curso (aprobado)',
                    'rejected' => 'Rechazado',
                    'returned' => 'Devuelto',
                    default => $this->status,
                };
            }
        );
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'due_date' => 'datetime',
            'returned_at' => 'datetime',
        ];
    }


    protected function createdAtFormatted(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                // Get the raw string stored in the database without modifying the native object
                $rawDate = $attributes['created_at'] ?? null;

                // Format it exclusively for display as plain text
                return $rawDate ? \Illuminate\Support\Carbon::parse($rawDate)->format('d/m/Y h:i A') : 'Sin fecha';
            }
        );
    }

    protected function dueDateFormatted(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                // Read the plain text directly from the original column
                $rawDate = $attributes['due_date'] ?? null;

                // Format it exclusively for display as plain text
                return $rawDate ? \Illuminate\Support\Carbon::parse($rawDate)->format('d/m/Y h:i A') : 'Sin fecha';
            }
        );
    }

    protected function returnedAtFormatted(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                // Read the plain text directly from the original column
                $rawDate = $attributes['returned_at'] ?? null;

                // the book has not been returned, show 'No devuelto'
                return $rawDate ? \Illuminate\Support\Carbon::parse($rawDate)->format('d/m/Y h:i A') : 'No devuelto';
            }
        );
    }
}
