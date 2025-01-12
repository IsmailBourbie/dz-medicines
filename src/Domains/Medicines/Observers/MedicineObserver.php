<?php

namespace Domains\Medicines\Observers;

use Domains\Medicines\Models\Medicine;

class MedicineObserver
{
    public function saving(Medicine $medicine): void
    {
        $medicine->label = $medicine->name.' '.$medicine->form.' '.$medicine->dosage.' '.$medicine->packaging;
        $medicine->slug = str()->slug($medicine->label);
    }
}
