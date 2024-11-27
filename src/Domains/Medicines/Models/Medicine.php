<?php

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Medicine extends Model
{
    protected $with = ['dci'];

    // Accessor Methods
    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::upper($value)
        );
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::upper($value)
        );
    }

    public function form(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::upper($value)
        );
    }

    public function packaging(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::upper($value)
        );
    }

    // Relationships
    public function dci(): BelongsToMany
    {
        return $this->belongsToMany(Dci::class)
            ->using(DciMedicine::class)
            ->withPivot('dosage')
            ->as('details')
            ->withTimestamps();
    }

    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class);
    }

    // Utility Methods
    public function path(): string
    {
        return route('medicines.show', $this->slug);
    }

    public function displayDci(): string
    {
        return $this->dci->pluck('name')->implode('/');
    }

    public function displayDosage(): string
    {
        return $this->dci->pluck('details.dosage')->implode('/');
    }
}
