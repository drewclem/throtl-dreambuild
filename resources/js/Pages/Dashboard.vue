<template>
  <Head title="Giveaways" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight">Giveaways</h2>
        <div>
          <CreateGiveawayModal />
        </div>
      </div>
    </template>

    <div>
      <div v-if="giveaways && giveaways.length > 0">
        <ul class="grid grid-cols-4 gap-6">
          <li v-for="giveaway in giveaways" :key="giveaway.id">
            <Link :href="route('giveaways.edit', giveaway.id)" class="block">
              <div>
                {{ giveaway.name }}
              </div>
            </Link>
          </li>
        </ul>
      </div>
      <div v-else>
        <div class="flex flex-col space-y-4">
          <h3 class="text-2xl font-semibold text-primary-500">No giveaways yet.</h3>
          <p class="opacity-75">Create your first giveaway by clicking the button below.</p>

          <div>
            <CreateGiveawayModal />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import CreateGiveawayModal from '@/Components/CreateGiveawayModal.vue'

defineProps({
  giveaways: {
    type: Array,
    defaul: () => []
  }
})
</script>
