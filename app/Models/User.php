<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // Define the relationship with the Role model
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function loans(){
        return $this->hasMany(Loan::class);
    }

    //the factory used to create dummy users for testing, it can be commented out if not needed
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'avatar_path',
        'document_number',
        'phone_number',
        'email',
        'address',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
