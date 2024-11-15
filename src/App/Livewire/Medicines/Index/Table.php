<?php

namespace App\Livewire\Medicines\Index;

use Domains\Medicines\Models\Medicine;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public function render(): View
    {
        return view('livewire.medicines.index.table', [
            'medicines' => Medicine::query()->paginate(10),
        ]);
    }
}
