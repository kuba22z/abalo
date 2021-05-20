<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="csrf-token" content="{{ csrf_token() }}">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>

    <title>Artikelübersicht</title>
</head>
<style>
    #shoppingCart {
        position: relative;
        bottom: 40px;
        float: right;
    }
</style>

<body>
<div id="shoppingCart">
    <h1>Warenkorb 🛒</h1>

</div>
<form method="GET" action="api/articles">

    <input type="text" id="search" />
    <button  id="submit">Abschicken</button>

</form>
<h1>Artikelübersicht</h1>
<table id="tbodyContainer">
    <thead>
    <tr>
        <th>Artikel</th>
        <th>Preis</th>
        <th>Beschreibung</th>
        <th>Bild</th>
        <th>Zum Warenkorb hinzufügen</th>
    </tr>
    </thead>

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
    let shoppingCart = [];
    let ul;
    let cartContainer;
    let tBody ;
    let articles;
    getCart();
    getArticles()

    function sendToShoppingCart(articleID) {
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' :   document.getElementById("csrf-token").getAttribute('content')}
        });
        $.ajax({
            url: "/api/shoppingcart",
            type: 'POST',
            data: {
                articleID: articleID,
            },
            success: function(){
             console.log("Warenkorb erfolgreich gespeichert (wenn kein Duplikat)")
            },
            error: function(xhr){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Error - ' + errorMessage);
            }
        })
    }

    function getCart(){

        $.ajaxSetup({
            headers: { 'X-CSRF-Token' :   document.getElementById("csrf-token").getAttribute('content')}
        });

        $.ajax({
            url: '/api/shoppingcart',
            type: 'GET',
            success: function(returnedData){
                shoppingCart = returnedData;
                console.log(shoppingCart)
                rmCartAndCreateNew()
                fillCart()
            },
            error: function(xhr){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Error - ' + errorMessage);
            }
        })
    }

function getArticles(){
    let search=document.getElementById('search')
    console.log(search.value)
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' :   document.getElementById("csrf-token").getAttribute('content')}
    });

    $.ajax({
        url: '/api/articles?search='+search.value,
        type: 'GET',
        success: function(returnedData){
            articles = returnedData;
            console.log(articles)

            rmTableAndCreateNew();
            fillTable();
        },
        error: function(xhr){
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        }
    })
}

   let submit= document.getElementById('submit');
    submit.addEventListener('click', event => {
        event.preventDefault()
       getArticles();

    })

    function rmTableAndCreateNew(){
        if(tBody!==undefined)
        tBody.remove();

        tBody= document.createElement('tbody')
       let tBodyContainer= document.getElementById('tbodyContainer')
        tBodyContainer.append(tBody);
    }

    function fillTable(){
        {{--    @foreach ($articles as $article)
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
@endforeach--}}

            for (let article of articles) {
            let tr = document.createElement('tr')
            tBody.append(tr)

            let tdName = document.createElement('td')
            let tdPrice = document.createElement('td')
            let tdDescription = document.createElement('td')
            let tdImage = document.createElement('td')
            let tdBtn = document.createElement('td')
            tr.append(tdName,tdPrice,tdDescription,tdImage,tdBtn)
            tdName.innerText=article.ab_name
            tdPrice.innerText=article.ab_price
            tdDescription.innerText=article.ab_description
            let image= document.createElement('img')
            image.setAttribute('width','80px')
            image.setAttribute('height','80px')
            image.setAttribute('src','storage/articelpictures/'+article.id+'.jpg')
            image.setAttribute('alt',"Bild")
            tdImage.append(image)
            let btn = document.createElement('button')
            btn.onclick = () => {
                if(!shoppingCart.some(articleObject => articleObject.id===article.id)) {
                    sendToShoppingCart(article.id)
                    getCart();
                }
            }
            btn.innerText="+"
            tdBtn.append(btn)
        }
    }

    function rmCartAndCreateNew(){
        cartContainer =document.getElementById('shoppingCart')
        if(ul!==undefined)
        ul.remove()

        ul = document.createElement('ul')
        cartContainer.append(ul)
    }

    function removeFromshoppingCart(articleId){
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' :   document.getElementById("csrf-token").getAttribute('content')}
        });
        $.ajax({
            url: "/api/shoppingcart/"+2+"/articles/"+articleId,
            type: 'DELETE',
            success: function(ReturnedData){
                console.log("Warenkorb Artikel erfolgreich gelöscht")
                console.log(ReturnedData)
                shoppingCart.some(articleObject => {
                   if (articleObject.id===articleId)
                    shoppingCart.pop(articleObject);
                })
            },
            error: function(xhr){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Error - ' + errorMessage);
            }
        })
    }

    function fillCart() {
        for(let article of shoppingCart) {
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
                removeFromshoppingCart(article.id)
            }

            cartArticle.append(minusBtn)

            minusBtn.innerText = "-"
        }
    }

</script>
</body>
</html>


