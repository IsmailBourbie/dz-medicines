<?php

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Medicine extends Model
{
    protected $guarded = [];

    // Accessor Methods

    // Relationships
    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function code(): BelongsTo
    {
        return $this->belongsTo(Code::class);
    }

    public function speciality(): HasOneThrough
    {
        return $this->hasOneThrough(Speciality::class, Code::class, 'id', 'id', 'code_id', 'speciality_id');
    }

    public function specialityRelatedMedicines()
    {
        return $this->speciality->medicines()
            ->where('medicines.id', '!=', $this->id)
            ->get();
    }

    // Utility Methods
    public function path(): string
    {
        return "/medicines/$this->slug";
    }
}
