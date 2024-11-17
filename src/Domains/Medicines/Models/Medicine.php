<?php

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Medicine extends Model
{

    protected $with = ['dci'];

    public function dci(): BelongsToMany
    {
        return $this->belongsToMany(Dci::class)
            ->withPivot('form', 'dosage', 'packaging')
            ->as('details')
            ->withTimestamps();
    }

    public function formatted_dci(): string
    {
        return $this->dci->pluck('name')->map(function ($string) {
            return ucwords($string);
        })->implode('/');
    }
}
