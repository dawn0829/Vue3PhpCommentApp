<template>
  <div class="mt-20">
    <div class="flex justify-between relative mb-4">
      <!-- 前端搜尋欄 -->
      <label for="table-search" class="sr-only">Search</label>
      <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
          </svg>
        </div>
        <input v-model="searchQuery" type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="透過Vue簡易搜尋">
      </div>

      <!-- 後端搜尋欄 -->
      <div class="relative ml-4">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
          </svg>
        </div>
        <input v-model="newSearchQuery" @input="searchTopics" type="text" id="table-search-users-new" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="PHP的搜尋欄">
      </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">討論主題</th>
            <th scope="col" class="px-6 py-3">Created By</th>
            <th scope="col" class="px-6 py-3">Email</th>
            <th scope="col" class="px-6 py-3">Update_Time<button @click="toggleSortOrder" class="ml-2 px-4 py-2 text-white bg-blue-500 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-up" viewBox="0 0 16 16">
                  <path d="M3.5 12.5a.5.5 0 0 1-1 0V3.707L1.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.5.5 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L3.5 3.707zm3.5-9a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                </svg>
              </button></th>
            
            <th scope="col" class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="topic in sortedTopics" :key="topic.topic_id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="px-6 py-4">{{ topic.title }}</td>
            <td class="px-6 py-4">{{ topic.user.name }}</td>
            <td class="px-6 py-4">{{ topic.user.email }}</td>
            <td class="px-6 py-4">{{ topic.last_comment_time ? topic.last_comment_time : topic.created_at }}</td>
            <td class="px-6 py-4"><router-link :to="`/topics/${topic.topic_id}`" class="text-blue-500 hover:underline">View Comment</router-link></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      topics: [],
      searchQuery: '',
      newSearchQuery: '', // 新增存放後端搜尋欄的值
      sortOrder: 'desc' // 初始排序順序
    };
  },
  async created() {
    this.fetchTopics();
  },
  methods: {
    async fetchTopics() {
      try {
        const response = await axios.get('/backend/get_topic_with_user.php');
        this.topics = response.data;
      } catch (error) {
        console.error('Failed to fetch topics:', error);
      }
    },
    async searchTopics() {
      try {
        //在get加入keyword參數
        const response = await axios.get('/backend/get_search_topic.php', {
          params: {
            keyword: this.newSearchQuery
          }
        });
        this.topics = response.data.topics;
      } catch (error) {
        console.error('Failed to search topics:', error);
      }
    },
    toggleSortOrder() {
        this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
    }
  },
  computed: {
    filteredTopics() {
      return this.topics.filter(topic =>
        topic.title.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
    sortedTopics() {
        //sortedTopics依賴filteredTopics 
        return [...this.filteredTopics].sort((a, b) => {

          const dateA = new Date(a.last_comment_time || a.created_at);
          const dateB = new Date(b.last_comment_time || b.created_at);
  
          if (this.sortOrder === 'asc') {
            return dateA - dateB;
          } else {
            return dateB - dateA;
          }
        });
    }
  },
};
</script>
