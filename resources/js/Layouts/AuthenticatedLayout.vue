<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import NavLink from '@/Components/NavLink.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/vue3'

const showingNavigationDropdown = ref(false)

const body = document.getElementsByTagName('body')

onMounted(() => {
  body[0].classList.add('overflow-y-hidden')
})

onUnmounted(() => {
  body[0].classList.remove('overflow-y-hidden')
})
</script>

<template>
  <div class="relative">
    <div class="hidden lg:fixed inset-y-0 z-50 lg:flex w-[224px] flex-col">
      <div class="flex grow flex-col">
        <div class="flex">
          <div class="flex items-center justify-center bg-primary-500 overflow-hidden w-32 lg:w-56">
            <Link :href="route('giveaways')">
              <ApplicationLogo class="block h-20 w-auto fill-current text-white" />
            </Link>
          </div>
        </div>

        <nav class="flex h-full px-4 py-12 bg-white border-r">
          <div class="flex flex-col h-full">
            <div class="flex-1 space-y-3">
              <NavLink :href="route('giveaways')" :active="route().current('giveaways')">
                <VIcon
                  icon="mdi-inbox-multiple"
                  class="mr-3"
                  :class="{
                    'text-primary-500': route().current('giveaways'),
                    'text-gray-300': !route().current('giveaways')
                  }"
                />
                Giveaways
              </NavLink>

              <NavLink :href="route('form-settings')" :active="route().current('form-settings')">
                <VIcon
                  icon="mdi-clipboard-text"
                  class="mr-3"
                  :class="{
                    'text-primary-500': route().current('form-settings'),
                    'text-gray-300': !route().current('form-settings')
                  }"
                />
                Form Settings
              </NavLink>

              <NavLink
                :href="route('company-settings')"
                :active="route().current('company-settings')"
              >
                <VIcon
                  icon="mdi-tools"
                  class="mr-3"
                  :class="{
                    'text-primary-500': route().current('company-settings'),
                    'text-gray-300': !route().current('company-settings')
                  }"
                />
                Company Settings
              </NavLink>

              <NavLink :href="route('team.index')" :active="route().current('team.index')">
                <VIcon
                  icon="mdi-account-group"
                  class="mr-3"
                  :class="{
                    'text-primary-500': route().current('team.index'),
                    'text-gray-300': !route().current('team.index')
                  }"
                />
                Team
              </NavLink>
            </div>

            <div class="flex flex-col space-y-3">
              <NavLink :href="route('profile.edit')" :active="route().current('profile.edit')">
                <VIcon
                  icon="mdi-account"
                  class="mr-3"
                  :class="{
                    'text-primary-500': route().current('profile.edit'),
                    'text-gray-300': !route().current('profile.edit')
                  }"
                />
                Profile
              </NavLink>
              <NavLink :href="route('logout')" method="post" class="group">
                <VIcon
                  icon="mdi-logout"
                  class="mr-3 text-gray-300 group-hover:text-primary-500 transform transition duration-150 ease-in-out"
                />
                Log Out
              </NavLink>
            </div>
          </div>
        </nav>
      </div>
    </div>

    <main class="lg:pl-[224px] bg-gray-50 min-h-screen">
      <div class="mx-auto p-6 lg:p-12 max-w-[1440px]">
        <div class="border-b-2 border-gray-300 pb-6 mb-12 lg:mb-24">
          <slot name="header" />
        </div>
        <div>
          <slot />
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
.scroll-region {
  min-height: calc(100vh - 80px);
}

.sidebar-nav {
  height: calc(100vh - 80px);
}
</style>
