<script setup>
import axios from "axios";
import SleepScore from "@/components/SleepScore.vue";
import SleepStages from "@/components/SleepStages.vue";

console.log("<SleepInterval>");
const {id, httpConfig} = defineProps({
    id: {
        type: Number,
        required: true
    },
    httpConfig: {
        required: true
    }
})
console.log('SleepInterval::id', id);
const interval =  (await axios.get('/sleep/interval?id=' + id, httpConfig)).data;
console.log('SleepInterval::interval', interval);
const intervalDate = new Date(interval.ts);
console.log('SleepInterval::intervalDate', intervalDate, typeof intervalDate);
</script>

<template>
    <SleepScore :date="intervalDate" :score="interval.score" />
    <SleepStages :date="intervalDate" :stages="interval.stages" />
</template>

<style scoped>

</style>
