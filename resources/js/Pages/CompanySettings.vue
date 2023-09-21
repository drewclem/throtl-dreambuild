<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head title="Company Settings" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-4xl text-gray-800 leading-tight">Company Settings</h2>
    </template>

    <div class="py-12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">You're logged in!</div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
