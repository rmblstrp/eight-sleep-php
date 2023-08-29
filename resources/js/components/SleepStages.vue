<script setup>
import {Line} from 'vue-chartjs'
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
const stageDates = [];
const stageValues = [];
stages.forEach(item => {
  let date =  new Date(baseTimestamp);
  let hour = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
  let minute = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
  let dateString = hour + ':' + minute;
  baseTimestamp += item.duration * 1000;

  stageDates.push(dateString);
  switch (item.stage) {
    case 'out':
      stageValues.push(4);
      break;
    case 'awake':
      stageValues.push(3);
      break;
    case 'light':
      stageValues.push(2);
      break;
    case 'deep':
      stageValues.push(1);
      break;
  }
});
console.log('SleepStages::stageDates', stageDates);
console.log('SleepStages::stageValues', stageValues);

const stageData = {
  labels: stageDates,
  datasets: [{
    label: 'Sleep Stage',
    data: stageValues,
    fill: false,
    stepped: true,
    borderColor: 'rgba(0, 0, 0, 0.5)',
    tension: 0.1
  }]
};

const chartOptions = {
  legend: {
    display: false
  },
  responsive: true,
  interaction: {
    intersect: false,
    axis: 'x'
  },
  y: {
    min: 0,
    max: 4,
    ticks: {
      // forces step size to be 50 units
      stepSize: 1
    }
  }
};
</script>

<template>
  <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div>
      <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-gray-400">Stages</h2>

      <Line
          :options="chartOptions"
          :data="stageData"
      />
    </div>
  </div>
</template>

<style scoped>

</style>
