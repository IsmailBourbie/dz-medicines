<?php
declare(strict_types=1);

namespace Domains\Medicines\QueryBuilders;

use Domains\Medicines\Models\Code;
use Domains\Medicines\Models\Laboratory;
use Domains\Medicines\Models\Medicine;
use Domains\Medicines\Models\MedicineClass;
use Illuminate\Database\Eloquent\Builder;

final class MedicineQueryBuilder extends Builder
{
    public function filterOutMedicine(Medicine $medicine): self
    {
        return $this->whereNot('medicines.id', $medicine->id);
    }

    public function labMedicines(Laboratory $laboratory): self
    {
        return $this->where('laboratory_id', $laboratory->id);
    }

    public function codeMedicines(Code $code): self
    {
        return $this->where('code_id', $code->id);
    }

    public function classMedicines(MedicineClass $class): self
    {
        return $this->whereHas('code', function (Builder $query) use ($class) {
            return $query->where('class_id', $class->id);
        });
    }

    public function search(?string $q = null): self
    {
        if (empty($q)) {
            return $this;
        }
        
        $q = str_replace(' ', '%%', $q);

        return $this->whereLike('label', "%$q%");
    }
}
