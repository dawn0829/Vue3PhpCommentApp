import { createStore } from 'vuex';
import axios from 'axios';

const store = createStore({
  state: {
    isLoggedIn: false,
    user: null
  },
  mutations: {
    setAuth(state, payload) {
      state.isLoggedIn = payload.loggedIn;
      state.user = payload.user || null;
    },
    // 直接設置登入狀態，不發 API
    setLogin(state, user) {
      state.isLoggedIn = true;
      state.user = user;
    },
    // 直接設置登出狀態，不發 API
    setLogout(state) {
      state.isLoggedIn = false;
      state.user = null;
    }
  },
  actions: {
    async checkAuth({ commit }) {
      try {
        const res = await axios.get('/backend/check_login.php');
        // 優先判斷後端回傳的 error_code（0 為成功），若沒有則 fallback 至 loggedIn
        const loggedIn = res.data && (res.data.error_code === 0 || res.data.loggedIn);
        if (loggedIn) {
          commit('setAuth', { loggedIn: true, user: { id: res.data.user_id, name: res.data.user_name } });
        } else {
          commit('setAuth', { loggedIn: false, user: null });
        }
        return res.data;
      } catch (error) {
        commit('setAuth', { loggedIn: false, user: null });
        throw error;
      }
    }
  },
  getters: {
    isLoggedIn: (state) => state.isLoggedIn,
    user: (state) => state.user
  }
});

export default store;
