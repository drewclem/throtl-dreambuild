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
        Create Giveaway
      </VBtn>
    </template>
    <template #default>
      <VCard>
        <VCardTitle>
          <h2 class="font-xl font-semibold text-primary-500">Create New Giveaway</h2></VCardTitle
        >
        <VCardText>
          <VForm>
            <VTextField
              variant="underlined"
              label="Name"
              v-model="form.name"
              :error-messages="form.errors.name"
            />
            <div class="mt-6 flex">
              <label class="mt-3">
                <div>
                  <p class="font-semibold">Enrollment Dates</p>
                  <p v-if="form.errors.start" class="text-xs text-red-700 mt-2">
                    {{ form.errors.start }}
                  </p>

                  <p v-if="form.errors.start" class="text-xs text-red-700 mt-2">
                    {{ form.errors.start }}
                  </p>
                </div>
              </label>
              <div class="ml-auto">
                <DatePicker @click="handleSelectDates" />
              </div>
            </div>
          </VForm>
        </VCardText>
        <VCardActions>
          <div class="flex w-full justify-between">
            <VBtn variant="tonal" rounded="0" @click="showDialog = false"> Close </VBtn>
            <VBtn color="primary" variant="flat" rounded="0" @click="handleCreateGiveaway">
              Create Giveaway
            </VBtn>
          </div>
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

function handleShowDialog() {
  showDialog.value = true
}

const form = useForm({
  name: '',
  start: null,
  end: null
})

function handleSelectDates(e) {
  Object.entries(e).forEach(([key, value]) => {
    form[key] = value
  })
}

function handleCreateGiveaway() {
  form.post(route('giveaways.store'), {
    onSuccess: () => {
      showDialog.value = false
      form.reset()
    }
  })
}
</script>
