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

        return $this->where(function (Builder $query) use ($q) {

            $q_includes_spaces = str_replace(' ', '%%', $q);

            $query->whereLike('label', "%$q_includes_spaces%")
                ->orWhereLike('dci', "%$q%");
        });
    }

    public function filters(?array $filters = null): self
    {
        $is_generic = $filters['is_generic'] ?? null;
        $is_local = $filters['is_local'] ?? null;

        $this->when(!is_null($is_generic), function (Builder $query) use ($is_generic) {
            $query->where('is_generic', $is_generic);

        });

        $this->when(!is_null($is_local), function (Builder $query) use ($is_local) {
            $query->where('is_local', $is_local);

        });

        return $this;
    }
}
