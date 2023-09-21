<template>
  <Head title="Giveaways" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex align-baseline">
        <Link href="/giveaways">
          <h2 class="font-semibold text-4xl text-gray-800 leading-tight">Giveaways</h2>
        </Link>

        <p class="text-xl ml-6">
          ... / Edit /
          <span class="text-primary-500">{{ giveaway.name }}</span>
        </p>
      </div>
    </template>

    <section class="flex space-x-12">
      <VTabs v-model="tab" direction="vertical">
        <VTab hide-slider value="submissions">
          <VIcon
            icon="mdi-inbox"
            :class="tab === 'submissions' ? 'text-primary-500' : 'text-gray-300'"
          />
          <span class="ml-3">Submissions</span>
        </VTab>
        <VTab hide-slider value="settings">
          <VIcon
            icon="mdi-cogs"
            :class="tab === 'settings' ? 'text-primary-500' : 'text-gray-300'"
          />
          <span class="ml-3">Settings</span>
        </VTab>
      </VTabs>
      <div class="w-full">
        <VWindow direction="vertical" v-model="tab">
          <VWindowItem value="submissions">
            <div class="flex flex-col">
              <h3 class="text-2xl mb-8">Submissions</h3>

              <div class="bg-white p-12 w-full">hello</div>
            </div>
          </VWindowItem>
          <VWindowItem value="settings">
            <div class="flex flex-col">
              <h3 class="text-2xl mb-8">Settings</h3>

              <VCard class="bg-white w-full">
                <VContainer class="pa-12">
                  <div class="grid lg:grid-cols-2 gap-6">
                    <VForm class="flex flex-col space-y-4">
                      <h4 class="font-semibold text-lg">Info</h4>

                      <div>
                        <VTextField
                          label="Name"
                          variant="underlined"
                          :error-messages="form.errors.name"
                          v-model="form.name"
                        />
                      </div>

                      <div>
                        <VTextField
                          label="CTA"
                          variant="underlined"
                          :error-messages="form.errors.cta"
                          v-model="form.cta"
                        />
                      </div>

                      <div>
                        <VTextField
                          label="Subtitle"
                          variant="underlined"
                          :error-messages="form.errors.subtitle"
                          v-model="form.subtitle"
                        />
                      </div>

                      <div>
                        <VTextField
                          label="Lower Banner"
                          variant="underlined"
                          :error-messages="form.errors.lowerBanner"
                          v-model="form.lowerBanner"
                        />
                      </div>

                      <div>
                        <h4 class="opacity-60 mb-4">Add an Image</h4>
                        <FileUploader @files-dropped="addFiles" #default="{ dropZoneActive }">
                          <label class="text-sm" for="file-input">
                            <span v-if="dropZoneActive">
                              <span> Drop Them Here </span>
                            </span>
                            <span v-else>
                              <span> Drag Your Files Here </span>
                              <span class="text-sm">
                                or
                                <strong class="text-red-500"><em> click here </em></strong>
                                to select files
                              </span>
                            </span>

                            <input
                              type="file"
                              id="file-input"
                              accept="image/*"
                              multiple
                              @change="onInputChange"
                            />
                          </label>
                        </FileUploader>
                      </div>

                      <div class="mt-6 flex">
                        <label class="mt-3">
                          <div>
                            <p class="font-semibold">Enrollment Dates</p>
                            <p v-if="form.errors.start" class="text-xs text-red-700 mt-2">
                              {{ form.errors.start }}
                            </p>

                            <p v-if="form.errors.end" class="text-xs text-red-700 mt-2">
                              {{ form.errors.end }}
                            </p>
                          </div>
                        </label>
                        <div class="ml-auto">
                          <DatePicker
                            :start="form.start"
                            :end="form.end"
                            @click="handleSelectDates"
                          />
                        </div>
                      </div>

                      <div>
                        <VBtn color="primary" variant="flat" rounded="0" @click="handleUpdate">
                          Update
                        </VBtn>
                      </div>
                    </VForm>
                    <div>
                      <h4 class="font-semibold text-lg">Preview</h4>
                    </div>
                  </div>
                </VContainer>
              </VCard>
            </div>
          </VWindowItem>
        </VWindow>
      </div>
    </section>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue'
import { Link, Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import FileUploader from '@/Components/FileUploader.vue'
import DatePicker from '@/Components/DatePicker.vue'
import useFileList from '@/utils/file-list'

const props = defineProps({
  giveaway: {
    type: Object,
    default: () => ({})
  }
})

const tab = ref('submissions')

const { files, addFiles, removeFile } = useFileList()

const form = useForm({
  name: props.giveaway.name,
  cta: props.giveaway.cta,
  subtitle: props.giveaway.subtitle,
  lowerBanner: props.giveaway.lowerBanner,
  start: new Date(props.giveaway.open_date),
  end: new Date(props.giveaway.close_date),
  files: files
})

function handleUpdate() {
  form.post(route('giveaways.update', props.giveaway.id), {
    onFinish: () => {
      form.reset()
    }
  })
}

function handleSelectDates(e) {
  Object.entries(e).forEach(([key, value]) => {
    form[key] = value
  })
}
</script>
