<script setup>
console.log("<SleepTossAndTurn>");
const {tnt} = defineProps({
  tnt: {
    type: Array,
    required: true
  }
});
console.log('SleepTossAndTurn::tnt', tnt);

const tntUpdated = [];
for (let item in tnt) {
  tntUpdated.push({
    date: new Date(item[0]),
    value: item[1]
  });
}
console.log('SleepTossAndTurn::tntUpdated', tntUpdated);

</script>

<template>
  <h1>Toss and Turn</h1>
  <li v-for="metric in tntUpdated">
    <div>{{ metric.date }}</div>
    <div>{{ metric.value }}</div>
  </li>
</template>

<style scoped>

</style>
