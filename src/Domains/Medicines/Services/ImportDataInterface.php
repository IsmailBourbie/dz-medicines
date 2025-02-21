<?php

namespace Domains\Medicines\Services;

use Illuminate\Support\LazyCollection;

interface ImportDataInterface
{
    public function importAllData(LazyCollection $data): void;
}
