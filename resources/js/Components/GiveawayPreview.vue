<template>
  <div class="bg-gray-100 w-full h-64 shadow-lg">
    <div class="grid grid-cols-2 h-full">
      <div class="relative overflow-hidden">
        <div class="relative z-10">
          <div class="flex">
            <div class="relative flex items-center justify-center w-12">
              <div
                class="absolute inset-0 z-10 -skew-x-6 -ml-3"
                :style="`background-color: ${color}`"
              />
              <ApplicationLogo class="block h-12 w-auto fill-current text-white z-20" />
            </div>
          </div>
          <div class="p-4 mt-2">
            <p class="text-xs text-white">{{ name }}</p>
            <h2 class="font-semibold text-white leading-snug">{{ cta }}</h2>
            <p class="text-xs text-white">{{ subtitle }}</p>
          </div>
        </div>
        <img :src="image" class="absolute inset-0 w-full h-full object-cover" />
        <div class="absolute inset-0 bg-black opacity-60"></div>

        <div
          class="bg-primary-500 absolute bottom-0 left-0 right-0 py-1 px-4 text-xs text-white"
          :style="`background-color: ${color}`"
        >
          <p>{{ lowerBanner }}</p>
        </div>
      </div>
      <div class="bg-white p-6">
        <p class="text-sm font-semibold mb-3">Entry Form</p>
        <ul>
          <li class="flex flex-col items-center space-y-4">
            <div class="bg-gray-100 h-4 w-full" />

            <div class="bg-gray-100 h-4 w-full" />

            <div class="bg-gray-100 h-4 w-full" />

            <div class="bg-gray-100 h-4 w-full" />
          </li>
        </ul>
        <div
          class="w-1/2 text-center uppercase p-1 mt-4 text-xs text-white"
          :style="`background-color: ${color}`"
        >
          submit
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'

defineProps({
  name: {
    type: String,
    default: 'Giveaway Preview'
  },
  cta: {
    type: String,
    default: 'Enter'
  },
  subtitle: {
    type: String,
    default: 'Enter to win'
  },
  lowerBanner: {
    type: String,
    default: 'Giveaway ends'
  },
  image: {
    type: String,
    default: 'https://i.pinimg.com/1200x/8e/47/aa/8e47aa3e621489a3f74a5edc34a1a7ab.jpg'
  },
  color: {
    type: String,
    required: true
  }
})
</script>
