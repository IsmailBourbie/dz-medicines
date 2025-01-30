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
<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
     viewBox="0 0 17 14" {{ $attributes->merge(['class' => $sizes[$size]]) }}>
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M1 1h15M1 7h15M1 13h15"/>
</svg>








