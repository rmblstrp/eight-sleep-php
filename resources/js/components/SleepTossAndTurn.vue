<script setup>
import {Line, Scatter} from 'vue-chartjs'
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement
} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, PointElement, LineElement)

console.log("<SleepTossAndTurn>");
const {tnt} = defineProps({
  tnt: {
    type: Array,
    required: true
  }
});
console.log('SleepTossAndTurn::tnt', tnt);

const tntDates = [];
const tntValues = [];
const tntScatter = [];
tnt.forEach(item => {
  let date = new Date(item[0]);
  let hour = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
  let minute = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
  let dateString = hour + ':' + minute;

  tntDates.push(dateString);
  tntValues.push(item[1]);
  tntScatter.push({
    x: dateString,
    y: item[1]
  });
});
console.log('SleepTossAndTurn::tntDates', tntDates);
console.log('SleepTossAndTurn::tntValues', tntValues);
console.log('SleepTossAndTurn::tntScatter', tntScatter);

const tntData = {
  labels: tntDates,
  datasets: [{
    label: 'Toss and Turn',
    data: tntValues,
    fill: false,
    borderColor: 'rgba(255, 99, 132, 0.5)',
    tension: 0.1
  }]
};
const chartOptions = {
  legend: {
    display: false
  },
  responsive: true,
  scales: {
    y: {
      min: 0,
      max: 2,
      ticks: {
        // forces step size to be 50 units
        stepSize: 1
      }
    }
  },
};
</script>

<template>
  <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div>
      <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-gray-400">Tosses and Turns</h2>
      <Line
          :options="chartOptions"
          :data="tntData"
      />
    </div>
  </div>
</template>

<style scoped>

</style>
