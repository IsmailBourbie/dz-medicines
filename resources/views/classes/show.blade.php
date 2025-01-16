@component('layouts.base', ['title' => $class->name])
    <x-wrapper>
        <div class="py-20 space-y-8 w-10/12 mx-auto">
            <div>
                <h2 class="text-4xl text-indigo-500 font-quicksand font-bold tracking-wide capitalize mb-1">
                    {{$class->name}}
                </h2>
            </div>
            <livewire:medicines.index.table :source="$class"/>
        </div>
    </x-wrapper>
@endcomponent
