<template>
    <div>
        <site-impressum v-show="!toggle"></site-impressum>

        <a href="" @click.prevent="toggleImpressum"> Impressum</a>
    </div>
</template>

<script>
export default {
    name: "site-footer",
    props: ['toggleImpressum', 'toggle'],

}
</script>

<style scoped>

</style>
