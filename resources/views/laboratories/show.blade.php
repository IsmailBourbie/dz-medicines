@component('layouts.base', ['title' => $laboratory->name])
    <div class="py-20 space-y-8 w-10/12 mx-auto">
        <div>
            <h2 class="text-4xl text-sky-700 font-quicksand font-bold tracking-wide capitalize mb-1">
                {{$laboratory->name}}
            </h2>
            <span
                class="ps-1.5 text-xl text-sky-500 font-medium tracking-wider capitalize">{{$laboratory->country}}</span>
        </div>

        <livewire:medicines.index.table :source="$laboratory"/>
    </div>
@endcomponent
