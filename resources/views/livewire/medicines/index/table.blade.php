<div class="w-11/12 md:w-full">
    <div class="my-12 space-y-6">
        <h2 class="text-3xl font-medium font-montserrat">All Medicines</h2>
        <div class="relative  shadow-md sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 font-montserrat">
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
                    <tbody>
                    @foreach($medicines as $medicine)
                        <tr class="bg-white border-b" wire:key="{{$medicine->id}}">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ ($medicines->currentPage() - 1) * $medicines->perPage() + $loop->iteration }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{strtoupper($medicine->name)}}</td>
                            <td class="px-6 py-4">{{$medicine->formatted_dci()}}</td>
                            <td class="px-6 py-4">{{$medicine->formatted_dosage()}}</td>
                            <td class="px-6 py-4">{{$medicine->form}}</td>
                            <td class="px-6 py-4">{{strtoupper($medicine->packaging)}}</td>
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
