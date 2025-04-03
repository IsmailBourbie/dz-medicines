<?php

namespace Domains\Medicines\Services\Contracts;

use Illuminate\Http\UploadedFile;

interface FileImporterInterface
{
    public function import(UploadedFile $file): void;
}
