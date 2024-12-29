<?php

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Speciality extends Model
{

    public function medicines(): HasManyThrough
    {
        return $this->hasManyThrough(
            Medicine::class,
            Code::class,
        );
    }
}
