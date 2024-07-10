<template>
    <div class="p-6">
        <TopicList ref="topicList"/>
      <AddTopic @topic-added="refreshTopics"/>
      
    </div>
  </template>
  
  <script>
  import AddTopic from '@/components/AddTopic.vue';
  import TopicList from '@/components/TopicList.vue';
  
  export default {
    components: {
      AddTopic,
      TopicList
    },
    methods: {
      refreshTopics() {
        this.$refs.topicList.fetchTopics();
      }
    }
  };
  </script>
  