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
      <button class="relative rounded-full p-3 shadow-md group" type="button">
        <div class="absolute inset-0 bg-white p-3 group-hover:bg-primary-200 rounded-full"></div>
        <VIcon
          icon="mdi-thumb-down"
          color="primary"
          variant="tonal"
          class="text-gray-300 group-hover:text-primary-400 transform transition duration-150 ease-in-out"
          size="small"
        />
      </button>

      <button class="relative rounded-full p-3 shadow-md group" type="button">
        <div class="absolute inset-0 bg-white p-3 group-hover:bg-primary-200 rounded-full"></div>
        <VIcon
          icon="mdi-thumb-up"
          class="text-gray-300 group-hover:text-primary-400 transform transition duration-150 ease-in-out"
          size="small"
        />
      </button>
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
defineProps({
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
  }
})
</script>
