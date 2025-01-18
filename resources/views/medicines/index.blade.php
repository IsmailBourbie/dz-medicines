@component('layouts.base', ['title' => 'All Medicines'])
    <x-wrapper>
        <div class="flex justify-center items-center">
            <div class="w-11/12 md:w-full">
                <div class="my-12 space-y-16">
                    <h2 class="text-3xl font-bold text-indigo-500 font-quicksand">All Medicines</h2>
                    <x-search.index/>
                    <livewire:medicines.index.table/>
                </div>
            </div>
        </div>
    </x-wrapper>
@endcomponent
