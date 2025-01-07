<?php

namespace Domains\Medicines\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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

    public function classMedicines(): HasManyThrough
    {
        return $this->hasManyThrough(
            Medicine::class,        // Final model we want to get
            Code::class,           // Intermediate model
            'class_id',           // Foreign key on intermediate table (codes)
            'code_id',           // Foreign key on final table (medicines)
            'code_id',          // Local key on current medicine
            'id'               // Local key on intermediate table
        )->whereNot('medicines.id', $this->id); // Exclude current medicine
    }

    public function generics(): HasMany
    {
        return $this->hasMany(self::class, 'code_id', 'code_id')->whereNot('id', $this->id);
    }

    public function labMedicines(): HasMany
    {
        return $this->hasMany(self::class, 'laboratory_id', 'laboratory_id')->whereNot('id', $this->id);
    }


    // Utility Methods
    public function path(): string
    {
        return "/medicines/$this->slug";
    }
}
