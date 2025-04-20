<?php

namespace Domains\Medicines\Casts;

use Domains\Medicines\ValueObjects\CodeValue as CodeValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class CodeValue implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes): CodeValueObject
    {
        return new CodeValueObject($value);
    }

    public function set(Model $model, string $key, $value, array $attributes): array
    {
        return [
            'value' => $value,
        ];
    }
}
