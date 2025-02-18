<?php

namespace Domains\Medicines\ValueObjects;

use Stringable;

final readonly class CodeValue implements Stringable
{
    public function __construct(protected string $value)
    {
    }

    public function classId(): int
    {
        preg_match('/^\d+/', $this->value, $matches);

        return (int) $matches[0];
    }


    public function __toString(): string
    {
        return $this->value;
    }
}
