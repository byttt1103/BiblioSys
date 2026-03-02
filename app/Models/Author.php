<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    public function books(): BelongsToMany
    {
        //this is the many-to many relationship using the pivot table author_book
        return $this->belongsToMany(Book::class)->withTimestamps();
    }
    
}
