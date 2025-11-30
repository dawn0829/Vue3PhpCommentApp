<template>
  <div class="min-h-screen relative" :style="bgStyle">
    <!-- Overlay for readability; z-0/pointer-events-none prevents blocking navbar clicks -->
    <div class="absolute inset-0 bg-black/40 z-0 pointer-events-none"></div>

    <div class="relative z-10 flex flex-col items-center justify-center min-h-screen px-4 text-center text-white">
      <h1 class="text-2xl md:text-4xl font-bold mb-6">這是展示主頁結合上份工作實作前後端分離 歡迎前輩們指教</h1>

      <div class="bg-white/10 rounded-md p-4 inline-block">
        <h2 class="text-xl font-semibold mb-3">首頁</h2>
        <div class="space-x-4">
          <router-link to="/login" class="underline hover:text-amber-300">登入</router-link>
          <span>還沒有帳號?</span>
          <router-link to="/register" class="underline hover:text-amber-300">註冊</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import bg from '@/assets/HomePage.png';

export default {
  name: 'HomePage',
  data() {
    return {
      bg
    };
  },
  computed: {
    bgStyle() {
      // Use inline style for background to ensure proper bundling.
      return {
        backgroundImage: `url(${this.bg})`,
        backgroundSize: 'cover',
        backgroundPosition: 'center',
        backgroundRepeat: 'no-repeat'
      };
    }
  }
};
</script>

<style scoped>
/* Ensure content takes full height and text is visible */
.min-h-screen {
  min-height: 100vh;
}
</style>