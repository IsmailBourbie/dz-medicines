<?php

namespace Domains\Medicines\Services\Contracts;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\LazyCollection;

interface FileReaderInterface
{
    public function read(UploadedFile $file): LazyCollection;
}
