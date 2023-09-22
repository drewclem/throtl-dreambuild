<template>
  <div>
    <div class="grid grid-cols-10 text-sm opacity-50 px-6 mb-6">
      <p class="col-span-2">Name</p>
      <p class="col-span-3">Car</p>
      <p class="col-span-3">Email</p>
      <p class="col-span ml-auto">Status</p>
      <p class="ml-auto">Date</p>
    </div>

    <ul v-if="submissions.length" class="flex flex-col space-y-6">
      <li v-for="submission in submissions" :key="submission.id">
        <div class="grid grid-cols-10 bg-white shadow-md p-6">
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
      </li>
    </ul>

    <div v-else>
      <h3 class="font-semibold text-primary-500 text-xl">No submissions yet!</h3>
    </div>
  </div>
</template>

<script setup>
defineProps({
  submissions: {
    type: Array,
    default: () => []
  }
})
</script>
