<?php

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Str;

class Medicine extends Model
{
    protected $guarded = [];
    protected $perPage = 10;

    // Accessor Methods
    public function label(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::upper($value)
        );
    }

    // Relationships
    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function code(): BelongsTo
    {
        return $this->belongsTo(Code::class);
    }

    public function class(): HasOneThrough
    {
        return $this->hasOneThrough(MedicineClass::class, Code::class, 'id', 'id', 'code_id', 'class_id');
    }

    public function classRelatedMedicines()
    {
        return $this->class->medicines()
            ->where('medicines.id', '!=', $this->id)
            ->get();
    }

    public function generics()
    {
        return $this->code->medicines()
            ->where('medicines.id', '!=', $this->id)
            ->get();
    }

    // Utility Methods
    public function path(): string
    {
        return "/medicines/$this->slug";
    }
}
