<div class="w-11/12 md:w-full">
    <div class="my-12 space-y-6">
        <h2 class="text-3xl font-bold font-quicksand">All Medicines</h2>
        <div class="relative  shadow-md sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-sm text-gray-700 font-bold uppercase bg-gray-100 font-quicksand">
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
                            class="bg-white border-b hover:cursor-pointer hover:bg-gray-50 uppercase"
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
                <div class="text-slate-600 text-sm">
                    Results: {{Number::format($medicines->total())}}
                </div>
                {{ $medicines->links('livewire.medicines.index.pagination') }}
            </div>
        </div>
    </div>
</div>
