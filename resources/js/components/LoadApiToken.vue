<script setup>
import axios from "axios";
import LoadUserData from "@/components/LoadUserData.vue";
import {onErrorCaptured} from "vue";

console.log("<LoadApiToken>");
onErrorCaptured(e => {
    console.log(e)
    return false
})

const apiToken = (await axios.get('/api-token')).data.token;
console.log(apiToken);
</script>

<template>
  <LoadUserData :api-token="apiToken" />
</template>

<style scoped>

</style>
