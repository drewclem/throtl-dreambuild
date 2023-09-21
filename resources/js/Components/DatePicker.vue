<template>
  <DatePicker
    color="orange"
    title-position="left"
    is-expanded
    :min-date="new Date()"
    mode="range"
    v-model.range="range"
    @dayclick="handleClick"
  />
</template>

<script setup>
import { ref, watch, computed } from 'vue'
import { DatePicker } from 'v-calendar'
import 'v-calendar/dist/style.css'

const props = defineProps({
  start: {
    type: Date,
    default: null
  },
  end: {
    type: Date,
    default: null
  }
})

const emit = defineEmits(['click'])
const range = ref({
  start: props.start,
  end: props.end
})

function handleClick() {
  emit('click', range.value)
}
</script>

<style>
.vc-container {
  border: none;
}
div[class*='vc-header'] {
  padding-bottom: 1rem !important;
}
.vc-title {
  @apply text-black;
}

.vc-orange {
  --vc-accent-50: #fff3ed;
  --vc-accent-100: #ffe5d4;
  --vc-accent-200: #ffc6a8;
  --vc-accent-300: #ff9e70;
  --vc-accent-400: #ff6a37;
  --vc-accent-500: #ff4310;
  --vc-accent-600: #f02806;
  --vc-accent-700: #c71907;
  --vc-accent-800: #9e160e;
  --vc-accent-900: #7f160f;
}
</style>
