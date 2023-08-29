<script setup>
console.log("<SleepStages>");
const {stages, date} = defineProps({
  stages: {
    type: Array,
    required: true
  },
  date: {
    type: Date,
    required: true
  }
});
console.log('SleepStages::date', date);
console.log('SleepStages::stages', stages);
let baseTimestamp = date.getTime();
for (let index = 0; index < stages.length; index++) {
  stages[index].time = new Date(baseTimestamp);
  baseTimestamp += stages[index].duration * 1000;
}
console.log('SleepStages::stages updated', stages);
</script>

<template>
  <h1>Stages</h1>
  <li v-for="metric in stages">
    <div>{{ metric.stage }}</div>
    <div>{{ metric.time }}</div>
  </li>
</template>

<style scoped>

</style>
