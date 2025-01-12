<?php
declare(strict_types=1);

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laboratory extends Model
{
    public function medicines(): HasMany
    {
        return $this->hasMany(Medicine::class);
    }
}
