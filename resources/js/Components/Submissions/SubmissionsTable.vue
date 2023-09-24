<template>
  <div>
    <div class="grid grid-cols-10 text-sm opacity-50 pl-8 pr-6 mb-6">
      <p class="col-span-2">Name</p>
      <p class="col-span-3">Car</p>
      <p class="col-span-3">Email</p>
      <p class="col-span ml-auto">Status</p>
      <p class="ml-auto">Date</p>
    </div>

    <ul v-if="submissions.length" class="flex flex-col space-y-4">
      <li class="text-sm" v-for="(submission, index) in submissions" :key="submission.id">
        <SubmissionCard
          :submission="submission"
          :isActive="activeSubmissionIndex === index ? true : false"
          @click="() => handleSetActiveSubmission(index)"
        />
      </li>
    </ul>

    <div v-else>
      <h3 class="font-semibold text-primary-500 text-xl">No submissions yet!</h3>
    </div>

    <Teleport to="body">
      <transition appear name="slideover">
        <div
          v-if="showSubmission"
          class="fixed h-screen bg-white z-20 w-full sm:w-5/6 lg:w-1/2 right-0 top-0 p-12 card-shadow overflow-y-scroll shadow-2xl"
        >
          <button
            class="absolute appearance-none text-primary-500 pt-1 p-3 top-0 left-0"
            @click="
              () => {
                showSubmission = false
                activeSubmissionIndex = null
              }
            "
          >
            <VIcon icon="mdi-close-circle-outline" size="small" />
          </button>
          <SubmissionActions
            :submission="submissions[activeSubmissionIndex]"
            :isStart="isStart"
            :isEnd="isEnd"
            :hasWinner="hasWinner"
            @prev="handlePrevClick"
            @next="handleNextClick"
            @selectWinner="handleSelectWinner"
          />

          <SubmissionContent :submission="submissions[activeSubmissionIndex]" />
        </div>
      </transition>
    </Teleport>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import SubmissionCard from '@/Components/Submissions/SubmissionCard.vue'
import SubmissionContent from '@/Components/Submissions/SubmissionContent.vue'
import SubmissionActions from '@/Components/Submissions/SubmissionActions.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  submissions: {
    type: Array,
    default: () => []
  },
  giveawayId: {
    type: Object,
    default: () => {}
  },
  winnerId: {
    type: Number,
    default: null
  },
  hasWinner: {
    type: Boolean,
    default: false
  }
})

// pluck the winner from the submissions and put it at the front of the array
if (props.winnerId) {
  const winner = props.submissions.find((submission) => submission.id === props.winnerId)
  props.submissions.splice(props.submissions.indexOf(winner), 1)
  props.submissions.unshift(winner)
}

const showSubmission = ref(false)
const activeSubmissionIndex = ref(null)

const form = useForm({
  winner_id: props.winnerId
})

const isStart = computed(() => {
  return activeSubmissionIndex.value === 0
})

const isEnd = computed(() => {
  return activeSubmissionIndex.value === props.submissions.length - 1
})

function handleNextClick() {
  if (activeSubmissionIndex.value < props.submissions.length - 1) {
    activeSubmissionIndex.value++
  }
}

function handlePrevClick() {
  if (activeSubmissionIndex.value > 0) {
    activeSubmissionIndex.value--
  }
}

function handleSetActiveSubmission(index) {
  activeSubmissionIndex.value = index
  showSubmission.value = true
}

function handleSelectWinner() {
  form
    .transform(() => {
      return {
        winner_id: props.submissions[activeSubmissionIndex.value].id
      }
    })
    .post(route('giveaways.select-winner', props.giveawayId), {
      onFinish: () => {
        form.reset()
      }
    })
}
</script>

<style scoped>
.slideover-enter-active,
.slideover-leave-active {
  transition: all 150ms ease;
}

.slideover-enter-from,
.slideover-leave-to {
  transform: translateX(100%);
}
</style>
