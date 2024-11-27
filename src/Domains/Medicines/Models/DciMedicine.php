<?php

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Str;

class DciMedicine extends Pivot
{
    public function dosage(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::lower($value)
        );
    }
}
