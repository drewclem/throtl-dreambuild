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
          <span class="text-primary-500">{{ member.user.name }}</span>
        </p>
      </div>
    </template>

    <section class="max-w-4xl mx-auto">
      <div class="bg-white shadow-md p-6">
        <VForm>
          <h3 class="font-semibold text-lg lg:text-2xl leading-tight mb-6">Details</h3>

          <div class="flex flex-col space-y-6">
            <TextField
              label="Name"
              v-model="form.name"
              :error-messages="form.errors.name"
              type="text"
            />
            <TextField
              label="Email"
              v-model="form.email"
              :error-messages="form.errors.email"
              type="email"
            />

            <div class="mb-6">
              <div class="grid md:grid-cols-2 gap-6">
                <h4 class="opacity-60 mb-4">Profile Picture</h4>
                <div>
                  <label class="block w-24 h-24 cursor-pointer">
                    <div
                      class="flex justify-center items-center h-24 w-24 border-2 border-primary-500 border-dashed rounded-full overflow-hidden"
                    >
                      <img
                        class="h-24 w-24 object-cover"
                        v-if="member.user.avatar && form.avatar === null"
                        :src="member.user.avatar"
                        :alt="`${member.user.name}`"
                      />

                      <FilePreview v-else-if="files.length > 0" :file="files[0]" />

                      <VIcon
                        v-else
                        icon="mdi-account-circle"
                        color="primary"
                        variant="plain"
                        size="56"
                      />
                    </div>
                    <input class="sr-only" @input="onInputChange" type="file" accept="image/*" />
                  </label>
                </div>
              </div>
            </div>
          </div>
          <VCardActions>
            <VSpacer />
            <VBtn variant="tonal" rounded="0" @click="handleDeleteTeamMember(member.id)">
              Delete
            </VBtn>
            <VBtn
              color="primary"
              variant="flat"
              rounded="0"
              @click="handleUpdateTeamMember"
              :disabled="!form.isDirty"
            >
              Update Settings
            </VBtn>
          </VCardActions>
        </VForm>
      </div>
    </section>
  </AuthenticatedLayout>
</template>

<script setup>
import { defineProps, computed, ref } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'

import CreateCompanyTeamMember from '@/Components/CreateCompanyTeamMember.vue'
import TextField from '@/Components/Form/TextField.vue'
import FileUploader from '@/Components/FileUploader.vue'
import FilePreview from '@/Components/FilePreview.vue'
import useFileList from '@/utils/file-list'

const { files, addFiles, removeFile } = useFileList()

const props = defineProps({
  member: {
    type: Object,
    required: true
  },
  auth: {
    type: Object,
    required: true
  }
})

const member = computed(() => props.member.data)
const showDialog = ref(false)

const form = useForm({
  name: member.value.user.name,
  email: member.value.user.email,
  avatar: null
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

function handleUpdateTeamMember() {
  form.post(route('team.update', { companyTeamMember: member.value.id }), {
    preserveScroll: true,
    onSuccess: () => {
      Inertia.reload({ preserveScroll: true })
    }
  })
}

function onInputChange(e) {
  addFiles(e.target.files)
  form.avatar = e.target.files[0]
}
</script>
