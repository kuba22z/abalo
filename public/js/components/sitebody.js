Vue.component('site-body',{

    data: {
    },
    methods: {

    },
    template: `
        <div>
        <component v-bind:is="$root.getElement()"></component>

        Test for site-body
        </div>
        `
})
