<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<ul>
    @foreach($medicines as $medicine)
        <li>
            {{$medicine->name}} |
            {{$medicine->dci->pluck('name')}} |
            {{$medicine->dci->first()->details->form}} |
            {{$medicine->dci->first()->details->dosage}} |
            {{$medicine->dci->first()->details->packaging}}
        </li>
    @endforeach
</ul>
</body>
</html>
