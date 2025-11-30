<template>
<!--功能待開發-->
    <body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <div class="w-1/4 bg-white border-r border-gray-300">
            <!-- Sidebar Header -->
            <header class="p-4 border-b border-gray-300 flex justify-between items-center bg-indigo-600 text-white">
                <h1 class="text-2xl font-semibold">Chat Web</h1>
                <div class="relative">
                <button id="menuButton" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-100" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path d="M2 10a2 2 0 012-2h12a2 2 0 012 2 2 2 0 01-2 2H4a2 2 0 01-2-2z" />
                    </svg>
                </button>
                <!-- Menu Dropdown -->
                <div id="menuDropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                    <ul class="py-2 px-3">
                    <li><a href="#" class="block px-4 py-2 text-gray-800 hover:text-gray-400">Option 1</a></li>
                    <li><a href="#" class="block px-4 py-2 text-gray-800 hover:text-gray-400">Option 2</a></li>
                    <!-- Add more menu options here -->
                    </ul>
                </div>
                </div>
            </header>
            
            <!-- Contact List -->
            <div class="overflow-y-auto h-screen p-3 mb-9 pb-20">
                <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
                <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                    <img src="https://placehold.co/200x/ffa8e4/ffffff.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar" class="w-12 h-12 rounded-full">
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">Alice</h2>
                    <p class="text-gray-600">Hoorayy!!</p>
                </div>
                </div>
                
                <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
                <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                    <img src="https://placehold.co/200x/ad922e/ffffff.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar" class="w-12 h-12 rounded-full">
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">Martin</h2>
                    <p class="text-gray-600">That pizza place was amazing! We should go again sometime. 🍕</p>
                </div>
                </div>
                
                <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
                <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                    <img src="https://placehold.co/200x/2e83ad/ffffff.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar" class="w-12 h-12 rounded-full">
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">Charlie</h2>
                    <p class="text-gray-600">Hey, do you have any recommendations for a good movie to watch?</p>
                </div>
                </div>
                
                <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
                <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                    <img src="https://placehold.co/200x/c2ebff/0f0b14.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar" class="w-12 h-12 rounded-full">
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">David</h2>
                    <p class="text-gray-600">I just finished reading a great book! It was so captivating.</p>
                </div>
                </div>
                
                <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
                <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                    <img src="https://placehold.co/200x/e7c2ff/7315d1.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar" class="w-12 h-12 rounded-full">
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">Ella</h2>
                    <p class="text-gray-600">What's the plan for this weekend? Anything fun?</p>
                </div>
                </div>
                
                <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
                <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                    <img src="https://placehold.co/200x/ffc2e2/ffdbdb.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar" class="w-12 h-12 rounded-full">
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">Fiona</h2>
                    <p class="text-gray-600">I heard there's a new exhibit at the art museum. Interested?</p>
                </div>
                </div>
                
                <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
                <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                    <img src="https://placehold.co/200x/f83f3f/4f4f4f.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar" class="w-12 h-12 rounded-full">
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">George</h2>
                    <p class="text-gray-600">I tried that new cafe downtown. The coffee was fantastic!</p>
                </div>
                </div>
                
                <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
                <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                    <img src="https://placehold.co/200x/dddddd/999999.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar" class="w-12 h-12 rounded-full">
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">Hannah</h2>
                    <p class="text-gray-600">I'm planning a hiking trip next month. Want to join?</p>
                </div>
                </div>
                
                <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
                <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                    <img src="https://placehold.co/200x/70ff33/501616.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar" class="w-12 h-12 rounded-full">
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">Ian</h2>
                    <p class="text-gray-600">Let's catch up soon. It's been too long!</p>
                </div>
                </div>

            </div>
            </div>
            
            <!-- Main Chat Area -->
            <div class="flex-1 flex flex-col">
                <!-- Chat Header -->
                <header class="bg-white p-4 text-gray-700">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-semibold">AI 助手</h1>
                            <p class="text-sm text-gray-500">使用 Gemma 3 模型 • 對話ID: {{ conversationId }}</p>
                        </div>
                        <div class="flex space-x-2">
                          <button
                            @click="loadChatHistory"
                            class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-1 rounded"
                            :disabled="isLoading"
                          >
                            ↻ 重新載入
                          </button>
                          <button
                            @click="startNewConversation"
                            class="text-sm bg-blue-100 hover:bg-blue-200 text-blue-600 px-3 py-1 rounded"
                            :disabled="isLoading"
                          >
                            🆕 新對話
                          </button>
                        </div>
                    </div>
                </header>
                
                <!-- Chat Messages -->
                <div class="flex-1 overflow-y-auto p-4 pb-36" ref="chatMessagesContainer">
                  <div v-for="message in messages" :key="message.id" class="mb-4">
                    <!-- AI Message -->
                    <div v-if="!message.isUser" class="flex cursor-pointer">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center mr-2">
                        <img src="https://placehold.co/200x/ffa8e4/ffffff.svg?text=AI&font=Lato" alt="AI Avatar" class="w-8 h-8 rounded-full">
                        </div>
                        <div class="flex max-w-96 rounded-lg p-3 gap-3" :class="message.isError ? 'bg-red-100' : 'bg-white'">
                        <p :class="message.isError ? 'text-red-700' : 'text-gray-700'">
                          {{ message.text }}
                          <span v-if="message.model" class="text-xs text-gray-500 block mt-1">
                            {{ message.model }} • {{ message.timestamp }}
                          </span>
                          <span v-else class="text-xs text-gray-500 block mt-1">{{ message.timestamp }}</span>
                        </p>
                        </div>
                    </div>

                    <!-- User Message -->
                    <div v-else class="flex justify-end cursor-pointer">
                        <div class="flex max-w-96 bg-indigo-500 text-white rounded-lg p-3 gap-3">
                        <p>{{ message.text }}</p>
                        </div>
                        <div class="w-9 h-9 rounded-full flex items-center justify-center ml-2">
                        <img src="https://placehold.co/200x/b7a8ff/ffffff.svg?text=You&font=Lato" alt="User Avatar" class="w-8 h-8 rounded-full">
                        </div>
                    </div>
                  </div>

                  <!-- Loading indicator -->
                  <div v-if="isLoading" class="flex mb-4">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center mr-2">
                      <img src="https://placehold.co/200x/ffa8e4/ffffff.svg?text=AI&font=Lato" alt="AI Avatar" class="w-8 h-8 rounded-full">
                    </div>
                    <div class="flex max-w-96 bg-white rounded-lg p-3 gap-3">
                      <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Chat Input -->
                <footer class="bg-white border-t border-gray-300 p-4">
                    <!-- 模式選擇器 -->
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-2">
                            <label class="text-sm text-gray-600">回覆模式:</label>
                            <select
                              v-model="replyMode"
                              class="text-sm border border-gray-300 rounded px-2 py-1 focus:outline-none focus:border-blue-500"
                            >
                                <option value="fast">快速回答</option>
                                <option value="detailed">詳細回答</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input
                          type="text"
                          v-model="newMessage"
                          @keypress="handleKeyPress"
                          placeholder="輸入訊息..."
                          class="w-full p-2 rounded-md border border-gray-400 focus:outline-none focus:border-blue-500"
                          :disabled="isLoading"
                        >
                        <button
                          @click="sendMessage"
                          :disabled="!newMessage.trim() || isLoading"
                          class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2 disabled:bg-gray-400 disabled:cursor-not-allowed hover:bg-indigo-600"
                        >
                          {{ isLoading ? '發送中...' : '發送' }}
                        </button>
                    </div>
                </footer>
            </div>
        </div>
        
    </body>
</template>
<script>
import axios from 'axios';

export default {
  name: 'ChatPage',
  data() {
    return {
      messages: [
        {
          id: 1,
          text: "你好！我是 AI 助手，有什麼可以幫助您的嗎？",
          isUser: false,
          timestamp: new Date().toLocaleTimeString()
        }
      ],
      newMessage: '',
      isLoading: false,
      // conversationId: 'chat_' + Date.now(),
      conversationId: 'test_conv_001',
      replyMode: 'fast' // 'fast' 或 'detailed'
    };
  },
  methods: {
    async loadChatHistory() {
      if (this.isLoading) return;

      this.isLoading = true;

      try {
        const response = await axios.get('/backend/get_chat_history.php', {
          params: {
            conversation_id: this.conversationId,
            limit: 50 // 載入最近50條訊息
          },
          withCredentials: true
        });

        if (response.data.success && response.data.chats.length > 0) {
          // 將後端數據轉換為前端格式
          const chatMessages = response.data.chats.map(chat => ({
            id: chat.chat_id,
            text: chat.message,
            isUser: !chat.is_ai, // 0=用戶, 1=AI
            timestamp: new Date(chat.created_at).toLocaleTimeString(),
            model: chat.model
          }));

          // 替換訊息列表
          this.messages = chatMessages;

          console.log(`載入 ${chatMessages.length} 條聊天記錄`);
        } else {
          // 如果沒有歷史記錄，顯示歡迎訊息
          this.messages = [
            {
              id: 1,
              text: "你好！我是 AI 助手，有什麼可以幫助您的嗎？",
              isUser: false,
              timestamp: new Date().toLocaleTimeString()
            }
          ];
        }
      } catch (error) {
        console.error('載入聊天記錄失敗:', error);
        // 如果載入失敗，顯示錯誤訊息但不影響功能
        this.messages = [
          {
            id: 1,
            text: "載入聊天記錄失敗，但您仍可以繼續對話。",
            isUser: false,
            timestamp: new Date().toLocaleTimeString(),
            isError: true
          }
        ];
      } finally {
        this.isLoading = false;
        // 載入完成後滾動到底部
        this.$nextTick(() => {
          this.scrollToBottom();
        });
      }
    },

    startNewConversation() {
      // 生成新的對話ID
      this.conversationId = 'chat_' + Date.now();

      // 清空訊息列表，顯示歡迎訊息
      this.messages = [
        {
          id: Date.now(),
          text: "新的對話已開始！有什麼可以幫助您的嗎？",
          isUser: false,
          timestamp: new Date().toLocaleTimeString()
        }
      ];

      // 清空輸入框
      this.newMessage = '';

      console.log('開始新對話:', this.conversationId);
    },

    async sendMessage() {
      if (!this.newMessage.trim() || this.isLoading) return;

      const userMessage = {
        id: Date.now(),
        text: this.newMessage,
        isUser: true,
        timestamp: new Date().toLocaleTimeString()
      };

      // 添加用戶訊息到列表
      this.messages.push(userMessage);
      const messageToSend = this.newMessage;
      this.newMessage = '';

      // 顯示載入狀態
      this.isLoading = true;

      try {
        // 根據回覆模式設置不同的參數
        const modeOptions = this.replyMode === 'fast' ? {
          temperature: 0.3,
          top_p: 0.7,
          top_k: 40,
          num_predict: 150
        } : {
          temperature: 0.8,
          top_p: 0.9,
          top_k: 50,
          num_predict: 300
        };

        const response = await axios.post('/backend/chat_api.php', {
          message: messageToSend,
          conversation_id: this.conversationId,
          options: modeOptions
        }, {
          withCredentials: true
        });

        if (response.data.success) {
          const aiMessage = {
            id: Date.now() + 1,
            text: response.data.message,
            isUser: false,
            timestamp: new Date().toLocaleTimeString(),
            model: response.data.model
          };

          this.messages.push(aiMessage);

          // 更新 conversation_id 如果是新的對話
          if (response.data.conversation_id) {
            this.conversationId = response.data.conversation_id;
          }
        } else {
          // 顯示錯誤訊息
          const errorMessage = {
            id: Date.now() + 1,
            text: `錯誤: ${response.data.error || '未知錯誤'}`,
            isUser: false,
            timestamp: new Date().toLocaleTimeString(),
            isError: true
          };
          this.messages.push(errorMessage);
        }
      } catch (error) {
        console.error('發送訊息失敗:', error);
        const errorMessage = {
          id: Date.now() + 1,
          text: `網路錯誤: ${error.response?.data?.error || error.message}`,
          isUser: false,
          timestamp: new Date().toLocaleTimeString(),
          isError: true
        };
        this.messages.push(errorMessage);
      } finally {
        this.isLoading = false;
        // 滾動到底部
        this.$nextTick(() => {
          this.scrollToBottom();
        });
      }
    },

    handleKeyPress(event) {
      if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        this.sendMessage();
      }
    },

    scrollToBottom() {
      const chatContainer = this.$refs.chatMessagesContainer;
      if (chatContainer) {
        chatContainer.scrollTop = chatContainer.scrollHeight;
      }
    }
  },

  async mounted() {
    // 初始化載入聊天記錄
    await this.loadChatHistory();

    // 滾動到底部
    this.$nextTick(() => {
      this.scrollToBottom();
    });
  }
};
</script>