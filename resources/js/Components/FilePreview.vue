<script setup>
defineProps({
  file: { type: Object, required: true },
  tag: { type: String, default: 'li' }
})

defineEmits(['remove'])
</script>

<template>
  <div class="relative">
    <button
      @click="$emit('remove', file)"
      class="absolute bg-primary-500 text-white p-0.5 left-0"
      aria-label="Remove"
    >
      <VIcon icon="mdi-close" />
    </button>
    <img class="object-cover" :src="file.url" :alt="file.file.name" :title="file.file.name" />
  </div>
</template>
