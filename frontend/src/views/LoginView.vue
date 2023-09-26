<script setup>
import http from '@/services/http.js';
import { reactive } from 'vue';
import { useAuthStore } from '@/stores/auth.js';
import router from '../router';

const auth = useAuthStore();

let user = reactive({
  email: '',
  password: ''
})

async function login() {
  try {
    const { data } = await http.post('/login', user);
    console.log(data.data.token)
    if (data.message == 'User Loged') {
      auth.setToken(data.data.token)
      auth.setUser(data.data.user_name)
      router.push({ name: 'dashboard' })
    }
  } catch (error) {
    console.log(error?.response?.data)
  }
}
</script>

<template>
  <main>
    <section class="absolute w-full h-full">
      <div class="absolute top-0 w-full h-full bg-gray-900"
        style="background-image: url(./assets/img/register_bg_2.png); background-size: 100%; background-repeat: no-repeat;">
      </div>
      <div class="container h-full px-4 mx-auto">
        <div class="flex items-center content-center justify-center h-full">
          <div class="w-full px-4 lg:w-4/12">
            <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-gray-300 border-0 rounded-lg shadow-lg">

              <!--
              <div class="px-6 py-6 mb-0 rounded-t">
                <div class="mb-3 text-center">
                  <h6 class="text-sm font-bold text-gray-600">
                    Sign in with
                  </h6>
                </div>
                <div class="text-center btn-wrapper">
                  <button
                    class="inline-flex items-center px-4 py-2 mb-1 mr-2 text-xs font-normal font-bold text-gray-800 uppercase bg-white rounded shadow outline-none active:bg-gray-100 focus:outline-none hover:shadow-md"
                    type="button" style="transition: all 0.15s ease 0s;">
                    <img alt="..." class="w-5 mr-1" src="./assets/img/github.svg" />Github</button><button
                    class="inline-flex items-center px-4 py-2 mb-1 mr-1 text-xs font-normal font-bold text-gray-800 uppercase bg-white rounded shadow outline-none active:bg-gray-100 focus:outline-none hover:shadow-md"
                    type="button" style="transition: all 0.15s ease 0s;">
                    <img alt="..." class="w-5 mr-1" src="./assets/img/google.svg" />Google
                  </button>
                </div>
                <hr class="mt-6 border-gray-400 border-b-1" />
              </div>
              -->

              <div class="flex-auto px-4 py-10 pt-10 lg:px-10">
                <div class="mb-3 font-bold text-center text-gray-500">
                  <small>Or sign in with credentials</small>
                </div>
                <form @submit.prevent="login">
                  <div class="relative w-full mb-3">
                    <label class="block mb-2 text-xs font-bold text-gray-700 uppercase" for="grid-password">Email</label>
                    <input type="email" v-model="user.email" required autofocus
                      class="w-full px-3 py-3 text-sm text-gray-700 placeholder-gray-400 bg-white border-0 rounded shadow focus:outline-none focus:ring"
                      placeholder="Email" style="transition: all 0.15s ease 0s;" />
                  </div>
                  <div class="relative w-full mb-3">
                    <label class="block mb-2 text-xs font-bold text-gray-700 uppercase"
                      for="grid-password">Password</label>
                    <input type="password" v-model="user.password" required
                      class="w-full px-3 py-3 text-sm text-gray-700 placeholder-gray-400 bg-white border-0 rounded shadow focus:outline-none focus:ring"
                      placeholder="Password" style="transition: all 0.15s ease 0s;" />
                  </div>
                  <div>
                    <label class="inline-flex items-center cursor-pointer"><input id="customCheckLogin" type="checkbox"
                        class="w-5 h-5 ml-1 text-gray-800 border-0 rounded form-checkbox"
                        style="transition: all 0.15s ease 0s;" /><span
                        class="ml-2 text-sm font-semibold text-gray-700">Remember me</span></label>
                  </div>
                  <div class="mt-6 text-center">
                    <button
                      class="w-full px-6 py-3 mb-1 mr-1 text-sm font-bold text-white uppercase bg-gray-900 rounded shadow outline-none active:bg-gray-700 hover:shadow-lg focus:outline-none"
                      type="submit" style="transition: all 0.15s ease 0s;">
                      Sign In
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="flex flex-wrap mt-6">
              <div class="w-1/2">
                <a href="#pablo" class="text-gray-300"><small>Forgot password?</small></a>
              </div>
              <div class="w-1/2 text-right">
                <a href="#pablo" class="text-gray-300"><small>Create new account</small></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="absolute bottom-0 w-full pb-6 bg-gray-900">
        <div class="container px-4 mx-auto">
          <hr class="mb-6 border-gray-700 border-b-1" />
          <div class="flex flex-wrap items-center justify-center md:justify-between">
            <div class="w-full px-4 md:w-4/12">
              <div class="py-1 text-sm font-semibold text-white">
                Copyright © 2019
                <a href="https://www.creative-tim.com"
                  class="py-1 text-sm font-semibold text-white hover:text-gray-400">Creative Tim</a>
              </div>
            </div>
            <div class="w-full px-4 md:w-8/12">
              <ul class="flex flex-wrap justify-center list-none md:justify-end">
                <li>
                  <a href="https://www.creative-tim.com"
                    class="block px-3 py-1 text-sm font-semibold text-white hover:text-gray-400">Creative Tim</a>
                </li>
                <li>
                  <a href="https://www.creative-tim.com/presentation"
                    class="block px-3 py-1 text-sm font-semibold text-white hover:text-gray-400">About Us</a>
                </li>
                <li>
                  <a href="http://blog.creative-tim.com"
                    class="block px-3 py-1 text-sm font-semibold text-white hover:text-gray-400">Blog</a>
                </li>
                <li>
                  <a href="https://github.com/creativetimofficial/argon-design-system/blob/master/LICENSE.md"
                    class="block px-3 py-1 text-sm font-semibold text-white hover:text-gray-400">MIT License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </section>
  </main>
</template>
  