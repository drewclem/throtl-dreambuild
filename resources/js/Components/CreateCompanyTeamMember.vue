<template>
  <VDialog class="max-w-lg" transition="dialog-top-transition" v-model="showDialog">
    <template #activator>
      <VBtn
        v-bind="props"
        color="primary"
        variant="flat"
        rounded="0"
        prepend-icon="mdi-plus"
        @click="handleShowDialog"
      >
        Add Team Member
      </VBtn>
    </template>
    <template #default>
      <VCard>
        <VCardTitle>
          <h2 class="font-xl font-semibold text-primary-500">Add New Team Member</h2></VCardTitle
        >
        <VCardText>
          <VForm>
            <VTextField
              variant="underlined"
              label="Name"
              v-model="form.name"
              :error-messages="form.errors.name"
            />

            <VTextField
              variant="underlined"
              label="Email"
              v-model="form.email"
              :error-messages="form.errors.email"
            />
          </VForm>
        </VCardText>
        <VCardActions>
          <VSpacer />
          <VBtn variant="text" rounded="0" @click="showDialog = false"> Close </VBtn>
          <VBtn color="primary" variant="flat" rounded="0" @click="handleCreateTeamMember">
            Add Team Member
          </VBtn>
        </VCardActions>
      </VCard>
    </template>
  </VDialog>
</template>

<script setup>
import { ref } from 'vue'
import DatePicker from '@/Components/DatePicker.vue'
import { useForm } from '@inertiajs/vue3'

const showDialog = ref(false)

const props = defineProps({
  companyId: {
    type: Number,
    required: true
  }
})

function handleShowDialog() {
  showDialog.value = true
}

const form = useForm({
  name: '',
  email: ''
})

function handleCreateTeamMember() {
  form.post(route('team.store', props.companyId), {
    onSuccess: () => {
      showDialog.value = false
      form.reset()
    }
  })
}
</script>
