<?php

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Laboratory extends Model
{

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::upper($value)
        );
    }

    public function country(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::ucfirst($value)
        );
    }
}
