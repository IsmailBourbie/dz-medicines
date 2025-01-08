<?php
declare(strict_types=1);

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class MedicineClass extends Model
{
    public function medicines(): HasManyThrough
    {
        return $this->hasManyThrough(
            Medicine::class,
            Code::class,
            'class_id',
        );
    }
}
