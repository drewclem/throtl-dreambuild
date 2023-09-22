<template>
  <div>
    <VSelect
      variant="underlined"
      :label="label"
      :hint="hint"
      :error-messages="errorMessages"
      :type="type"
      @update:modelValue="(e) => $emit('update:modelValue', e)"
    />
  </div>
</template>

<script setup>
defineProps({
  label: {
    type: String,
    required: true
  },
  value: {
    type: String,
    required: true
  },
  options: {
    type: Array,
    required: true
  },
  errorMessages: {
    type: Array,
    required: false,
    default: () => []
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
</script>
