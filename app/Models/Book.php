<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // mutators: they convert any incoming data in something more standard,
    // like lower case for all the strings
    protected function title(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return strtolower($value);
            }
        );
    }

    protected function publisher(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return strtolower($value);
            }
        );
    }

    protected function isbn(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return strtoupper($value);
            }
        );
    }

    // casts: they transform data types
    protected function casts(): array
    {
        return [
            'stock' => 'integer',

        ];
    }
}
