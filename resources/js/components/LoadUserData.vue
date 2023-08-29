<script setup>
import axios from "axios";
import {onErrorCaptured} from "vue";

onErrorCaptured(e => {
    console.log(e)
    return false
})

const { apiToken } = defineProps({
  apiToken: {
    type: String,
    required: true
  }
})

let httpConfig = {
  baseURL: "/api/v1",
  headers: {
    Authorization: "Bearer " + apiToken,
    "Content-Type": "application/json"
  }
}
console.log(httpConfig);

const intervalIds = (await axios.get('/sleep/interval/list?from=2000-01-01T00:00:00Z&to=2032-01-01T00:00:00Z', httpConfig)).data.ids;
console.log(intervalIds);
const linkedUsers = (await axios.get('/user/link/list', httpConfig)).data.users;
console.log(linkedUsers);
</script>

<template>
 {{ apiToken }}
</template>

<style scoped>

</style>
