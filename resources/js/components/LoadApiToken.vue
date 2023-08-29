<script setup>
import axios from "axios";
import LoadUserData from "@/components/LoadUserData.vue";
import {onErrorCaptured} from "vue";

onErrorCaptured(e => {
    console.log(e)
    return false
})

const apiToken = (await axios.get('/api-token')).data.token;
</script>

<template>
  <LoadUserData :api-token="apiToken" />
</template>

<style scoped>

</style>
