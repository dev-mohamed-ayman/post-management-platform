<script setup>

import Header from "../components/layouts/Header.vue";
import {useAuthStore} from "../stores/auth.js";

const auth = useAuthStore()

</script>

<template>
    <Header v-if="auth.user"/>
    <RouterView/>
</template>

<style scoped>

</style>
