<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="csrf-token" content="{{ csrf_token() }}">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>


    <title>Artikelübersicht</title>
</head>
<body>
<script>
    "use strict";
    var form = document.createElement("Form");
    form.setAttribute('id','newArticle');
    form.setAttribute('action','/api/articles');
    form.setAttribute('method','POST');
    document.body.appendChild(form);

    var dummy = document.createTextNode("Test");
    var input1 = document.createElement("input");
    var label1 = document.createElement("label");
    var input2 = document.createElement("input");
    var label2 = document.createElement("label");
    var input3 = document.createElement("input");
    var label3 = document.createElement("label");
    var input4 = document.createElement("button");


    input1.setAttribute('id','name');
    input1.setAttribute('name','name');
    input1.setAttribute('input','required');
    input1.setAttribute('type','text');
    label1.innerText = "Artikelbezeichnung: ";

    input2.setAttribute('id','price');
    input2.setAttribute('name','price');
    input2.setAttribute('type','number');
    label2.innerText = "Artikelpreis: ";

    input3.setAttribute('id','description');
    input3.setAttribute('name','description');
    input3.setAttribute('type','text');
    label3.innerText = "Artikelbeschreibung: ";

    input4.setAttribute('type','button');
/*    input4.setAttribute('onclick','erstellen()');*/
    input4.innerText = "Speichern";

    form.appendChild(label1);
    form.appendChild(input1);
    form.appendChild(document.createElement("br"));
    form.appendChild(document.createElement("br"));

    form.appendChild(label2);
    form.appendChild(input2);
    form.appendChild(document.createElement("br"));
    form.appendChild(document.createElement("br"));

    form.appendChild(label3);
    form.appendChild(input3);
    form.appendChild(document.createElement("br"));
    form.appendChild(document.createElement("br"));
    form.appendChild(input4);

    input4.addEventListener('click', event => {
           let price= document.getElementById("price").value
           let name= document.getElementById("name").value
            let description= document.getElementById("description").value
            event.preventDefault();
        if (name !== "" && price > 0)
            sendData(name,price,description);
            else
                alert("Fehler - Artikel konnte nicht gespeichert werden");
            return false;
        });
    function sendData(nameValue,priceValue,descriptionValue) {
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' :   document.getElementById("csrf-token").getAttribute('content')}
        });
         $.ajax({
            url: "/api/articles",
            type: 'POST',
            data: {
                name: nameValue,
                price: priceValue,
                description : descriptionValue,
            },
             success: function(returnedData){
                if(returnedData!=="Fehler - Artikel konnte nicht gespeichert werden")
            window.location.replace(returnedData);
                else
                alert(returnedData)
                 },
             error: function(xhr){
                 var errorMessage = xhr.status + ': ' + xhr.statusText
                 alert('Error - ' + errorMessage);
             }
        })
    }
</script>
</body>
</html>
