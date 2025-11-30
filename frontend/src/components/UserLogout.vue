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
        this.$router.push('/login');
      } catch (error) {
        console.error('Logout failed:', error);
        this.$router.push('/login');
      }
    }
  };
  </script>
