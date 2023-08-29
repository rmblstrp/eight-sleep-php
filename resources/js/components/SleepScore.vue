<script setup>
console.log("<SleepScore>");
const {score, date} = defineProps({
  score: {
    type: Number,
    required: true
  },
  date: {
    type: Date,
    required: true
  }
})
console.log('SleepScore::date', date);
console.log('SleepScore::score', score);
</script>

<template>
  <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div>
      <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-gray-400">Score</h2>

      <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
        {{ score }}
      </p>
    </div>
  </div>
</template>

<style scoped>

</style>
