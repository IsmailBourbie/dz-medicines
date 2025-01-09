<?php
declare(strict_types=1);

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Builder;
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
    protected function label(): Attribute
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
        return $this->hasOneThrough(
            MedicineClass::class,
            Code::class,
            'id',        // Foreign key on codes table
            'id',        // Foreign key on medicine_classes table
            'code_id',   // Local key on medicines table
            'class_id'   // Local key on codes table
        );
    }

    // Scopes
    protected function scopeFilterOutMedicine(Builder $query, int $related_medicine_id): Builder
    {
        return $query->whereNot('medicines.id', $related_medicine_id);
    }

    // Utility Methods
    public function path(): string
    {
        return "/medicines/$this->slug";
    }
}
