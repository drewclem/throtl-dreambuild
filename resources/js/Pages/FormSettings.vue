<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head title="Form Settings" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-4xl text-gray-800 leading-tight">Form Settings</h2>
    </template>

    <section>
      <VExpansionPanels>
        <VExpansionPanel color="primary" elevation="0" rounded="0">
          <VExpansionPanelTitle>
            <template #default>Accepted State</template>
          </VExpansionPanelTitle>
          <VExpansionPanelText> <p>hello</p> </VExpansionPanelText>
        </VExpansionPanel>
      </VExpansionPanels>
    </section>
  </AuthenticatedLayout>
</template>
