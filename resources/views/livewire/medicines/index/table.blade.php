<div>
    <div class="my-12 space-y-6">
        <h2 class="text-3xl font-medium">All Medicines</h2>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{$loop->index}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{strtoupper($medicine->name)}}</td>
                        <td class="px-6 py-4">{{$medicine->dci->pluck('name')->map(function ($string) {return ucwords($string);})->implode('/')}}</td>
                        <td class="px-6 py-4">{{$medicine->dci->pluck('details.dosage')->implode('/')}}</td>
                        <td class="px-6 py-4">{{$medicine->dci->first()->details->form}}</td>
                        <td class="px-6 py-4">{{strtoupper($medicine->dci->first()->details->packaging)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $medicines->links() }}
        </div>
    </div>
</div>
