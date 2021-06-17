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

            <input class="article-search_input_round" type="text" id="search" v-model="articleInput"/>
            <button class="article-search_button_mint" id="submit" @click="onSubmit">Abschicken</button>

        </form>
        <h1 class="articles_header_mint">Artikelübersicht</h1>
        <table class="articles_table_outlines" id="tbodyContainer">
            <thead>
            <tr>
                <th class="articles_table-header_mint">Artikel</th>
                <th class="articles_table-header_mint">Preis</th>
                <th class="articles_table-header_mint">Beschreibung</th>
                <th class="articles_table-header_mint">Bild</th>
                <th class="articles_table-header_mint">Zum Warenkorb hinzufügen</th>
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
                <td>...</td>
            </tr>
            </tfoot>
        </table>
        <button @click="previousArticleSite">Previous</button>
        <button @click="nextArticleSite">Next</button>
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
            lowerBound: 0,
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
        nextArticleSite: function() {
            if(this.articles.length!==0)
            this.lowerBound+=5;
                this.getArticles();
            },
        previousArticleSite: function() {
            if(this.lowerBound>4) {
                this.lowerBound-=5;
                this.getArticles()
            }
        },
        getArticles: function () {
            console.log(this.articleInput)

            axios.get('/api/articles?search=' + this.articleInput+'&lowerBound='+this.lowerBound, {})
                .then((response) => {
                    console.log(response.data);
                    this.articles = response.data;
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
            if (this.articleInput.length > 2) {
             this.lowerBound=0;
                this.getArticles()
            }
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
