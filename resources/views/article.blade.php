<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artikelübersicht</title>
</head>
<style>
    .shoppingCart {
        position: relative;
        bottom: 40px;
        float: right;
    }
</style>

<body>
<div class="shoppingCart">
    <h1>Warenkorb 🛒</h1>
    <ul id="cart-ul">
    </ul>
</div>


<h1>Artikelübersicht</h1>
<table>
    <thead>
    <tr>
        <th>Artikel</th>
        <th>Preis</th>
        <th>Beschreibung</th>
        <th>Bild</th>
        <th>Zum Warenkorb hinzufügen</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($articles as $article)
        <tr>
            <td>{{$article->ab_name}}</td>
            <td>{{$article->ab_price}}</td>
            <td>{{$article->ab_description}}</td>
            <td>
                <object data="{{asset('storage/articelpictures/'.$article->id.'.jpg')}}" width="80px" height="80px">
                    <img width="80px" height="80px" src="{{asset('storage/articelpictures/00_image_missing.jpg')}}"
                         alt="Bild"></object>
            </td>
            <td>
                <button onclick="addToShoppingCart({{$article->id}},{{json_encode($article)}})">+</button>
            </td>
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
<script>
    "use strict";
    var shoppingCart = [];
    var ul = document.getElementById("cart-ul");

    function addToShoppingCart(articleID, article) {
        if (!articleExists(articleID)) {
            //psuh article to the array
            shoppingCart[articleID] = article;
            updateCart(article);
        }
    }

    function articleExists(articleID) {
        return shoppingCart[articleID] ? true : false;
    }

    function updateCart(article) {

        let liOuter = document.createElement("li");
        liOuter.setAttribute('class', 'cart-outer-li');
        ul.appendChild(liOuter)

        let cartArticle = document.createElement("div");
        cartArticle.setAttribute("class", "cartArticle")

        let cartName = document.createElement("div");
        cartName.setAttribute('class', 'cart-article-name')
        cartName.innerHTML = "Artikel: " + article.ab_name
        let cartPrice = document.createElement("div");
        cartPrice.setAttribute("class", "cart-article-price")
        cartPrice.innerHTML = "Preis :" + article.ab_price + "€"
        cartArticle.append(cartName)
        cartArticle.append(cartPrice)

        liOuter.append(cartArticle)

        let minusBtn = document.createElement("button");
        minusBtn.onclick = function () {
            delete shoppingCart[article.id]
            liOuter.remove()
        }

        cartArticle.append(minusBtn)
        minusBtn.innerText = "-"
    }


</script>
</body>
</html>


