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
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
     stroke="currentColor" {{ $attributes->merge(['class' => $sizes[$size]]) }}>
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
</svg>








