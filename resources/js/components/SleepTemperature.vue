<script setup>
console.log("<SleepTemperature>");
const {room, bed} = defineProps({
  room: {
    type: Array,
    required: true
  },
  bed: {
    type: Array,
    required: true
  }
});
console.log('SleepTemperature::room', room);
console.log('SleepTemperature::bed', bed);

const roomUpdated = [];
for (let item in room) {
  roomUpdated.push({
    date: new Date(item[0]),
    temperature: item[1]
  });
}
console.log('SleepTemperature::roomUpdated', roomUpdated);

const bedUpdated = [];
for (let item in bed) {
  bedUpdated.push({
    date: new Date(item[0]),
    temperature: item[1]
  });
}
console.log('SleepTemperature::bedUpdated', bedUpdated);
</script>

<template>
  <h1>Temperature</h1>
  <h1>Room</h1>
  <li v-for="metric in roomUpdated">
    <div>{{ metric.date }}</div>
    <div>{{ metric.temperature }}</div>
  </li>
  <h1>Bed</h1>
  <li v-for="metric in bedUpdated">
    <div>{{ metric.date }}</div>
    <div>{{ metric.temperature }}</div>
  </li>
</template>

<style scoped>

</style>
