<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <title>{{$title ?? 'Page' }}{{ app()->isProduction() ? '' : ' (local)' }}</title>
</head>
<body class="font-sans">

@php
    $user = auth()->user();
@endphp

<x-navbar :user="$user"/>

<div class="pt-20">
    {{$slot}}
</div>


<x-footer/>

@livewireScriptConfig
</body>
</html>
