<?php
declare(strict_types=1);

namespace Domains\Medicines\ViewModels;

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
        return $this->medicine->laboratory->medicines()->filterOutMedicine($this->medicine->id)->get();
    }

    public function classMedicines(): Collection
    {
        return $this->medicine->class->medicines()->filterOutMedicine($this->medicine->id)->get();
    }

    public function generics(): Collection
    {
        return $this->medicine->code->medicines()->filterOutMedicine($this->medicine->id)->get();
    }
}
