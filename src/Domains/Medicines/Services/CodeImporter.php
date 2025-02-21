<?php

namespace Domains\Medicines\Services;

use Domains\Medicines\Models\Code;
use Domains\Medicines\ValueObjects\CodeValue;

class CodeImporter
{

    public function import(CodeValue $value): Code
    {
        return Code::firstOrCreate(['value' => $value,], [
            'class_id' => $value->classId(),
        ]);
    }
}
