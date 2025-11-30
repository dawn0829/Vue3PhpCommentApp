<template>
  <nav
    class="bg-amber-400 border-gray-200 dark:bg-gray-900 dark:border-gray-700 fixed top-0 left-0 w-full z-50"
  >
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="./assets/catlogo.svg" class="h-8" alt="Flowbite Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
          DAWNChatWeb
        </span>
      </a>

      <!-- 手機版 menu -->
      <button
        @click="toggleNavbar"
        type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
        aria-controls="navbar-dropdown"
        aria-expanded="false"
      >
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>

      <div
        :class="{'hidden': !isNavbarOpen, 'block': isNavbarOpen}"
        class="w-full md:block md:w-auto"
        id="navbar-dropdown"
      >
        <ul
          class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50
                 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-amber-800
                 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700"
        >
          <!-- 登入 / 登出 改成按鈕，依 isLoggedIn 顯示 -->
          <li v-if="!isLoggedIn">
            <button
              type="button"
              @click="handleLogin"
              class="font-bold block py-2 px-3 text-white rounded border-4 border-amber-800
                     hover:bg-gray-100 md:hover:bg-transparent md:border-4 md:border-amber-800
                     md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500
                     dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
            >
              登入
            </button>
          </li>
          <li v-else>
            <button
              type="button"
              @click="handleLogout"
              class="font-bold block py-2 px-3 text-white rounded border-4 border-amber-800
                     hover:bg-gray-100 md:hover:bg-transparent md:border-4 md:border-amber-800
                     md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500
                     dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
            >
              登出
            </button>
          </li>

          <!-- 其他功能一樣用 router-link -->
          <li>
            <router-link
              to="/topics"
              class="font-bold block py-2 px-3 text-white rounded border-4 border-amber-800
                     hover:bg-gray-100 md:hover:bg-transparent md:border-4 md:border-amber-800
                     md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500
                     dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
            >
              討論區
            </router-link>
          </li>
          <li>
            <router-link
              to="/chat"
              class="font-bold block py-2 px-3 text-white rounded border-4 border-amber-800
                     hover:bg-gray-100 md:hover:bg-transparent md:border-4 md:border-amber-800
                     md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500
                     dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
            >
              聊天室
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="app" class="pt-16">
    <!-- 上面有 fixed nav，所以這邊加點 padding-top 避免被蓋住 -->
    <router-view></router-view>
  </div>
</template>

<script>
// import axios from 'axios'

export default {
  name: 'App',
  data() {
    return {
      isNavbarOpen: false
    }
  },
  computed: {
    isLoggedIn() {
      return this.$store.state.isLoggedIn
    }
  },
  methods: {
    toggleNavbar() {
      this.isNavbarOpen = !this.isNavbarOpen
    },

    // 按下登入按鈕：發 API，成功後更新 Vuex
    async handleLogin() {
      try {
        // 這裡示範用固定帳密，你可以改成彈出登入視窗/從表單拿資料
        const credentials = {
          username: 'testuser',
          password: 'testpassword'
        }

        await this.$store.dispatch('login', credentials)
        // 登入成功後如果要跳轉頁面，可加這行：
        // this.$router.push('/topics')
      } catch (err) {
        console.error('登入失敗', err)
        alert('登入失敗')
      }
    },

    // 按下登出按鈕：發 API，成功後更新 Vuex
    async handleLogout() {
      try {
        await this.$store.dispatch('logout')
        // this.$router.push('/') // 看你要不要回首頁
      } catch (err) {
        console.error('登出失敗', err)
        alert('登出失敗')
      }
    }
  }
}
</script>
