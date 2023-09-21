<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
      <slot />
    </div>

    <div>
      <Link href="/">
        <ApplicationLogo class="w-24 h-24 fill-current text-primary-500" />
      </Link>
    </div>
  </div>
</template>
