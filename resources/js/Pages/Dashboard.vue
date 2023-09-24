<template>
  <Head title="Giveaways" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-2xl lg:text-4xl text-gray-800 leading-tight">Giveaways</h2>
        <div>
          <CreateGiveawayModal />
        </div>
      </div>
    </template>

    <div>
      <div v-if="giveaways && giveaways.data.length > 0">
        <ul class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-8">
          <li v-for="giveaway in giveaways.data" :key="giveaway.id">
            <Link :href="route('giveaways.edit', giveaway.slug)" class="block">
              <div class="relative drop-shadow-lg">
                <div class="relative h-40 overflow-hidden">
                  <div class="relative z-10 px-4 py-8 flex h-full items-end">
                    <h3 class="text-white font-semibold text-lg">{{ giveaway.name }}</h3>
                  </div>
                  <div
                    v-if="giveaway.is_active"
                    class="text-xs absolute top-0 bg-primary-200 border border-primary-700 text-primary-700 p-1 rounded-full z-20 ml-4 mt-4"
                  >
                    Active
                  </div>
                  <img
                    :src="giveaway.image_url"
                    class="absolute w-full h-48 object-cover inset-0"
                  />
                  <div class="absolute inset-0 bg-black opacity-60"></div>
                </div>
                <footer
                  class="relative bg-white p-4 flex justify-between items-center"
                  :class="{ 'pb-6': giveaway.has_winner }"
                >
                  <div>
                    <p class="text-xs opacity-50">Enrollment Period</p>
                    <p class="">{{ giveaway.open_date }} - {{ giveaway.close_date }}</p>
                  </div>

                  <div class="flex flex-col">
                    <p class="text-xs opacity-50">Total Submissions</p>
                    <p class="ml-auto text-primary-500 font-semibold">
                      {{ giveaway.total_submissions }}
                    </p>
                  </div>
                  <div
                    v-if="giveaway.has_winner"
                    class="absolute bottom-0 left-0 right-0 p-0.5 pl-4 bg-primary-200"
                  >
                    <p class="text-primary-700 text-xs">Winner Chosen!</p>
                  </div>
                </footer>
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
