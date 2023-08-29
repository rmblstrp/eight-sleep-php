<script setup>
import axios from "axios";
import {getCurrentInstance, onErrorCaptured, ref} from "vue";
import SleepInterval from "@/components/SleepInterval.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";

console.log("<LoadUserData>");
onErrorCaptured(e => {
  console.log(e)
  return false
})

const {apiToken} = defineProps({
  apiToken: {
    type: String,
    required: true
  }
})

const httpConfig = {
  baseURL: "/api/v1",
  headers: {
    Authorization: "Bearer " + apiToken,
    "Content-Type": "application/json"
  }
}
console.log('LoadUserData::httpConfig', httpConfig);

const intervalIds = (await axios.get('/sleep/interval/list?from=2000-01-01T00:00:00Z&to=2032-01-01T00:00:00Z', httpConfig)).data.ids;
console.log('LoadUserData::intervalIds', intervalIds);
const linkedUsers = (await axios.get('/user/link/list', httpConfig)).data.users;
console.log('LoadUserData::linkedUsers', linkedUsers);

const componentKey = ref(0);
const forceRerender = () => {
  componentKey.value += 1;
};

let intervalIndex = 0;
const selectedIntervalId = ref(intervalIds[intervalIndex]);
console.log('LoadUserData::selectedIntervalId', selectedIntervalId);

function previousInterval() {
  intervalIndex = (intervalIds.length + (intervalIndex - 1)) % intervalIds.length;
  selectedIntervalId.value = intervalIds[intervalIndex];
  console.log('previousInterval', selectedIntervalId, intervalIndex);
  forceRerender();
}
function nextInterval() {
  intervalIndex = (intervalIndex + 1) % intervalIds.length;
  selectedIntervalId.value = intervalIds[intervalIndex];
  console.log('nextInterval', selectedIntervalId, intervalIndex);
  forceRerender();
}

</script>

<template>
  <div>
    <PrimaryButton @click="previousInterval" class="ml-4" >
      Previous
    </PrimaryButton>
    <PrimaryButton @click="nextInterval" class="ml-4" >
      Next
    </PrimaryButton>
  </div>
  <div>
    <SleepInterval v-bind:id="selectedIntervalId" :http-config="httpConfig" :key="componentKey"/>
  </div>
</template>

<style scoped>

</style>
