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

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Trade Name</th>
        <th>Dci</th>
        <th>Dosage</th>
        <th>Form</th>
        <th>Packaging</th>
    </tr>
    </thead>
    <tbody>
    @foreach($medicines as $medicine)
        <tr>
            <td>{{$loop->index}}</td>
            <td>{{strtoupper($medicine->name)}}</td>
            <td>{{$medicine->dci->pluck('name')->map(function ($string) {return ucwords($string);})->implode('/')}}</td>
            <td>{{$medicine->dci->pluck('details.dosage')->implode('/')}}</td>
            <td>{{$medicine->dci->first()->details->form}}</td>
            <td>{{strtoupper($medicine->dci->first()->details->packaging)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $medicines->links() }}
</body>
</html>
