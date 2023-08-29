<script setup>
console.log("<SleepHeartRate>");
const {heartRate, respiratoryRate} = defineProps({
  heartRate: {
    type: Array,
    required: true
  },
  respiratoryRate: {
    type: Array,
    required: true
  }
});
console.log('SleepHeartRate::heartRate', heartRate);
console.log('SleepHeartRate::respiratoryRate', respiratoryRate);

const heartRateUpdated = [];
for (let item in heartRateUpdated) {
  heartRateUpdated.push({
    date: new Date(item[0]),
    rate: item[1]
  });
}
console.log('SleepHeartRate::heartRateUpdated', heartRateUpdated);

const respiratoryRateUpdated = [];
for (let item in respiratoryRateUpdated) {
  respiratoryRateUpdated.push({
    date: new Date(item[0]),
    rate: item[1]
  });
}
console.log('SleepHeartRate::respiratoryRateUpdated', respiratoryRateUpdated);
</script>

<template>
  <h1>Heart and Respiratory</h1>
  <h1>Heart Rate</h1>
  <li v-for="metric in heartRateUpdated">
    <div>{{ metric.date }}</div>
    <div>{{ metric.rate }}</div>
  </li>
  <h1>Respiratory Rate</h1>
  <li v-for="metric in respiratoryRateUpdated">
    <div>{{ metric.date }}</div>
    <div>{{ metric.rate }}</div>
  </li>
</template>

<style scoped>

</style>
