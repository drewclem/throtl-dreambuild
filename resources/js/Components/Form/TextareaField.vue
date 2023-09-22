<template>
  <div class="grid md:grid-cols-2 gap-6">
    <label :for="id" class="opacity-60">{{ label }}</label>

    <div class="relative mb-3">
      <textarea
        v-bind="$attrs"
        :id="id"
        :name="id"
        :maxlength="maxlength"
        class="border-b border-gray-300 p-2 flex w-full"
        @input="$emit('update:modelValue', $event.target.value)"
        @focus="() => (errorMessages = null)"
      />
      <p v-if="maxlength" class="text-xs mt-1">
        <span :class="{ 'text-primary-500': showCharacterCount }">{{ modelValue.length }}</span>
        / {{ maxlength }}
      </p>

      <transition name="fade-slide">
        <p v-if="errorMessages" class="absolute text-red-500 text-sm">
          {{ errorMessages }}
        </p>
      </transition>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineOptions, watch, ref } from 'vue'

defineOptions({
  inheritAttrs: false
})

const props = defineProps({
  label: {
    type: String,
    required: true
  },
  modelValue: {
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
  },
  maxlength: {
    type: Number,
    required: false,
    default: null
  }
})

const id = `text-field-${Math.random().toString(36).substr(2, 9)}`

const showCharacterCount = ref(false)

watch(
  () => props.modelValue,
  (value) => {
    if (value.length > props.maxlength * 0.8) {
      showCharacterCount.value = true
    }
  }
)
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
