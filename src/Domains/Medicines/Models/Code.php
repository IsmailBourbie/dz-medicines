<?php

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Code extends Model
{

    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class);
    }

    public function medicines(): HasMany
    {
        return $this->hasMany(Medicine::class);
    }
}
