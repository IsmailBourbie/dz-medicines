<?php

namespace Domains\Medicines\Services\Contracts;

use Illuminate\Support\LazyCollection;

interface FileReaderInterface
{
    public function read(string $filepath): LazyCollection;
}
