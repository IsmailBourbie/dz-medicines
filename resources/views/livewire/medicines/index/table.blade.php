<div class="relative  shadow-md sm:rounded-lg">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 rounded-lg overflow-hidden">
            <thead class="text-sm text-indigo-100 font-bold uppercase bg-indigo-500 font-quicksand">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Trade Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Dci
                </th>
                <th scope="col" class="px-6 py-3">
                    Dosage
                </th>
                <th scope="col" class="px-6 py-3">
                    Form
                </th>
                <th scope="col" class="px-6 py-3">
                    Packaging
                </th>
            </tr>
            </thead>
            <tbody x-data>
            @foreach($medicines as $medicine)
                <tr
                    class="bg-white border-b hover:cursor-pointer hover:bg-indigo-50 uppercase"
                    wire:key="{{$medicine->id}}"
                    x-on:click="location.href = '{{route('medicines.show', $medicine->slug)}}'">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ ($medicines->currentPage() - 1) * $medicines->perPage() + $loop->iteration }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{$medicine->name}}</td>
                    <td class="px-6 py-4">{{$medicine->dci}}</td>
                    <td class="px-6 py-4">{{$medicine->dosage}}</td>
                    <td class="px-6 py-4">{{$medicine->form}}</td>
                    <td class="px-6 py-4">{{$medicine->packaging}}</td>
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
