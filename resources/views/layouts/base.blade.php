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

    @vite('resources/css/app.css')
    <title>{{$title ?? 'Page' }}{{ app()->isProduction() ? '' : ' (local)' }}</title>
</head>
<body class="font-sans">
<div class="min-h-screen">
    {{$slot}}
</div>
</body>
</html>
