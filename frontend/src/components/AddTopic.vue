<template>
    <div>
      <h1 class="text-2xl font-bold mb-4">增新討論主題</h1>
      <form @submit.prevent="submitTopic">
        <input v-model="title" type="text" placeholder="Topic Title" required class="border p-2 mb-4 w-full" @keypress.enter.prevent="submitTopic"/>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">增新討論主題</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        title: '',
        currentUser: {
          id: '', // Initialize with an empty string or null
        },
      };
    },
    mounted() {
      this.getCurrentUser();
    },
    methods: {
      getCurrentUser() {
        return axios.get('/backend/check_login.php', { withCredentials: true })
          .then(response => {
            this.currentUser.id = response.data.user_id; // Assuming user_id is returned from check_login.php

          })
          .catch(error => {
            console.error("There was an error fetching the current user:", error);
            throw error; // Ensure the error is propagated
          });
      },
      submitTopic() {
        if (this.title.trim()) {
          this.getCurrentUser()
            .then(() => {
              const postData = {
                title: this.title,
                user_id: this.currentUser.id // Pass user_id to the backend
              };
              return axios.post('/backend/add_topic.php', postData, { withCredentials: true });
            })
            .then(() => {
              console.log("Topic added successfully");
              this.title = ''; // 清空輸入框
              this.$emit('topic-added'); // 觸發增新自定義事件，動態更新
            })
            .catch(error => {
              console.error("Error adding topic:", error);
            });
        }
      },
    },
  };
  </script>
  