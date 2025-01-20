<div class="relative sm:rounded-lg">
    <x-search.index class="flex items-end justify-between mb-8 mx-4" wire:submit.prevent>
        <x-search.input class="w-5/12 flex-shrink"/>
        <div>
            <x-search.filters/>
        </div>
    </x-search.index>
    <div class="relative overflow-x-auto">
        <div class="absolute w-full h-full inset-0 bg-slate-100 opacity-50 flex items-center justify-center"
             wire:loading.flex>
            <x-icons.loading size="2xl" wire:loading.class="animate-spin"/>
        </div>
        <table
            class="w-full border-separate border-spacing-y-1.5 text-sm text-left rtl:text-right">
            <tbody x-data>
            @foreach($medicines as $medicine)
                <tr
                    class="bg-teal-100/70 uppercase text-teal-900 hover:cursor-pointer hover:bg-teal-100"
                    wire:key="{{$medicine->id}}"
                    x-on:click="location.href = '{{route('medicines.show', $medicine->slug)}}'">
                    <td class="rounded-s-lg px-6 py-6 font-medium text-teal-950 whitespace-nowrap">{{ ($medicines->currentPage() - 1) * $medicines->perPage() + $loop->iteration }}</td>
                    <td class="px-6 py-6 font-medium text-teal-950 whitespace-nowrap">{{$medicine->name}}</td>
                    <td class="px-6 py-6">{{$medicine->dci}}</td>
                    <td class="px-6 py-6">{{$medicine->dosage}}</td>
                    <td class="px-6 py-6">{{$medicine->form}}</td>
                    <td class="px-6 py-6 rounded-e-lg">{{$medicine->packaging}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="py-3 px-6 flex items-center justify-between">
        <div class="font-bold text-sky-800 text-sm">
            Results: {{Number::format($medicines->total())}}
        </div>
        {{ $medicines->links('livewire.medicines.index.pagination') }}
    </div>
</div>
