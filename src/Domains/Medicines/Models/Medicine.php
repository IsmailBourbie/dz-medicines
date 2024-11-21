<?php

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Medicine extends Model
{

    protected $with = ['dci'];

    public function dci(): BelongsToMany
    {
        return $this->belongsToMany(Dci::class)
            ->withPivot('dosage')
            ->as('details')
            ->withTimestamps();
    }

    public function scopeWhereSlug(Builder $builder, string $slug): Builder
    {
        return $builder->where('slug', $slug);
    }

    public function path(): string
    {
        return route('medicines.show', $this->slug);
    }

    public function formatted_dci(): string
    {
        return $this->dci->pluck('name')->map(function ($string) {
            return ucwords($string);
        })->implode('/');
    }

    public function formatted_dosage(): string
    {
        return $this->dci->pluck('details.dosage')->implode('/');
    }
}
