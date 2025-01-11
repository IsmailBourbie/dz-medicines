<?php
declare(strict_types=1);

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Code extends Model
{
    public function class(): BelongsTo
    {
        return $this->belongsTo(MedicineClass::class);
    }
}
