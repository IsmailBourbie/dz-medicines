<?php

namespace Domains\Medicines\ValueObjects;

final readonly class CodeValue
{
    public function __construct(protected string $value)
    {
    }

    public function specialityId(): int
    {
        preg_match('/^\d+/', $this->value, $matches);

        return (int) $matches[0];
    }


}
