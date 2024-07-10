<template>
  <div class="mt-20 w-full bg-white rounded-lg border p-2 my-4 mx-6">
    <h3 class="font-bold">{{ topic.title }}</h3>
    <form @submit.prevent="submitComment">
      <div class="flex flex-col">
        <!-- 評論列表 -->
        <div v-for="comment in comments" :key="comment.comment_id" class="border rounded-md p-3 ml-3 my-3">
          <div class="flex gap-3 items-center">
            <img src="../assets/cat.jpg"
                class="object-cover w-8 h-8 rounded-full border-2 border-emerald-400 shadow-emerald-400">
            <h3 class="font-bold">{{ comment.user_name }}</h3>
          </div>
          <p class="text-gray-600 mt-2">{{ comment.content }}</p>
        </div>
        <!-- 新增評論表單 -->
        <div class="border rounded-md p-3 ml-3 my-3">
          <div class="flex gap-3 items-center">
            <img src="../assets/cat.jpg"
                class="object-cover w-8 h-8 rounded-full border-2 border-emerald-400 shadow-emerald-400">
            <h3 class="font-bold">{{ currentUser.name }}</h3>
          </div>
          <p class="text-gray-600 mt-2">{{ newComment }}</p>
        </div>
      </div>
      <div class="w-full px-3 my-2">
        <textarea class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"
                  v-model="newComment" @keypress.enter.prevent="submitComment" placeholder="Type Your Comment" required></textarea>
      </div>
      <div class="w-full flex justify-end px-3">
        <input type="submit" class="px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500" value="Post Comment">
      </div>
    </form>
  </div>

</template>
  
<script>
import axios from 'axios';

export default {
  data() {
    return {
      topic: {},
      comments: [],
      newComment: '',
      currentUser: {
        name: '' // Initialize with an empty string
      }
    };
  },
  methods: {
    fetchTopicData() {
      const topicId = this.$route.params.id;
      axios.get(`http://localhost/backend/get_topic_with_comments.php?topic_id=${topicId}`)
        .then(response => {
          this.topic = response.data.topic;
          this.comments = response.data.comments;
        })
        .catch(error => {
          console.error("There was an error fetching the topic data:", error);
        });
    },
    getCurrentUser() {
      axios.get('http://localhost/backend/check_login.php')
        .then(response => {
          this.currentUser.name = response.data.user_name;
        })
        .catch(error => {
          console.error("There was an error fetching the current user:", error);
        });
    },
    submitComment() {
      const topicId = this.$route.params.id;
      axios.post('http://localhost/backend/post_comment.php', {
        topic_id: topicId,
        content: this.newComment
      })
      .then(response => {
        if(response.data.success) {
          this.comments.push({
            user_name: this.currentUser.name,
            content: this.newComment,
            comment_id: response.data.comment_id
          });
          this.newComment = '';
        }
      })
      .catch(error => {
        console.error("There was an error posting the comment:", error);
      });
    }
  },
  mounted() {
    this.fetchTopicData();
    this.getCurrentUser();
  }
};
</script>
