import { defineStore } from 'pinia'
import { computed, ref } from 'vue'
import http from '@/services/http.js';
import router from '../router';

export const useAuthStore = defineStore('auth', () => {
  const token = ref(localStorage.getItem('token'))
  const user = ref(localStorage.getItem('user'))

  function setToken(tokenValue) {
    localStorage.setItem('token', tokenValue);
    token.value = tokenValue;
  }

  function setUser(userValue) {
    localStorage.setItem('user', userValue);
    user.value = userValue;
  }

  const isAuthenticated = computed(() => {
    return user.value && token.value
  })

  async function clear() {
    try {
      const tokenAuth = 'Bearer ' + token.value
      const { data } = await http.post('/logout', {
        headers: {
          Authorization: tokenAuth
        }
      });
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      token.value = ''
      user.value = ''
    } catch (error) {
      console.log(error.response.data)
    }
    router.push({ name: 'home' })
  }

  async function checkToken() {
    try {
      const tokenAuth = 'Bearer ' + token.value
      const { data } = await http.get('/verify-token', {
        headers: {
          Authorization: tokenAuth
        }
      });
      return data.message;
    } catch (error) {
      console.log(error.response.data)
    }
  }

  return {
    token,
    user,
    setToken,
    setUser,
    checkToken,
    isAuthenticated,
    clear
  }
})
