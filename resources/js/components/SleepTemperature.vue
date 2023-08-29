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

console.log("<SleepTemperature>");
const {room, bed} = defineProps({
  room: {
    type: Array,
    required: true
  },
  bed: {
    type: Array,
    required: true
  }
});
console.log('SleepTemperature::room', room);
console.log('SleepTemperature::bed', bed);

const roomTemperatureDates = [];
const roomTemperatureValues = [];
room.forEach(item => {
  let date = new Date(item[0]);
  let hour = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
  let minute = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
  let dateString = hour + ':' + minute;

  roomTemperatureDates.push(dateString);
  roomTemperatureValues.push(item[1]);
});
console.log('SleepTemperature::heartRateDates', roomTemperatureDates);
console.log('SleepTemperature::roomTemperatureValues', roomTemperatureValues);

const bedTemperatureDates = [];
const bedTemperatureValues = [];
room.forEach(item => {
  let date = new Date(item[0]);
  let hour = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
  let minute = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
  let dateString = hour + ':' + minute;

  bedTemperatureDates.push(dateString);
  bedTemperatureValues.push(item[1]);
});
console.log('SleepTemperature::bedTemperatureDates', bedTemperatureDates);
console.log('SleepTemperature::bedTemperatureValues', bedTemperatureValues);

const roomTemperatureData = {
  labels: roomTemperatureDates,
  datasets: [{
    label: 'Room',
    data: roomTemperatureValues,
    fill: false,
    borderColor: 'rgba(255, 99, 132, 0.5)',
    tension: 0.1
  }]
};
const bedTemperatureData = {
  labels: bedTemperatureDates,
  datasets: [{
    label: 'Bed',
    data: bedTemperatureValues,
    fill: false,
    borderColor: 'rgba(54, 162, 235, 0.25',
    tension: 0.1
  }]
};
const chartOptions = {
  legend: {
    display: false
  },
  responsive: true
};
</script>

<template>
  <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div>
      <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-gray-400">Temperatures</h2>

      <Line
          :options="chartOptions"
          :data="roomTemperatureData"
      />
      <Line
          :options="chartOptions"
          :data="bedTemperatureData"
      />
    </div>
  </div>
</template>

<style scoped>

</style>
