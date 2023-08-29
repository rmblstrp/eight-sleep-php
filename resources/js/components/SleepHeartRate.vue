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

const heartRateDates = [];
const heartRateValues = [];
heartRate.forEach(item => {
  let date = new Date(item[0]);
  let hour = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
  let minute = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
  let dateString = hour + ':' + minute;

  heartRateDates.push(dateString);
  heartRateValues.push(item[1]);
});
console.log('SleepHeartRate::heartRateDates', heartRateDates);
console.log('SleepHeartRate::heartRateValues', heartRateValues);

const respiratoryRateDates = [];
const respiratoryRateValues = [];
respiratoryRate.forEach(item => {
  let date = new Date(item[0]);
  let hour = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
  let minute = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
  let dateString = hour + ':' + minute;

  respiratoryRateDates.push(dateString);
  respiratoryRateValues.push(item[1]);
});
console.log('SleepHeartRate::respiratoryRateDates', respiratoryRateDates);
console.log('SleepHeartRate::respiratoryRateValues', respiratoryRateValues);

const heartRateData = {
  labels: heartRateDates,
  datasets: [{
    label: 'Heart Rate',
    data: heartRateValues,
    fill: false,
    borderColor: 'rgba(255, 99, 132, 0.5)',
    tension: 0.1
  }]
};
const respiratoryRateData = {
  labels: respiratoryRateDates,
  datasets: [{
    label: 'Respiratory Rate',
    data: respiratoryRateValues,
    fill: false,
    borderColor: 'rgba(54, 162, 235, 0.25',
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
      ticks: {
        // forces step size to be 50 units
        stepSize: 5
      }
    }
  },
};
const respiratoryOption = {
  legend: {
    display: false
  },
  responsive: true
};
</script>

<template>
  <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div>
      <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-gray-400">Heart and Respiratory Rates</h2>
      <Line
          :options="chartOptions"
          :data="heartRateData"
      />
      <Line
          :options="respiratoryOption"
          :data="respiratoryRateData"
      />
    </div>
  </div>
</template>

<style scoped>

</style>
