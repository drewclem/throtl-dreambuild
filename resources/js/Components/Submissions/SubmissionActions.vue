<template>
  <div class="flex w-full justify-between items-center py-4 mb-6">
    <div class="grid grid-cols-2 items-center gap-6">
      <button
        class="flex items-center transition transform duration-150 ease-in-out"
        :class="isStart ? 'pointer-events-none opacity-25' : ' opacity-60 hover:opacity-100 '"
        @click="$emit('prev')"
      >
        <VIcon icon="mdi-chevron-double-left" size="small" color="primary" />
        <span class="ml-2">Prev</span>
      </button>

      <button
        class="flex items-center transition transform duration-150 ease-in-out"
        :class="isEnd ? 'pointer-events-none opacity-25' : ' opacity-60 hover:opacity-100 '"
        @click="$emit('next')"
      >
        <span class="mr-2">Next</span>
        <VIcon icon="mdi-chevron-double-right" size="small" color="primary" />
      </button>
    </div>
    <div class="flex space-x-4 items-center">
      <div class="relative flex justify-center">
        <button
          class="rounded-full p-3 shadow-md group"
          type="button"
          @click="$emit('dislike', userLike)"
        >
          <div class="absolute inset-0 bg-white p-3 group-hover:bg-primary-200 rounded-full"></div>
          <VIcon
            icon="mdi-thumb-down"
            variant="tonal"
            :class="{
              'text-gray-300': !userLike || userLike.value === 'like',
              'text-primary-500': userLike && userLike.value === 'dislike'
            }"
            class="group-hover:text-primary-400 transform transition duration-150 ease-in-out"
            size="small"
          />
        </button>
        <span class="absolute text-center inset-0 mt-14 text-xs text-gray-300">
          {{ submission.dislikes_amount }}
        </span>
      </div>

      <div class="relative">
        <button
          class="rounded-full p-3 shadow-md group"
          type="button"
          @click="$emit('like', userLike)"
        >
          <div class="absolute inset-0 bg-white p-3 group-hover:bg-primary-200 rounded-full"></div>
          <VIcon
            icon="mdi-thumb-up"
            :class="{
              'text-gray-300': !userLike || userLike.value === 'dislike',
              'text-primary-500': userLike && userLike.value === 'like'
            }"
            class="group-hover:text-primary-400 transform transition duration-150 ease-in-out"
            size="small"
          />
        </button>
        <span class="absolute ml-auto text-center inset-0 mt-14 text-xs text-gray-300">
          {{ submission.likes_amount }}
        </span>
      </div>
      <div>
        <VBtn
          color="primary"
          rounded="0"
          variant="flat"
          @click="$emit('selectWinner')"
          :disabled="hasWinner"
        >
          Winner
        </VBtn>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  submission: {
    type: Object,
    required: true
  },
  isStart: {
    type: Boolean,
    default: false
  },
  isEnd: {
    type: Boolean,
    default: false
  },
  hasWinner: {
    type: Boolean,
    default: false
  },
  userId: {
    type: Number,
    default: null
  }
})

const hasLike = computed(() => {
  return props.submission.likes_amount > 0
})

const userLike = computed(() => {
  if (!hasLike) return null

  return props.submission.likes.find((like) => like.user_id === props.userId) ?? null
})
</script>
