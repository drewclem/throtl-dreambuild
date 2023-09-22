<template>
  <div>
    <div class="grid grid-cols-10 text-sm opacity-50 px-6 mb-6">
      <p class="col-span-2">Name</p>
      <p class="col-span-3">Car</p>
      <p class="col-span-3">Email</p>
      <p class="col-span ml-auto">Status</p>
      <p class="ml-auto">Date</p>
    </div>

    <ul v-if="submissions.length" class="flex flex-col space-y-4">
      <li class="text-sm" v-for="submission in submissions" :key="submission.id">
        <SubmissionCard :submission="submission" />
      </li>
    </ul>

    <div v-else>
      <h3 class="font-semibold text-primary-500 text-xl">No submissions yet!</h3>
    </div>
  </div>
</template>

<script setup>
import SubmissionCard from '@/Components/Submissions/SubmissionCard.vue'

defineProps({
  submissions: {
    type: Array,
    default: () => []
  }
})
</script>
