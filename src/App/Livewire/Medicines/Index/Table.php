<?php

namespace App\Livewire\Medicines\Index;

use Domains\Medicines\Models\Laboratory;
use Domains\Medicines\Models\Medicine;
use Domains\Medicines\Models\MedicineClass;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public Laboratory|MedicineClass|null $source = null;

    #[Url()]
    public ?string $query = null;

    public function render(): View
    {
        $query = $this->source?->medicines() ?? Medicine::query();

        $searchText = str_replace(' ', '%', $this->query);

        return view('livewire.medicines.index.table', [
            'medicines' => $query->whereLike('label', "%$searchText%")->paginate(),
        ]);
    }
}
