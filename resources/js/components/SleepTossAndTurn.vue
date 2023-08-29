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
  <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div>
      <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-gray-400">Toss and Turn</h2>

      <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
        <div v-for="metric in tntUpdated">
          <div>{{ metric.date }}</div>
          <div>{{ metric.value }}</div>
        </div>
      </p>
    </div>
  </div>
</template>

<style scoped>

</style>
