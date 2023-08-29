<script setup>
import axios from "axios";
import SleepScore from "@/components/SleepScore.vue";
import SleepStages from "@/components/SleepStages.vue";
import SleepHeartRate from "@/components/SleepHeartRate.vue";
import SleepTemperature from "@/components/SleepTemperature.vue";
import SleepTossAndTurn from "@/components/SleepTossAndTurn.vue";
import {watch} from "vue";

console.log("<SleepInterval>");
const {id, userId, useUserId, httpConfig} = defineProps({
  id: {
    type: Number,
    required: true
  },
  userId: {
    type: Number,
    required: true
  },
  useUserId: {
    type: Boolean,
    required: true
  },
  httpConfig: {
    required: true
  }
})

console.log('SleepInterval::userId', userId);
console.log('SleepInterval::useUserId', useUserId);

let uri = '/sleep/interval?id=' + id;
if (useUserId) {
  uri += '&linkedUserId=' + userId;
}
const interval = (await axios.get(uri, httpConfig)).data;
console.log('SleepInterval::interval', interval);
const intervalDate = new Date(interval.ts);
console.log('SleepInterval::intervalDate', intervalDate, typeof intervalDate);


</script>

<template>
  <SleepScore :date="intervalDate" :score="interval.score"/>
  <SleepStages :date="intervalDate" :stages="interval.stages"/>
  <SleepHeartRate :respiratory-rate="interval.timeseries.respiratoryRate" :heart-rate="interval.timeseries.heartRate"/>
  <SleepTemperature :bed="interval.timeseries.tempBedC" :room="interval.timeseries.tempBedC"/>
  <SleepTossAndTurn :tnt="interval.timeseries.tnt"/>
</template>

<style scoped>

</style>
