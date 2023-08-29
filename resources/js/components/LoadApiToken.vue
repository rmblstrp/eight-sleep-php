<script setup>
import SleepMetrics from "@/components/SleepMetrics.vue";
import axios from "axios";

const apiToken = (await axios.get('/api-token')).data.token;
</script>

<template>
  <SleepMetrics :api-token="apiToken" />
</template>

<style scoped>

</style>
