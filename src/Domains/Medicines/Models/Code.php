<?php

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Code extends Model
{

    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class);
    }
}
