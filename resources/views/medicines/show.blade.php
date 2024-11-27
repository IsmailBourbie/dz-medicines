@component('layouts.base')
    <h2>
        {{$medicine->full_name}}
    </h2>
    <div>
        <h2>Trade Name:</h2>
        <p>{{$medicine->name}}</p>
    </div>
    <div>
        <h2>Denomination Commune Internationale (DCI):</h2>
        <p>{{$medicine->formatted_dci()}}</p>
    </div>
    <div>
        <h2>Dosage:</h2>
        <p>{{$medicine->formatted_dosage()}}</p>
    </div>
    <div>
        <h2>Form:</h2>
        <p>{{$medicine->form}}</p>
    </div>
    <div>
        <h2>Packaging:</h2>
        <p>{{$medicine->packaging}}</p>
    </div>

    <div>
        <div>
            <h2>Lab Name:</h2>
            <p>{{$medicine->laboratory->name}}</p>
        </div>
        <div>
            <h2>Lab Country:</h2>
            <p>{{$medicine->laboratory->country}}</p>
        </div>
    </div>
@endcomponent
