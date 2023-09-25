<template>
  <Head title="Team" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex flex-col lg:flex-row align-baseline">
        <Link :href="route('team.index')">
          <h2 class="font-semibold text-2xl lg:text-4xl text-gray-800 leading-tight">Team</h2>
        </Link>

        <p class="text-xl lg:ml-6">
          / Edit -
          <span class="text-primary-500">{{ user.name }}</span>
        </p>
      </div>
    </template>

    <section class="max-w-4xl mx-auto">cool</section>
  </AuthenticatedLayout>
</template>

<script setup>
import { defineProps, computed } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'

import CreateCompanyTeamMember from '@/Components/CreateCompanyTeamMember.vue'

const props = defineProps({
  member: {
    type: Object,
    required: true
  }
})

const member = computed(() => props.member.data)
const user = member.value.user

function handleDeleteTeamMember(id) {
  if (confirm('Are you sure you want to delete this team member?')) {
    Inertia.delete(route('team.destroy', { companyTeamMember: id }), {
      preserveScroll: true,
      onSuccess: () => {
        Inertia.reload({ preserveScroll: true })
      }
    })
  }
}
</script>
