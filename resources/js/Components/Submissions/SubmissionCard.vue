<template>
  <div>
    <Link
      :href="
        route('submissions.show', {
          collection: submission.collection_id,
          submission: submission.id
        })
      "
    >
      <div class="grid grid-cols-10 bg-white shadow-md p-3">
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
    </Link>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'

defineProps({
  submission: {
    type: Object,
    required: true
  }
})

const showDialog = ref(false)

function handleShowDialog() {
  showDialog.value = true
}
</script>
