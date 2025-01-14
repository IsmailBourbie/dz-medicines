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
          d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
          clip-rule="evenodd"/>
</svg>










