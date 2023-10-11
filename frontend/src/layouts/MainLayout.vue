<script setup>
import { RouterLink } from 'vue-router'
import { useAuthStore } from '@/stores/auth.js';

const auth = useAuthStore();

function logout() {
  auth.clear()
}
</script>

<template>
    <nav class="bg-purple-700 border-gray-200 dark:bg-gray-900 text-white">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
            <RouterLink :to="{ name: 'home' }" class="flex items-center">
                <span class="self-center text-lg font-semibold md:text-2xl whitespace-nowrap dark:text-white">Plane Tickets</span>
            </RouterLink>
            <div class="flex gap-1 md:order-2 text-black">
                <template v-if="auth.isAuthenticated">
                    <RouterLink :to="{ name: 'dashboard' }" type="button"
                        class="px-4 py-2 text-sm font-medium text-center bg-white rounded-lg hover:bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 md:mr-0 dark:bg-white dark:hover:bg-white dark:focus:ring-blue-800">Dashboard</RouterLink>
                    <button @click="logout" type="button"
                        class="px-4 py-2 text-sm font-medium text-center bg-white rounded-lg hover:bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 md:mr-0 dark:bg-white dark:hover:bg-white dark:focus:ring-blue-800">Logout</button>
                </template>

                <template v-else>
                    <RouterLink :to="{ name: 'login' }" type="button"
                        class="px-4 py-2 text-sm font-medium text-center bg-white rounded-lg hover:bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 md:mr-0 dark:bg-white dark:hover:bg-white dark:focus:ring-blue-800">Log in</RouterLink>
                    <RouterLink :to="{ name: 'register' }" type="button"
                        class="px-4 py-2 text-sm font-medium text-center bg-white rounded-lg hover:bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 md:mr-0 dark:bg-white dark:hover:bg-white dark:focus:ring-blue-800">Register</RouterLink>
                </template>

                <button data-collapse-toggle="navbar-cta" type="button"
                    class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-cta" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1 text-white" id="navbar-cta">
                <ul
                    class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg md:p-0 bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-purple-700 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <RouterLink :to="{ name: 'home' }"
                            class="block py-2 pl-3 pr-4 text-white bg-white rounded md:bg-transparent md:text-black md:p-0 md:dark:text-blue-500"
                            aria-current="page">Home</RouterLink>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Services</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="py-10">
        <slot />
    </div>
</template>