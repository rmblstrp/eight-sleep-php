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
  <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div>
      <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-gray-400">Stages</h2>

      <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
        <div v-for="metric in stages">
          <div>{{ metric.stage }}</div>
          <div>{{ metric.time }}</div>
        </div>
      </p>
    </div>
  </div>
</template>

<style scoped>

</style>
