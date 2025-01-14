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
          d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
          clip-rule="evenodd"/>
</svg>











