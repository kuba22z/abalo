<template>
    <div>
        <div id="shoppingCart">
            <h1>Warenkorb 🛒</h1>
            <ul>
                <li v-for="article in shoppingCart" class="cart-outer-li">
                    <div class="cartArticle">

                        <div class="cart-article-name">
                            {{ "Artikel: " + article.ab_name }}
                        </div>
                        <div class="cart-article-price">
                            {{ "Preis :" + article.ab_price + "€" }}
                        </div>
                        <button @click="removeFromCart(article.id)">-</button>
                    </div>
                </li>
            </ul>
        </div>

        <form method="GET" action="api/articles">

            <input type="text" id="search" v-model="articleInput"/>
            <button id="submit" @click="onSubmit">Abschicken</button>

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
            <tbody>
            <tr v-for="article in articles">
                <td>{{ article.ab_name }}</td>
                <td>{{ article.ab_price }}</td>
                <td>{{ article.ab_description }}</td>
                <td>
                    <object :data="'storage/articelpictures/' + article.id + '.jpg' " width="80px" height="80px">
                        <img width="80px" height="80px" :src="'storage/articelpictures/' + article.id + '.jpg'"
                             alt="Bild"/>
                    </object>
                </td>
                <td>
                    <button @click="addToShoppingCart(article)">+</button>
                </td>
            </tr>
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
    </div>
</template>

<script>
export default {
    name: "site-body",
    data() {
        return {
            articles: {},
            shoppingCart: [],
            articleInput: [],
        }
    }
    ,
    mounted() {
        this.getArticles();
        this.getCart()
    },
    methods: {
        onSubmit: function (e) {
            e.preventDefault()
            this.getArticles();
        },
        getArticles: function (limit = 30) {
            console.log(this.articleInput)

            axios.get('/api/articles?search=' + this.articleInput, {})
                .then((response) => {
                    console.log(response.data);
                    this.articles = response.data.slice(0, limit);
                }, (error) => {
                    console.log(error);
                });

        },

        addToShoppingCart: function (article) {
            if (!this.shoppingCart.some(articleObject => articleObject.id === article.id)) {
                this.sendToShoppingCart(article.id)
                this.shoppingCart.push(article)
            }
        },
        sendToShoppingCart: function (articleID) {
            $.ajax({
                url: "/api/shoppingcart",
                type: 'POST',
                data: {
                    articleID: articleID,
                },
                success: function () {
                    console.log("Warenkorb erfolgreich gespeichert (wenn kein Duplikat)")
                },
                error: function (xhr) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    alert('Error - ' + errorMessage);
                }
            })
        },


        getCart: function () {
            axios.get('/api/shoppingcart', {})
                .then((response) => {
                    this.shoppingCart = response.data;
                }, (error) => {
                    console.log(error);
                });
        },
        removeFromshoppingCart: function (articleId) {
            axios.delete('/api/shoppingcart/' + 2 + '/articles/' + articleId, {})
                .then((response) => {
                    console.log("answer after delete")
                    console.log(response.data);
                }, (error) => {
                    console.log(error);
                });


        },
        removeFromCart: function (articleID) {
            this.removeFromshoppingCart(articleID)

            console.log("after remove from shopping cart")
            console.log(this.shoppingCart)
            this.getCart();
        },

    },
    watch: {
        articleInput: function () {
            if (this.articleInput.length > 2)
                this.getArticles(5)
        }
        ,
    }
}
</script>

<style scoped>
#shoppingCart {
    position: relative;
    bottom: 40px;
    float: right;
}

</style>
