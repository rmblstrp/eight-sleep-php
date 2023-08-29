<script setup>
import axios from "axios";
import LoadUserData from "@/components/LoadUserData.vue";
import {onErrorCaptured} from "vue";

console.log("<LoadApiToken>");
onErrorCaptured(e => {
    console.log(e)
    return false
})

const data = (await axios.get('/api-token')).data;
console.log(data);
</script>

<template>
  <LoadUserData :api-token="data.token" :user-name="data.name" :user-id="data.id"  />
</template>

<style scoped>

</style>
