<script setup>

import axios from "axios";
import {ref} from "vue";

const apiToken = (await axios.get('/api-token')).data;
</script>

<template>

</template>

<style scoped>

</style>
