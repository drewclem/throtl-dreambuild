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
              <h3 class="text-2xl mb-9">Submissions</h3>

              <div class="grid grid-cols-10 text-sm opacity-50 px-6 mb-6">
                <p class="col-span-2">Name</p>
                <p class="col-span-3">Car</p>
                <p class="col-span-3">Email</p>
                <p class="col-span ml-auto">Status</p>
                <p class="ml-auto">Date</p>
              </div>

              <ul class="flex flex-col space-y-6">
                <li v-for="submission in submissions.data" :key="submission.id">
                  <div class="grid grid-cols-10 bg-white shadow-md p-6">
                    <p class="col-span-2 font-semibold">{{ submission.name }}</p>
                    <p class="col-span-3 opacity-75">{{ submission.car }}</p>
                    <p class="col-span-3 opacity-75">{{ submission.email }}</p>
                    <p class="col-span ml-auto">
                      <span
                        class="bg-primary-200 px-3 py-2 rounded-full"
                        :class="{
                          'bg-primary-200 text-primary-600': submission.active_vip,
                          'bg-gray-200 text-gray-600': !submission.active_vip
                        }"
                        >{{ submission.active_vip ? 'VIP' : 'Buster' }}</span
                      >
                    </p>
                    <p class="ml-auto">{{ submission.created_at }}</p>
                  </div>
                </li>
              </ul>
            </div>
          </VWindowItem>
          <VWindowItem value="settings">
            <div class="flex flex-col">
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
                        <h4 class="opacity-60 mb-4">Add an Image</h4>
                        <FileUploader @files-dropped="addFiles" #default="{ dropZoneActive }">
                          <label
                            class="text-sm"
                            :class="files.length > 0 ? 'hidden' : ''"
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
                          :image="
                            files.length > 0
                              ? files[0].url
                              : 'https://i.pinimg.com/1200x/8e/47/aa/8e47aa3e621489a3f74a5edc34a1a7ab.jpg'
                          "
                        />
                      </div>

                      <a
                        class="block ml-auto pt-3 text-primary-500 underline"
                        :href="route('giveaways.show', props.giveaway.id)"
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
import { ref, watch } from 'vue'
import { Link, Head, useForm } from '@inertiajs/vue3'
import useFileList from '@/utils/file-list'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import FileUploader from '@/Components/FileUploader.vue'
import DatePicker from '@/Components/DatePicker.vue'
import GiveawayPreview from '@/Components/GiveawayPreview.vue'
import FilePreview from '@/Components/FilePreview.vue'

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

const { files, addFiles, removeFile } = useFileList()

console.log(files.value)

const form = useForm({
  name: props.giveaway.name,
  cta: props.giveaway.cta,
  subtitle: props.giveaway.subtitle,
  lowerBanner: props.giveaway.lowerBanner,
  start: new Date(props.giveaway.open_date),
  end: new Date(props.giveaway.close_date),
  image: files
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