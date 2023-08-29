<script setup>
import axios from "axios";
import SleepScore from "@/components/SleepScore.vue";
import SleepStages from "@/components/SleepStages.vue";
import SleepHeartRate from "@/components/SleepHeartRate.vue";
import SleepTemperature from "@/components/SleepTemperature.vue";
import SleepTossAndTurn from "@/components/SleepTossAndTurn.vue";

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
    <SleepHeartRate :respiratory-rate="interval.timeseries.respiratoryRate" :heart-rate="interval.timeseries.heartRate" />
    <SleepTemperature :bed="interval.timeseries.tempBedC" :room="interval.timeseries.tempBedC" />
    <SleepTossAndTurn :tnt="interval.timeseries.tnt" />
</template>

<style scoped>

</style>
