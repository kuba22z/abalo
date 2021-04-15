<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Testdaten</title>
    <style> table {border:solid 1px black;}</style>
</head>
<body>
<table>
    @foreach ($testdaten as $testdate)
    <tr>
        <td>{{$testdate->id}}</td>
        <td>{{$testdate->ab_testname}}</td>
    </tr>
   @endforeach
</table>
</body>
