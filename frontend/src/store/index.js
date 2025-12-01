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
    async login({ commit }, credentials) {
      try {
        const res = await axios.post('/backend/login.php', credentials);
        if (res.data.error_code === 0) {
          commit('setAuth', {
            loggedIn: true,
            user: { id: res.data.user_id, name: res.data.user_name }
          });
        }
        return res.data;
      } catch (error) {
        commit('setAuth', { loggedIn: false, user: null });
        throw error;
      }
    },
    async logout({ commit }) {
      try {
        await axios.post('/backend/logout.php');
        commit('setAuth', { loggedIn: false, user: null });
      } catch (error) {
        // 即使登出API失敗，也要把本地狀態設為未登入
        commit('setAuth', { loggedIn: false, user: null });
        throw error;
      }
    },
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
