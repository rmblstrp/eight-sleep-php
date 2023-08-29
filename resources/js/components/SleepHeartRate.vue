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
for (let item in heartRate) {
  heartRateUpdated.push({
    date: new Date(item[0]),
    rate: item[1]
  });
}
console.log('SleepHeartRate::heartRateUpdated', heartRateUpdated);

const respiratoryRateUpdated = [];
for (let item in respiratoryRate) {
  respiratoryRateUpdated.push({
    date: new Date(item[0]),
    rate: item[1]
  });
}
console.log('SleepHeartRate::respiratoryRateUpdated', respiratoryRateUpdated);
</script>

<template>
  <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div>
      <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-gray-400">Heart and Respiratory</h2>

      <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
        <h3 class="mt-6 text-l font-semibold text-gray-900 dark:text-gray-400">Heart Rate</h3>
        <div v-for="metric in heartRateUpdated">
          <div>{{ metric.date }}</div>
          <div>{{ metric.rate }}</div>
        </div>

        <h3 class="mt-6 text-l font-semibold text-gray-900 dark:text-gray-400">Respiratory Rate</h3>
        <div v-for="metric in respiratoryRateUpdated">
          <div>{{ metric.date }}</div>
          <div>{{ metric.rate }}</div>
        </div>
      </p>
    </div>
  </div>
</template>

<style scoped>

</style>
