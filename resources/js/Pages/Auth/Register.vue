<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation')
  })
}
</script>

<template>
  <GuestLayout>
    <Head title="Register" />

    <VCard>
      <template #text>
        <VContainer class="pa-10">
          <form @submit.prevent="submit">
            <div>
              <VTextField
                id="name"
                label="Name"
                type="text"
                variant="underlined"
                class="mt-1 block w-full"
                v-model="form.name"
                required
                autofocus
                autocomplete="name"
              />

              <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
              <VTextField
                id="email"
                label="email"
                type="email"
                variant="underlined"
                class="mt-1 block w-full"
                v-model="form.email"
                required
                autocomplete="username"
              />

              <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
              <VTextField
                id="password"
                label="password"
                type="password"
                variant="underlined"
                class="mt-1 block w-full"
                v-model="form.password"
                required
                autocomplete="new-password"
              />

              <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
              <VTextField
                id="password_confirmation"
                label="confirm password"
                type="password"
                variant="underlined"
                class="mt-1 block w-full"
                v-model="form.password_confirmation"
                required
                autocomplete="new-password"
              />

              <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
              <Link
                :href="route('login')"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                Already registered?
              </Link>

              <PrimaryButton
                class="ml-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Register
              </PrimaryButton>
            </div>
          </form>
        </VContainer>
      </template>
    </VCard>
  </GuestLayout>
</template>
