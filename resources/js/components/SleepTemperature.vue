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
  <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div>
      <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-gray-400">Temperature</h2>

      <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
        <h3 class="mt-6 text-l font-semibold text-gray-900 dark:text-gray-400">Room</h3>
        <div v-for="metric in roomUpdated">
          <div>{{ metric.date }}</div>
          <div>{{ metric.temperature }}</div>
        </div>

        <h3 class="mt-6 text-l font-semibold text-gray-900 dark:text-gray-400">Bed</h3>
        <div v-for="metric in bedUpdated">
          <div>{{ metric.date }}</div>
          <div>{{ metric.temperature }}</div>
        </div>
      </p>
    </div>
  </div>
</template>

<style scoped>

</style>
