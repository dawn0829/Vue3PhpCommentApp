<template>
    <div>
      Logging out...
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'UserLogout',
    async created() {
      try {
        await axios.post('/backend/logout.php');
        // 直接清除 Vuex state，不發送額外 API
        this.$store.commit('setLogout');
        this.$router.push('/login');
      } catch (error) {
        console.error('Logout failed:', error);
        // 即使登出失敗也清除本地狀態
        this.$store.commit('setLogout');
        this.$router.push('/login');
      }
    }
  };
  </script>
