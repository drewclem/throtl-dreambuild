<template>
  <button class="relative appearance-none w-full text-left">
    <div class="absolute left-0 top-0 ml-2 mt-2">
      <VIcon v-if="submission.is_winner" icon="mdi-star" size="small" color="primary" />
    </div>
    <div
      class="grid grid-cols-10 bg-white shadow-md pl-8 pr-6 py-3"
      :class="isActive ? ' ring-2 ring-primary-200' : ''"
    >
      <p class="col-span-2 font-semibold">{{ submission.name }}</p>
      <p class="col-span-3 opacity-75">{{ submission.car }}</p>
      <p class="col-span-3 opacity-75">{{ submission.email }}</p>
      <p class="col-span ml-auto">
        <span
          class="px-3 py-2 text-xs rounded-full"
          :class="{
            'bg-primary-200 text-primary-600': submission.active_vip,
            'bg-gray-200 text-gray-600': !submission.active_vip
          }"
          >{{ submission.active_vip ? 'VIP' : 'Buster' }}</span
        >
      </p>
      <p class="ml-auto">{{ submission.created_at }}</p>
    </div>
  </button>
</template>

<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'

defineProps({
  submission: {
    type: Object,
    required: true
  },
  isActive: {
    type: Boolean,
    default: false
  }
})
</script>
