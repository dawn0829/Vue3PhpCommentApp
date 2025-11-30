import { createApp } from 'vue'
import App from './App.vue'
import './tailwind.css'; // 引入 Tailwind CSS

import router from './router/index.js';
import axios from 'axios';
import store from './store';
// Ensure axios sends credentials (cookies) so PHP session is included
axios.defaults.withCredentials = true;

const app = createApp(App);
app.use(router);
app.use(store);

// Check login session
router.beforeEach(async (to, from, next) => {
  if (!to.matched.some(record => record.meta.requiresAuth)) {
    // no auth required
    return next();
  }

  // 如果 store 已經知道使用者是登入狀態，直接放行
  if (store.getters.isLoggedIn) {
    return next();
  }

  // 否則再呼叫後端做一次檢查（可以用 store action）
  try {
    const res = await store.dispatch('checkAuth'); // 返回後端回應
    // 若後端回傳 success (error_code === 0) 或 loggedIn true
    const loggedIn = res && (res.error_code === 0 || res.loggedIn);
    if (loggedIn) {
      next();
    } else {
      next({ path: '/login', query: { redirect: to.fullPath } });
    }
  } catch (error) {
    console.error("There was an error checking login status:", error);
    next({ path: '/login', query: { redirect: to.fullPath } });
  }
});

// Initialize store auth check before mount to have initial state
store.dispatch('checkAuth').finally(() => {
  app.mount('#app');
});