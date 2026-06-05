<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public function users(){
        return $this->belongsToMany(User::class);
    }


    protected $fillable = [
        'name',
        'description'
    ];

    protected function displayName(): Attribute
    {
    return Attribute::make(
        get: function () {
                return match ($this->name) {
                    'admin' => 'Administrador',
                    'librarian' => 'Librerero/a',
                    'reader' => 'Lector/a',
                    default => $this->name,
                };
            }
        );
    }

}
