@component('layouts.base', ['title' => $laboratory->name])
    <h2>{{$laboratory->name}}</h2>
    <h5>{{$laboratory->country}}</h5>
@endcomponent
