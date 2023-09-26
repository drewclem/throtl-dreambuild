<template>
  <GuestLayout>
    <Head title="Log in" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <VCard>
      <template #text>
        <VContainer class="pa-6">
          <h1 class="text-2xl text-primary-500 font-semibold mb-6">Login</h1>
          <form @submit.prevent="submit">
            <div>
              <VTextField
                label="email"
                variant="underlined"
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                required
                autofocus
                autocomplete="username"
              />

              <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
              <VTextField
                label="password"
                id="password"
                variant="underlined"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password"
                required
                autocomplete="current-password"
              />

              <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
              <label class="flex items-center">
                <VCheckbox
                  label="Remember me"
                  name="remember"
                  :input-value="form.remember"
                  v-model="form.remember"
                />
              </label>
            </div>

            <div class="flex w-full items-center justify-between mt-4">
              <Link
                v-if="canResetPassword"
                :href="route('password.request')"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                Forgot your password?
              </Link>

              <VBtn
                v-bind="props"
                class="ml-4"
                color="primary"
                variant="flat"
                rounded="0"
                type="submit"
                :loading="form.processing"
              >
                Log In
              </VBtn>
            </div>
          </form>
        </VContainer>
      </template>
    </VCard>
  </GuestLayout>
</template>

<script setup>
import { ref } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import LoginApi from '@/services/LoginApi'

import Checkbox from '@/Components/Checkbox.vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

const props = defineProps({
  canResetPassword: {
    type: Boolean
  },
  status: {
    type: String
  },
  company: {
    type: Object,
    default: () => ({})
  }
})

const isLoading = ref(false)

const form = useForm({
  email: '',
  password: '',
  remember: false
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password')
  })
}

function handleCheckEmail() {
  isLoading.value = true
  LoginApi.checkEmail(form.email, props.company.slug)
    .then((res) => {
      console.log(res)
    })
    .finally(() => {
      isLoading.value = false
    })
}
</script>
