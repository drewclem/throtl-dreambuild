<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white">
                <!-- Primary Navigation Menu -->
                <div class="flex justify-between">
                    <div class="flex">
                        <!-- Logo -->
                        <div
                            class="flex items-center justify-center bg-primary-500 w-32 overflow-hidden lg:w-56"
                        >
                            <Link :href="route('giveaways')">
                                <ApplicationLogo
                                    class="block h-20 w-auto fill-current text-white"
                                />
                            </Link>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Settings Dropdown -->
                        <!-- <div class="ml-3 relative">
                            <DropdownLink :href="route('profile.edit')">
                                Profile
                            </DropdownLink>
                            <DropdownLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </DropdownLink>
                        </div> -->
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                        >
                            <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex':
                                            !showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex':
                                            showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink
                            :href="route('giveaways')"
                            :active="route().current('giveaways')"
                        >
                            Giveaways
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="flex overflow-hidden">
                <aside class="w-56 bg-white px-6 py-12">
                    <nav class="flex h-full">
                        <div class="flex flex-col h-full">
                            <div class="flex-1">
                                <NavLink
                                    :href="route('giveaways')"
                                    :active="route().current('giveaways')"
                                >
                                    <VIcon
                                        size="large"
                                        icon="mdi-inbox-multiple"
                                        class="mr-3"
                                        :class="{
                                            'text-primary-500':
                                                route().current('giveaways'),
                                            'text-gray-300':
                                                !route().current('giveaways'),
                                        }"
                                    />
                                    Giveaways
                                </NavLink>
                            </div>

                            <div>
                                <NavLink
                                    :href="route('profile.edit')"
                                    :active="route().current('profile.edit')"
                                >
                                    <VIcon
                                        size="large"
                                        icon="mdi-account"
                                        class="mr-3"
                                        :class="{
                                            'text-primary-500':
                                                route().current('profile.edit'),
                                            'text-gray-300':
                                                !route().current(
                                                    'profile.edit'
                                                ),
                                        }"
                                    />
                                    Profile
                                </NavLink>
                                <NavLink :href="route('logout')" method="post">
                                    <VIcon
                                        size="large"
                                        icon="mdi-logout"
                                        class="mr-3"
                                    />
                                    Log Out
                                </NavLink>
                            </div>
                        </div>
                    </nav>
                </aside>

                <div class="px-12">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<style scoped>
main {
    height: calc(100vh - 80px);
}
</style>
