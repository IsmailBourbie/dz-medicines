@component('layouts.base', ['title' => 'All Medicines'])
    <div class="flex justify-center items-center">
        <div class="w-11/12 md:w-full">
            <div class="my-12 space-y-16">
                <h2 class="text-3xl font-bold text-sky-600/80 font-quicksand">All Medicines</h2>
                <livewire:medicines.index.table/>
            </div>
        </div>

    </div>
@endcomponent
