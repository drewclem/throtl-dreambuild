<template>
  <div class="overflow-x-hidden">
    <h3 v-if="submission.is_winner" class="text-xl font-semibold text-primary-500 mb-4">Winner!</h3>
    <div class="flex flex-col space-y-8">
      <SubmissionContentGrid>
        <template #left> Name </template>

        <template #right>
          {{ submission.name }}
        </template>
      </SubmissionContentGrid>

      <SubmissionContentGrid>
        <template #left> Email </template>

        <template #right>
          {{ submission.email }}
        </template>
      </SubmissionContentGrid>

      <SubmissionContentGrid>
        <template #left> Why should we pick you? </template>

        <template #right>
          {{ submission.why }}
        </template>
      </SubmissionContentGrid>
    </div>

    <hr class="my-12" />

    <div class="flex flex-col space-y-8">
      <SubmissionContentGrid>
        <template #left> Car </template>

        <template #right>
          {{ submission.car }}
        </template>
      </SubmissionContentGrid>

      <SubmissionContentGrid>
        <template #left> Describe your car / mod list/ issues / etc </template>

        <template #right>
          {{ submission.car_info }}
        </template>
      </SubmissionContentGrid>

      <SubmissionContentGrid>
        <template #left> Describe your DREAM Build & Mod List! (In Detail) </template>

        <template #right>
          {{ submission.dream_build }}
        </template>
      </SubmissionContentGrid>
    </div>

    <hr class="my-12" />

    <div class="flex flex-col space-y-8">
      <SubmissionContentGrid>
        <template #left> Car </template>

        <template #right>
          {{ submission.car }}
        </template>
      </SubmissionContentGrid>

      <SubmissionContentGrid>
        <template #left> Describe your car / mod list/ issues / etc </template>

        <template #right>
          {{ submission.car_info }}
        </template>
      </SubmissionContentGrid>

      <SubmissionContentGrid>
        <template #left> Describe your DREAM Build & Mod List! (In Detail) </template>

        <template #right>
          {{ submission.dream_build }}
        </template>
      </SubmissionContentGrid>
    </div>

    <hr class="my-12" />

    <div class="flex flex-col space-y-8">
      <SubmissionContentGrid>
        <template #left> IG Post/Reel </template>

        <template #right>
          {{ submission.ig_post }}
        </template>
      </SubmissionContentGrid>

      <SubmissionContentGrid>
        <template #left> What is your favorite throtl YouTube episode? </template>

        <template #right>
          {{ submission.fav_episode }}
        </template>
      </SubmissionContentGrid>

      <SubmissionContentGrid>
        <template #left> Social media usernames </template>

        <template #right>
          {{ submission.social_media }}
        </template>
      </SubmissionContentGrid>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'
import SubmissionContentGrid from '@/Components/Submissions/SubmissionContentGrid.vue'

defineProps({
  submission: {
    type: Object,
    required: true
  }
})
</script>
