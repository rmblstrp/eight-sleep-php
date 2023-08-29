<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import LoadApiToken from "@/components/LoadApiToken.vue";
import {onErrorCaptured} from "vue";

onErrorCaptured(e => {
    console.log(e)
    return false
})
</script>

<template>
  <Head title="Dashboard"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <Suspense>
          <LoadApiToken/>
          <template #fallback>
            <div class="sm:justify-center">
              <SyncLoader></SyncLoader>
            </div>
          </template>
        </Suspense>
      </div>
    </div>

  </AuthenticatedLayout>
</template>
