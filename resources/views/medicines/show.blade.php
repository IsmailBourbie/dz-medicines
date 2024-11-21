@component('layouts.base')
    <div>
        <h2>Trade Name:</h2>
        <p>{{strtoupper($medicine->name)}}</p>
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
        <p>{{strtoupper($medicine->packaging)}}</p>
    </div>
@endcomponent
