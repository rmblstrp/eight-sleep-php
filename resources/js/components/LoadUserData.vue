<script setup>
import axios from "axios";
import {onErrorCaptured} from "vue";
import SleepInterval from "@/components/SleepInterval.vue";

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

// const intervals = [];
// let intervalCalls = [];
// intervalIds.forEach(id => {
//     let call = axios.get('/sleep/interval?id=' + id, httpConfig)
//             .then(response => {
//                 intervals.push(response.data);
//             });
//     intervalCalls.push(call);
// })
// await Promise.all(intervalCalls);
// console.log(intervals);

const selectedIntervalId = intervalIds[0];
console.log('LoadUserData::selectedIntervalId', selectedIntervalId);
</script>

<template>
    <div>
        <SleepInterval :id="selectedIntervalId" :http-config="httpConfig" />
    </div>
</template>

<style scoped>

</style>
