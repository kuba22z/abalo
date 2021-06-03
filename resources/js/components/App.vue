<template>
    <div>
        <site-header></site-header>
        <site-body v-show="toggle"></site-body>

        <site-footer :toggleImpressum="toggleImpressum" :toggle="toggle"></site-footer>
    </div>
</template>

<script>
export default {
    name: "app",
    data() {
        return {
            toggle: true
        }
    },
    methods: {
        toggleImpressum: function () {
            this.toggle = !this.toggle;
        }

    }
}
</script>
