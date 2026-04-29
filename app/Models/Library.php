<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Library extends Model
{
    protected $table = 'library';

    protected $fillable = [
        'id',
        'name',
        'owner',
        'members',
        'address',
        'phone_number',
        'email',
        'description',
        'opening_hour_weekday',
        'closing_hour_weekday',
        'opening_hour_weekend',
        'closing_hour_weekend'
    ];

    public function founder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner');
    }

    protected function closingHourWeekday(): Attribute{
        return Attribute::make(
            get: function($value){
                return date('h:i a', strtotime($value));
            }
        );
    }

    protected function closingHourWeekend(): Attribute{
        return Attribute::make(
            get: function($value){
                return date('h:i a', strtotime($value));
            }
        );
    }

    protected function openingHourWeekday(): Attribute{
        return Attribute::make(
            get: function($value){
                return date('h:i a', strtotime($value));
            }
        );
    }

    protected function openingHourWeekend(): Attribute{
        return Attribute::make(
            get: function($value){
                return date('h:i a', strtotime($value));
            }
        );
    }
}
