<template>
  <Head title="Submissions" />
  <AuthenticatedLayout>
    <template #header>
      <div class="flex align-baseline">
        <Link href="/giveaways">
          <h2 class="font-semibold text-4xl text-gray-800 leading-tight">Giveaways</h2>
        </Link>

        <p class="text-xl ml-6">
          ... / <Link :href="route('giveaways.edit', submission.collection_id)">Submissions</Link> /
          <span class="text-primary-500">{{ submission.name }}</span>
        </p>
      </div>
    </template>

    <section></section>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'

defineProps({
  submission: {
    type: Object,
    required: true
  }
})
</script>
