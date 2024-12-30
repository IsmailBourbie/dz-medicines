@props([
    'medicines',
    'emptyStateDisplay' => 'No medicine found.'
])
<ul {{ $attributes->merge(['class' => "divide-y divide-slate-200 px-4 py-2"]) }}>
    @forelse($medicines as $medicine)
        <li class="text-sky-700/80 font-medium pt-2 pb-1">
            <a class="inline-flex items-center space-x-1 hover:text-sky-700 transition-colors"
               href="{{$medicine->path()}}">
                <span>{{$medicine->label}}</span>
                <x-icons.arrow-top-right-on-square size="sm"/>
            </a>
        </li>
    @empty
        <li class="text-sky-500 tracking-wide font-medium pt-2 pb-1">
            – {{$emptyStateDisplay}}
        </li>
    @endforelse
</ul>
