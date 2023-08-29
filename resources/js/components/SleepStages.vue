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
</script>

<template>

</template>

<style scoped>

</style>
