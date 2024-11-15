<div>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Trade Name</th>
            <th>Dci</th>
            <th>Dosage</th>
            <th>Form</th>
            <th>Packaging</th>
        </tr>
        </thead>
        <tbody>
        @foreach($medicines as $medicine)
            <tr>
                <td>{{$loop->index}}</td>
                <td>{{strtoupper($medicine->name)}}</td>
                <td>{{$medicine->dci->pluck('name')->map(function ($string) {return ucwords($string);})->implode('/')}}</td>
                <td>{{$medicine->dci->pluck('details.dosage')->implode('/')}}</td>
                <td>{{$medicine->dci->first()->details->form}}</td>
                <td>{{strtoupper($medicine->dci->first()->details->packaging)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $medicines->links() }}
</div>
