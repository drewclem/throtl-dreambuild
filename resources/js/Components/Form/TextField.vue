<template>
  <div class="grid md:grid-cols-2 gap-6">
    <label :for="id" class="opacity-60">{{ label }}</label>

    <div class="relative mb-3">
      <input
        :id="id"
        :name="id"
        :value="modelValue"
        class="border-b border-gray-300 p-2 flex w-full"
        @input="$emit('update:modelValue', $event.target.value)"
        @focus="() => (errorMessages = null)"
      />

      <transition name="fade-slide">
        <p v-if="errorMessages" class="absolute text-red-500 text-sm mt-1">
          {{ errorMessages }}
        </p>
      </transition>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineOptions } from 'vue'

defineOptions({
  inheritAttrs: false
})

defineProps({
  modelValue: {
    type: String,
    required: true
  },
  label: {
    type: String,
    required: true
  },
  errorMessages: {
    type: String,
    required: false,
    default: null
  },
  type: {
    type: String,
    required: false,
    default: 'text'
  },
  hint: {
    type: String,
    required: false,
    default: ''
  }
})

const id = `text-field-${Math.random().toString(36).substr(2, 9)}`
</script>

<style scoped>
.fade-slide-enter-active,
.fade-slide-leave-active {
  transition: all 150ms ease;
}

.fade-slide-enter-from,
.fade-slide-leave-to {
  opacity: 0;
  transform: translateY(-5px);
}
</style>
