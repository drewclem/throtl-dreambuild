<template>
  <Head title="Giveaways" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex flex-col lg:flex-row align-baseline">
        <Link :href="route('giveaways')">
          <h2 class="font-semibold text-4xl text-gray-800 leading-tight">Giveaways</h2>
        </Link>

        <p class="text-xl lg:ml-6">
          / Edit /
          <span class="text-primary-500">{{ giveaway.name }}</span>
        </p>
      </div>
    </template>

    <section class="flex flex-col lg:flex-row gap-6 lg:gap-12 w-full">
      <div class="flex flex-col items-start">
        <VBtn variant="plain" @click="updateActiveTab('submissions')">
          <VIcon
            icon="mdi-inbox"
            :class="tab === 'submissions' ? 'text-primary-500' : 'text-gray-300'"
          />
          <span class="ml-3">Submissions</span>
        </VBtn>

        <VBtn variant="plain" @click="updateActiveTab('settings')">
          <VIcon
            icon="mdi-cog"
            :class="tab === 'settings' ? 'text-primary-500' : 'text-gray-300'"
          />
          <span class="ml-3">Settings</span>
        </VBtn>

        <VBtn variant="plain" @click="handleDelete">
          <VIcon icon="mdi-delete" class="text-red-500" />
          <span class="ml-3 text-red-500">Delete</span>
        </VBtn>
      </div>
      <div class="w-full">
        <VWindow v-model="tab">
          <VWindowItem value="submissions">
            <div class="flex flex-col px-1 pb-4">
              <h3 class="text-2xl mb-9">Submissions</h3>

              <div>
                <SubmissionsTable
                  :submissions="submissions.data"
                  :giveawayId="giveaway.data.slug"
                  :winnerId="giveaway.data.winner_id"
                  :hasWinner="giveaway.data.has_winner"
                />
              </div>
            </div>
          </VWindowItem>
          <VWindowItem value="settings">
            <div class="flex flex-col px-1 pb-4">
              <h3 class="text-2xl mb-8">Settings</h3>

              <div class="bg-white w-full drop-shadow-lg">
                <VContainer class="pa-12">
                  <div class="grid xl:grid-cols-2 gap-6">
                    <form class="flex flex-col space-y-4" @submit.prevent="handleUpdate">
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
                        <VColorPicker v-model="form.color" rounded="0" />
                        <button type="button" @click="form.color = '#ff4310'">Reset</button>
                      </div>

                      <div>
                        <h4 class="opacity-60 mb-4">
                          {{ form.image_url ? 'Update image' : 'Add an Image' }}
                        </h4>
                        <FilePreview
                          v-if="
                            files.length === 0 &&
                            form.image_url &&
                            form.image_url !==
                              'https://i.pinimg.com/1200x/8e/47/aa/8e47aa3e621489a3f74a5edc34a1a7ab.jpg'
                          "
                          :file="{
                            url: form.image_url,
                            file: { name: form.image, alt: 'Giveaway Image' }
                          }"
                          showDelete
                          @remove="handleDeleteImage"
                        />

                        <FileUploader
                          v-else
                          @files-dropped="onInputChange"
                          #default="{ dropZoneActive }"
                        >
                          <label
                            class="text-sm"
                            :class="files.length > 0 ? 'absolute h-0 w-0 opacity-0' : ''"
                            for="file-input"
                          >
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
                              @change="onInputChange"
                            />
                          </label>

                          <FilePreview
                            v-if="files.length > 0"
                            :file="files[0]"
                            showDelete
                            @remove="removeFile"
                          />
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
                        <VBtn color="primary" variant="flat" rounded="0" type="submit">
                          Update
                        </VBtn>
                      </div>
                    </form>
                    <div>
                      <h4 class="font-semibold text-lg mb-6">Preview</h4>

                      <div>
                        <GiveawayPreview
                          :name="form.name"
                          :cta="form.cta"
                          :subtitle="form.subtitle"
                          :lowerBanner="form.lowerBanner"
                          :color="form.color"
                          :image="previewImage"
                        />
                      </div>

                      <a
                        class="block ml-auto pt-3 text-primary-500 underline"
                        :href="route('giveaways.show', props.giveaway.data.slug)"
                        target="_blank"
                      >
                        <p>View</p>
                      </a>
                    </div>
                  </div>
                </VContainer>
              </div>
            </div>
          </VWindowItem>
        </VWindow>
      </div>
    </section>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, watch, computed } from 'vue'
import { Link, Head, useForm } from '@inertiajs/vue3'
import useFileList from '@/utils/file-list'
import { Inertia } from '@inertiajs/inertia'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import FileUploader from '@/Components/FileUploader.vue'
import DatePicker from '@/Components/DatePicker.vue'
import GiveawayPreview from '@/Components/GiveawayPreview.vue'
import FilePreview from '@/Components/FilePreview.vue'
import SubmissionsTable from '@/Components/Submissions/SubmissionsTable.vue'

const props = defineProps({
  giveaway: {
    type: Object,
    default: () => ({})
  },
  submissions: {
    type: Array,
    default: () => []
  }
})

const tab = ref('submissions')

function updateActiveTab(value) {
  tab.value = value
}

const { files, addFiles, removeFile } = useFileList()

const form = useForm({
  name: props.giveaway.data.name,
  slug: props.giveaway.data.slug,
  cta: props.giveaway.data.cta,
  subtitle: props.giveaway.data.subtitle,
  lowerBanner: props.giveaway.data.lowerBanner,
  start: new Date(props.giveaway.data.open_date),
  end: new Date(props.giveaway.data.close_date),
  image_url: props.giveaway.data.image_url,
  file: null,
  color: props.giveaway.data.color ?? '#ff4310'
})

const previewImage = computed(() => {
  if (form.image_url !== null) return form.image_url

  if (form.image_url === null && files.length === 0)
    return 'https://i.pinimg.com/1200x/8e/47/aa/8e47aa3e621489a3f74a5edc34a1a7ab.jpg'

  return files.length > 0
    ? files[0].url
    : 'https://i.pinimg.com/1200x/8e/47/aa/8e47aa3e621489a3f74a5edc34a1a7ab.jpg'
})

function handleUpdate() {
  form.post(route('giveaways.update', props.giveaway.data.slug), {
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

function handleDelete() {
  if (confirm('Are you sure you want to delete this giveaway?')) {
    form.delete(route('giveaways.destroy', props.giveaway.data.slug))
  }
}

function handleDeleteImage() {
  console.log('delete')
  Inertia.post(route('giveaways.delete-image', props.giveaway.data.slug))
}

function onInputChange(e) {
  addFiles(e)
  form.file = e
  e = null
}
</script>
