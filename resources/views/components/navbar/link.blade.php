@props(['label', 'route'])

@php
    $active = request()->routeIs($route);
@endphp
<a href="{{route($route)}}"
   @class([
    "block py-2 px-3 md:p-0 rounded-sm text-lg",
    'bg-indigo-500 md:bg-transparent text-white md:text-indigo-500 font-bold' => $active,
    'bg-transparent text-slate-600' => ! $active,
    ])
   aria-current="page">
    {{$label}}
</a>

