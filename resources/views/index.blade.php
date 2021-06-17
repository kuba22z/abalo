
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="js/cookiecheck.js"></script>
    <meta charset="UTF-8">
    <title>Menu</title>
<!--<style>
    .menu-outer-ul{
        list-style-type: none;
   /*
        optional
        border: 1px solid black;
        padding-bottom: 40px;
        padding-top: 60px;
        padding-left: 50px;
        padding-right: 50px;*/
        width: 800px;
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


</style>-->
</head>
<body>
<script>
    "use strict";

    class Menu {
        menu = {
            'Home': {},
            'Kategorien': {},
            'Verkaufen': {},

            'Unternehmen': {
                "Philosophie": {},
                "Karriere": {}
            }
        };
        ul;
        ulContainer

        constructor() {
            this.ulContainer = document.createElement("div");
            this.ulContainer.setAttribute('class','menuDiv');
            document.body.appendChild(this.ulContainer)
            this.fillWithTopics();
        }
        fillWithTopics(){
            this.ul  =document.createElement("ul");
            this.ul.setAttribute('class','menu-outer-ul');
            this.ulContainer.appendChild(this.ul);

            for (let key in this.menu)
            {
                var liOuter = document.createElement("li");
                liOuter.setAttribute('class','menu-outer-li');
                this.ul.appendChild(liOuter)
                liOuter.innerText = key;
                for(let elements in this.menu[key]){
                    var ulInner  =document.createElement("ul");
                    liOuter.appendChild(ulInner)
                    var liInner = document.createElement("li");
                    liInner.setAttribute('class','menu-inner-li');
                    ulInner.appendChild(liInner)
                    liInner.innerText = elements;
                }

            }

        }

        addTopic(newTopic,content){
            this.menu[newTopic]=content
        }

        addToTopic(topic,content){
            if(this.menu[topic]) {
                //push new subtopic(content) to topic
                this.menu[topic][content] ={}
            }
            else console.log("This topic doesnt exists")
        }

        removeTopic(topic){
            if(this.menu[topic]) {
                delete this.menu[topic];

            }
            else console.log("This topic doesnt exists")
        }
        removeSubTopic(topic,subtopic){
            if(this.menu[topic][subtopic])
                delete this.menu[topic][subtopic];
            else console.log("This topic doesnt exists")
        }

        updateMenu(){
        this.ul.remove()
        this.fillWithTopics();
        }


    }
    let m=new Menu();
    m.addTopic('About',{'Adresse':{}})
    m.removeTopic('Home')
    m.removeSubTopic("Unternehmen","Karriere")
    m.addToTopic("Unternehmen","Geschichte")
    m.updateMenu()

</script>
</body>
</html>
