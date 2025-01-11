<?php
declare(strict_types=1);

namespace App\Medicines\ViewModels;

use Domains\Medicines\Models\Medicine;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class MedicineShowViewModel extends ViewModel
{
    public function __construct(public Medicine $medicine)
    {
    }

    public function labMedicines(): Collection
    {
        return Medicine::query()->labMedicines($this->medicine->laboratory)->filterOutmedicine($this->medicine->id)->get();
    }

    public function classMedicines(): Collection
    {
        return Medicine::query()->classMedicines($this->medicine->class)->filterOutmedicine($this->medicine->id)->get();
    }

    public function generics(): Collection
    {
        return Medicine::query()->codeMedicines($this->medicine->code)->filterOutmedicine($this->medicine->id)->get();
    }
}
