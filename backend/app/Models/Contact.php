<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value): string => Str::title($value),
        );
    }

    public function state(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value): ?string => $value ? Str::lower($value) : null,
        );
    }

    public function scopeFilter(Builder $builder, ?string $search = null): void
    {
        $builder->when(
            $search,
            fn (Builder $query): Builder => $query->where('name', 'like', "%{$search}%"));
    }
}
