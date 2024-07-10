<template>
    <div>
      <h1>首頁</h1>
      <router-link to="/login">登入</router-link>
      還沒有帳號?
      <router-link to="/register">註冊</router-link>
      
    </div>
</template>
  
<script>
  export default {
    name: 'HomePage'
  };
</script>