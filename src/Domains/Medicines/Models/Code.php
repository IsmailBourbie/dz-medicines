<?php
declare(strict_types=1);

namespace Domains\Medicines\Models;

use Domains\Medicines\Casts\CodeValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Code extends Model
{

    protected function casts(): array
    {
        return [
            'value' => CodeValue::class,
        ];
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(MedicineClass::class);
    }
}
