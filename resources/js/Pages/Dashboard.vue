<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DonutChart from "@/components/DonutChart.vue";
import LineChart from "@/components/LineChart.vue";


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

      <DonutChart>

      </DonutChart>

      <LineChart>

      </LineChart>

    </AuthenticatedLayout>
</template>
