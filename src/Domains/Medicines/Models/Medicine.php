<?php

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Medicine extends Model
{

    public function dci(): BelongsToMany
    {
        return $this->belongsToMany(Dci::class);
    }
}
