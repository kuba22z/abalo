Vue.component('site-footer',{

    data: {
    },
    methods: {
        toggleImpressum: function (){

            if(this.$root.getElement() === "impressum")
                this.$root.setElement('');
            else
                this.$root.setElement('impressum');

        }
    },
    template: `
       <div>
       <a href="javascript:void(0);" v-on:click="toggleImpressum()"> Impressum</a>
       Test for site-footer
       </div>
        `
})

