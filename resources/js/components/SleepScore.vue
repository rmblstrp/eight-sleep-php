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
  <h1>Score</h1>
  <div>{{ date }}</div>
  <div>{{ score }}</div>
</template>

<style scoped>

</style>
