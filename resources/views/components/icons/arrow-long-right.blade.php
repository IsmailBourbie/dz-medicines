@props([
    'size' => 'base'
])

@php
    $sizes = [
        'sm' => 'size-4',
        'base' => 'size-6',
        'lg' => 'size-8',
        '2xl' => 'size-10',
        '3xl' => 'size-12',
        '4xl' => 'size-14',
        '5xl' => 'size-16',
        '6xl' => 'size-20',
    ]
@endphp
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
     fill="currentColor" {{ $attributes->merge(['class' => $sizes[$size]]) }}>
    <path fill-rule="evenodd"
          d="M16.72 7.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H3a.75.75 0 0 1 0-1.5h16.19l-2.47-2.47a.75.75 0 0 1 0-1.06Z"
          clip-rule="evenodd"/>
</svg>








