<template>
  <section class="bg-gray-50 dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          <img class="h-23 mr-10" src="../assets/HGlogo.png" alt="logo">
          
      </a>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  登入
              </h1>
              <form @submit.prevent="login" class="space-y-4 md:space-y-6">
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                      <input v-model="email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input v-model="password" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>

                  <button type="submit" class="w-full text-white bg-sky-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">登入</button>
                  還沒有帳號?<router-link to="/register" class="underline decoration-sky-500">註冊</router-link>
              </form>
          </div>
      </div>
  </div>
</section>

</template>
  
<script>
import { ref } from 'vue'
import { useStore } from 'vuex'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'

axios.defaults.withCredentials = true // ensure request Cookie

export default {
  setup() {
    const email = ref('')
    const password = ref('')

    const store = useStore()
    const router = useRouter()
    const route = useRoute()

    const login = async () => {
      try {
        const response = await axios.post('/backend/login.php', {
          email: email.value,
          password: password.value,
        });

        // 改為使用 error_code 判斷成功 (0 為成功)
        if (response.data && (response.data.error_code === 0 || response.data.loggedIn)) {
          console.log(response.data);
          // 先更新 local store
          store.commit('setLogin', {
            id: response.data.user_id,
            name: response.data.user_name,
          });

          // 再同步與 server 檢查，避免 router guard 在導向時做錯誤判定
          await store.dispatch('checkAuth');

          const redirectPath = route.query.redirect || '/topics';
          router.push(redirectPath);
        } else {
          alert(response.data.message || '登入失敗');
        }
      } catch (error) {
        console.error(error);
      }
    }

    return {
      email,
      password,
      login,
    }
  },
}
</script>

