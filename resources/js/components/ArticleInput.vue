<template>
<form id="newArticle" method="POST" action="/api/articles">
<label for="articleName">Artikelbezeichnung</label>
    <input type="text" id="articleName" v-model="articleName" /><br>
    <label for="articlePrice">Artikelpreis</label>
    <input type="text" id="articlePrice" v-model="articlePrice" /><br>
    <label for="articleDesc" >Artikelbeschreibung</label>
    <input type="text" id="articleDesc" v-model="articleDesc"/><br>
    <button @click.prevent="onSubmit">Speichern</button>
</form>
</template>

<script>
export default {
    name: "ArticleInput",
    data() {
        return {
            articlePrice: null,
            articleName: null,
            articleDesc: null

        }
    },
    methods: {
        sendData(){
            axios.post('/api/articles', {
                name: this.articleName,
                price: this.articlePrice,
                description : this.articleDesc,
            })
                .then((response) => {
                    if(response.data!=="Fehler - Artikel konnte nicht gespeichert werden")
                        //window.location.replace(returnedData);
                        console.log("Erfolgreich")
                    else
                        alert(response)
                }, (error) => {
                    console.log(error);
                });

        },
        onSubmit(){
            if (this.articleName !== "" && this.articlePrice > 0)
                this.sendData();
            else
                alert("Fehler - Artikel konnte nicht gespeichert werden");
        }

    }
}
</script>

<style scoped>

</style>
