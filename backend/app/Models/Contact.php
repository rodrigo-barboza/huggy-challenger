<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    protected $guarded = [];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value): string => Str::title($value),
        );
    }
}
