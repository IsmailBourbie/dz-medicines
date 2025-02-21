<?php

namespace Domains\Medicines\Services;

use Domains\Medicines\Models\Laboratory;
use Illuminate\Support\Str;

readonly class LaboratoryImporter
{

    public function import(string $name, string $country): Laboratory
    {
        return Laboratory::firstOrCreate(['slug' => Str::slug($name.' '.$country)], [
            'name' => $name,
            'country' => $country,
        ]);
    }
}
