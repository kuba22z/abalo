
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="js/cookiecheck.js"></script>
    <meta charset="UTF-8">
    <title>Menu</title>
<style>
    .menu-outer-ul{
        list-style-type: none;
   /*
        optional
        border: 1px solid black;
        padding-bottom: 40px;
        padding-top: 60px;
        padding-left: 50px;
        padding-right: 50px;*/
        width: 600px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 0;
        font-size: 20px;
    }
    ul > li{
        float: left;
        padding-right: 15px;
        padding-left: 15px;
    }
    .menu-outer-li{
        margin-top: 7px;
   font-family: "Arial Black";

}
    .menu-inner-li {
        font-size: large;
        font-family: Apple;
        margin-top: 7px;
    }


</style>
</head>
<body>
<script>
    "use strict";
    var menu = {
        'Home': {},
        'Kategorien': {},
        'Verkaufen': {},

        'Unternehmen' : {
            "Philosophie" :{},
            "Karriere": {}
        }
    };


var div = document.createElement("div");
div.setAttribute('class','menuDiv');
document.body.appendChild(div)
var ul  =document.createElement("ul");
ul.setAttribute('class','menu-outer-ul');
div.appendChild(ul);
for (let key  in menu)
    {
        var liOuter = document.createElement("li");
        liOuter.setAttribute('class','menu-outer-li');
        ul.appendChild(liOuter)
        liOuter.innerText = key;
        for(let elements in menu[key]){
            var ulInner  =document.createElement("ul");
            liOuter.appendChild(ulInner)
            var liInner = document.createElement("li");
            liInner.setAttribute('class','menu-inner-li');
            ulInner.appendChild(liInner)
            liInner.innerText = elements;
        }

    }

</script>
</body>
</html>
