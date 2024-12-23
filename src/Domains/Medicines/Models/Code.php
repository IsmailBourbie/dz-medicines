<?php

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Code extends Model
{

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::ucfirst($value)
        );
    }
}
