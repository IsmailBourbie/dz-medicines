<?php

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Medicine extends Model
{

    protected $with = ['dci'];

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => strtoupper($this->name.' '.$this->formatted_dosage().' '.$this->form.' '.$this->packaging)
        );
    }

    public function dci(): BelongsToMany
    {
        return $this->belongsToMany(Dci::class)
            ->withPivot('dosage')
            ->as('details')
            ->withTimestamps();
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
