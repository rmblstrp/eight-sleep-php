<script setup>
const { apiToken } = defineProps({
  apiToken: {
    type: String,
    required: true
  }
})
</script>

<template>
 {{ apiToken }}
</template>

<style scoped>

</style>
