<script setup>
import {Bar} from 'vue-chartjs'
import {Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

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

const chartData = {
  labels: [''],
  datasets: [{
    label: date.toDateString(),
    axis: 'y',
    data: [score],
    fill: false,
    backgroundColor: [
      'rgba(75, 192, 192, 0.2)'
    ],
    borderColor: [
      'rgb(75, 192, 192)'
    ],
    borderWidth: 1
  }]
};
const chartOptions = {
  legend: {
    display: false
  },
  responsive: true,
  indexAxis: 'y'
};
</script>

<template>
  <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div>
      <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-gray-400">Score</h2>
      <Bar
          :options="chartOptions"
          :data="chartData"
      />
    </div>
  </div>
</template>

<style scoped>

</style>
