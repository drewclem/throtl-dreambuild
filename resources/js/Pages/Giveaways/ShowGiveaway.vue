<template>
  <Head :title="giveaway.name" />
  <div class="lg:h-screen grid lg:grid-cols-5">
    <section class="lg:col-span-2 relative">
      <header class="relative z-20 flex w-full justify-between items-center pr-4 lg:pr-12">
        <div class="relative flex items-center justify-center w-32">
          <div class="absolute inset-0 bg-primary-500 z-10 -skew-x-6 -ml-3" />
          <ApplicationLogo class="block h-32 w-auto fill-current text-white z-20" />
        </div>

        <div class="relative px-3 py-1">
          <a
            href="https://www.throtl.com"
            target="_blank"
            class="block text-white text-lg font-semibold italic uppercase tracking-wider"
            >Shop</a
          >
          <div class="absolute left-0 right-0 bottom-0 h-4 bg-primary-500 -z-10 -skew-x-6" />
        </div>
      </header>

      <div class="relative z-10 flex flex-col w-full py-24 p-4 lg:px-12">
        <p class="text-2xl text-white font-semibold">{{ giveaway.name }}</p>
        <h2 v-if="giveaway.cta" class="text-5xl font-semibold text-white leading-snug">
          {{ giveaway.cta }}
        </h2>
        <p v-if="giveaway.subtitle" class="text-white mt-4">{{ giveaway.subtitle }}</p>
      </div>

      <img :src="imgSrc" class="absolute inset-0 w-full h-full object-cover" />
      <div class="absolute inset-0 bg-black opacity-60"></div>

      <div class="bg-primary-500 absolute bottom-0 left-0 right-0 py-1 px-12 text-white">
        <p>{{ giveaway.lowerBanner }}</p>
      </div>
    </section>
    <section class="lg:col-span-3 p-4 lg:p-12 overflow-y-scroll">
      <div v-if="page.props.ziggy.query.status === 'success'">
        <div class="my-24 lg:mt-40">
          <div class="flex flex-col space-y-6">
            <h3 class="text-5xl font-semibold mb-4 text-primary-500">Application accepted!</h3>
            <p class="text-xl opacity-75 lg:w-3/4">
              We'll be reviewing all applications and selecting a winner soon!
            </p>

            <p>
              In the meantime, check out the
              <a class="font-semibold underline" href="https://www.throtl.com">throtl Shop!</a>
            </p>
          </div>
        </div>
      </div>
      <VForm v-else-if="giveaway.is_active" class="my-12" @submit.prevent="handleSubmit">
        <h3 class="text-2xl font-semibold mb-4">Basic Info</h3>

        <div class="flex flex-col space-y-6">
          <TextField label="Name" v-model="form.name" :error-messages="form.errors.name" />

          <TextField
            label="Email"
            v-model="form.email"
            :error-messages="form.errors.email"
            type="email"
          />

          <TextareaField
            label="Why should we pick you? (100 words or less)"
            :maxlength="100"
            v-model="form.why"
            :error-messages="form.errors.why"
          />

          <div class="flex w-full justify-between">
            <label class="text-gray-500 mt-3">Are you a current/active throtlVIP member?</label>
            <div>
              <VRadioGroup
                inline
                v-model="form.active_vip"
                :error-messages="form.errors.active_vip"
              >
                <VRadio label="Yes" :value="true" />
                <VRadio label="No" :value="false" />
              </VRadioGroup>
            </div>
          </div>

          <TextField
            label="Please specify your throtlVIP username OR the email used for throtlVIP"
            v-model="form.throtl_username"
            :error-messages="form.errors.throtl_username"
          />
        </div>

        <hr class="text-primary-500 my-12" />

        <h3 class="text-2xl font-semibold my-4">Car Info</h3>
        <div class="flex flex-col space-y-6">
          <TextField
            label="Vehicle Make"
            v-model="form.vehicle_make"
            :error-messages="form.errors.vehicle_make"
          />
          <TextField
            label="Vehicle Model"
            v-model="form.vehicle_model"
            :error-messages="form.errors.vehicle_model"
          />
          <TextField
            label="Vehicle Year"
            type="number"
            v-model.number="form.vehicle_year"
            :error-messages="form.errors.vehicle_year"
          />

          <TextareaField
            label="Describe your car / mod list / issues / etc"
            v-model="form.car_info"
            :error-messages="form.errors.car_info"
          />

          <TextareaField
            label="Describe your DREAM build & mod list! (In detail!)"
            v-model="form.dream_build"
            :error-messages="form.errors.dream_build"
          />
        </div>

        <hr class="text-primary-500 my-12" />

        <h3 class="text-2xl font-semibold my-4">Social Media</h3>
        <div class="flex flex-col space-y-6">
          <TextField
            label="Publish a NEW Instagram timeline video POST or REEL to showcase your car & explain WHY we should pick you! Get Creative! In your post, you MUST tag @throtl & use the hashtag #throtlVIP"
            v-model="form.ig_post"
            :error-messages="form.errors.ig_post"
          />

          <TextField
            label="What is your favorite throtl YouTube expisode?"
            v-model="form.fav_episode"
            :error-messages="form.errors.fav_episode"
          />

          <TextField
            label="Provide your social media usernames: Instagram/YouTube/Twitter/Facebook etc) ** NOTE your Instagram must be PUBLIC in order for us to view your post"
            v-model="form.social_media"
            :error-messages="form.errors.social_media"
          />
        </div>

        <hr class="text-primary-500 my-12" />

        <VCheckbox
          label="I Agree to the throtl Dream Build Rules"
          v-model="form.terms_of_service"
        />

        <VBtn
          color="primary"
          variant="flat"
          rounded="0"
          prepend-icon="mdi-send"
          :disabled="!form.terms_of_service"
          type="submit"
        >
          Submit
        </VBtn>
      </VForm>

      <div class="my-24 lg:mt-40" v-else>
        <div class="flex flex-col space-y-6">
          <p>
            This giveaway runs from <span class="font-semibold">{{ giveaway.open_date }}</span> to
            <span class="font-semibold">{{ giveaway.close_date }}</span>
          </p>
          <h3 class="text-5xl font-semibold mb-4 text-primary-500">Roads closed pizza boy!</h3>
          <p class="text-xl opacity-75 lg:w-3/4">
            You either dumped the clutch too early or you're granny-shifting, and not double
            clutching like you should!
          </p>

          <p>
            In the meantime, check out the
            <a class="font-semibold underline" href="https://www.throtl.com">throtl Shop!</a>
          </p>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { computed, watch } from 'vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'

import TextField from '@/Components/Form/TextField.vue'
import TextareaField from '@/Components/Form/TextareaField.vue'

const props = defineProps({
  giveaway: {
    type: Object,
    required: true
  }
})

const page = usePage()

if (page.props.ziggy.query?.status === 'success') {
  console.log('here')
}

const imgSrc = computed(() => {
  return props.giveaway.image
    ? props.giveaway.image
    : 'https://i.pinimg.com/1200x/8e/47/aa/8e47aa3e621489a3f74a5edc34a1a7ab.jpg'
})

const giveaway = computed(() => {
  return props.giveaway.data
})

const form = useForm({
  name: '',
  email: '',
  why: '',
  throtl_username: '',
  active_vip: false,
  vehicle_make: '',
  vehicle_model: '',
  vehicle_year: null,
  car_info: '',
  dream_build: '',
  ig_post: '',
  fav_episode: '',
  social_media: '',
  terms_of_service: false,
  collection_id: giveaway.value.id
})

watch(
  () => form.wasSuccessful,
  (value) => {
    if (value) {
      form.reset()
    }
  }
)

watch(
  () => giveaway.value,
  (value) => {
    form.collection_id = value.id
  }
)

function handleSubmit() {
  // console.log(giveaway.value)
  form.post(route('submissions.store', giveaway.value.slug), {
    preserveScroll: true
  })
}
</script>
