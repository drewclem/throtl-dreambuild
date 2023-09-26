<template>
  <Head title="Team" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-2xl lg:text-4xl text-gray-800 leading-tight">Team</h2>
        <div>
          <CreateCompanyTeamMember :companyId="$page.props.auth.user.company_member.company_id" />
        </div>
      </div>
    </template>

    <section>
      <div class="grid grid-cols-10 text-sm opacity-50 pl-8 pr-6 mb-6">
        <div />
        <p class="col-span-2">Name</p>
        <p class="col-span-3">Email</p>
        <p class="col-span-2">Role</p>
        <p class="ml-auto">Status</p>
        <p class="ml-auto">Actions</p>
      </div>

      <ul class="flex flex-col space-y-4">
        <li v-for="member in teamMembers.data" :key="member.id">
          <div class="grid grid-cols-10 bg-white shadow-md px-6 py-3 items-center">
            <div class="h-16 w-16 rounded-full overflow-hidden">
              <img
                v-if="member.user.avatar"
                :src="member.user.avatar"
                class="h-16 w-16 object-cover"
              />

              <div
                v-else
                class="h-16 w-16 flex items-center justify-center text-white text-2xl font-semibold bg-primary-200"
              >
                <VIcon icon="mdi-account" color="primary" />
              </div>
            </div>
            <p class="col-span-2 font-semibold">{{ member.user.name }}</p>
            <p class="col-span-3 opacity-75">{{ member.user.email }}</p>
            <p class="col-span-2 opacity-75">{{ member.role }}</p>
            <p class="ml-auto">
              <span
                class="px-3 py-2 text-xs rounded-full"
                :class="{
                  'bg-primary-200 text-primary-600': member.isActive,
                  'bg-gray-200 text-gray-600': !member.isActive
                }"
                >{{ member.user.activation_stage }}</span
              >
            </p>
            <div class="ml-auto flex gap-3">
              <Link
                class="opacity-75 hover:opacity-100 transition-opacity duration-150"
                :href="route('team.edit', member)"
              >
                <VIcon icon="mdi-pencil" size="small" color="primary" />
              </Link>
              <div
                :class="{
                  'opacity-50 pointer-events-none': member.role === 'owner'
                }"
              >
                <button
                  class="opacity-75 hover:opacity-100 transition-opacity duration-150"
                  type="button"
                  @click="handleDeleteTeamMember(member)"
                  :disabled="member.role === 'owner'"
                >
                  <VIcon icon="mdi-delete" size="small" color="primary" />
                </button>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </section>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'

import CreateCompanyTeamMember from '@/Components/CreateCompanyTeamMember.vue'

defineProps({
  teamMembers: {
    type: Array,
    required: true
  }
})

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
