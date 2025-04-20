<?php

namespace Domains\Medicines\ValueObjects;

use InvalidArgumentException;
use Stringable;

final readonly class CodeValue implements Stringable
{
    private string $value;

    public function __construct(string $value)
    {
        if (!$this->isValid($value)) {
            throw new InvalidArgumentException("The code '$value' is not in the correct format");
        }
        $this->value = $value;
    }

    public function classId(): int
    {
        preg_match('/\d+/', $this->value, $matches);

        return $matches[0];
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function isValid(string $value): bool
    {
        // Regex pattern to match the given format
        $pattern = '/^(0[1-9]|1[0-9]|2[0-9]|30) [A-Z] [0-9]{3}$/';

        return preg_match($pattern, $value) === 1;
    }
}
