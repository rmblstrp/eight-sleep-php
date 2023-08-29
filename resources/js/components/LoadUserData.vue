<script setup>
import axios from "axios";
import {getCurrentInstance, onErrorCaptured, ref} from "vue";
import SleepInterval from "@/components/SleepInterval.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";
import LoadApiToken from "@/components/LoadApiToken.vue";
import InputError from "@/components/InputError.vue";
import InputLabel from "@/components/InputLabel.vue";
import TextInput from "@/components/TextInput.vue";
import {Line} from "vue-chartjs";

const componentKey = ref(0);
const forceRerender = () => {
  console.log('LoadUserData::forceRerender');
  componentKey.value += 1;
};

console.log("<LoadUserData>");
onErrorCaptured(e => {
  console.log(e)
  return false
})

const {apiToken, userId, userName} = defineProps({
  apiToken: {
    type: String,
    required: true
  },
  userId: {
    type: Number,
    required: true
  },
  userName: {
    type: String,
    required: true
  }
});

const httpConfig = {
  baseURL: "/api/v1",
  headers: {
    Authorization: "Bearer " + apiToken,
    "Content-Type": "application/json"
  }
}
console.log('LoadUserData::httpConfig', httpConfig);

const selectedUserIndex = ref(0);
let userIndex = 0;
const userList = [
  {
    index: userIndex++,
    id: userId,
    name: userName + ' (Owner)',
    intervalIds: (await axios.get('/sleep/interval/list?from=2000-01-01T00:00:00Z&to=2032-01-01T00:00:00Z', httpConfig)).data.ids
  }
];

const linkedUsers = (await axios.get('/user/link/list', httpConfig)).data.users;
console.log('LoadUserData::linkedUsers', linkedUsers);

let intervalIndex = 0;
const selectedIntervalId = ref(userList[selectedUserIndex.value].intervalIds[intervalIndex]);
console.log('LoadUserData::selectedIntervalId', selectedIntervalId);

function previousInterval() {
  intervalIndex = (userList[selectedUserIndex.value].intervalIds.length + (intervalIndex - 1)) % userList[selectedUserIndex.value].intervalIds.length;
  selectedIntervalId.value = userList[selectedUserIndex.value].intervalIds[intervalIndex];
  console.log('previousInterval', selectedIntervalId, intervalIndex);
  forceRerender();
}

function nextInterval() {
  intervalIndex = (intervalIndex + 1) % userList[selectedUserIndex.value].intervalIds.length;
  selectedIntervalId.value = userList[selectedUserIndex.value].intervalIds[intervalIndex];
  console.log('nextInterval', selectedIntervalId, intervalIndex);
  forceRerender()
}

for (let index in linkedUsers) {
  console.log('LoadUserData - Adding User Intervals', linkedUsers[index]);
  userList.push({
    index: userIndex++,
    id: linkedUsers[index].id,
    name: linkedUsers[index].name,
    intervalIds: (await axios.get('/sleep/interval/list?from=2000-01-01T00:00:00Z&to=2032-01-01T00:00:00Z&linkedUserId=' + linkedUsers[index].id, httpConfig)).data.ids
  })
}
console.log('LoadUserData::userList', userList);

function selectedUserChanged() {
  console.log('LoadUserData::selectedUserChanged', selectedUserIndex.value);
  intervalIndex = 0;
  selectedIntervalId.value = userList[selectedUserIndex.value].intervalIds[intervalIndex];
  forceRerender()
}
</script>

<template>
  <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div>
      <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-400">Family Members</h2>
      <select v-model="selectedUserIndex" @change="selectedUserChanged">
        <option v-for="item in userList" :value="item.index">{{ item.name }}</option>
      </select>
    </div>
  </div>
  <div class="mt-4">
    <PrimaryButton @click="previousInterval" class="ml-4">
      Previous
    </PrimaryButton>
    <PrimaryButton @click="nextInterval" class="ml-4">
      Next
    </PrimaryButton>
  </div>
  <div>
    <Suspense :key="componentKey">
      <SleepInterval :id="selectedIntervalId" :http-config="httpConfig" :key="componentKey" />
      <template #fallback>
        <div class="sm:justify-center" style="margin-top: 50px">
          <SyncLoader></SyncLoader>
        </div>
      </template>
    </Suspense>
  </div>
</template>

<style scoped>

</style>
