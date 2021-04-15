<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artikelübersicht</title>
</head>
<body>
<h1>Artikelübersicht</h1>
<table>
    <thead>
    <tr>
        <th>Artikel</th>
        <th>Preis</th>
        <th>Beschreibung</th>
        <th>Bild</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($articles as $article)
        <tr>
            <td>{{$article->ab_name}}</td>
            <td>{{$article->ab_price}}</td>
            <td>{{$article->ab_description}}</td>
            <td><object data="{{asset('storage/articelpictures/'.$article->id.'.jpg')}}" width="80px" height="80px">
                    <img width="80px" height="80px" src="{{asset('storage/articelpictures/00_image_missing.jpg')}}" alt="Bild"></object></td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td>...</td>
        <td>...</td>
        <td>...</td>
        <td>...</td>
    </tr>
    </tfoot>
</table>


