import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/HomePage.vue';
import Register from '../components/UserRegister.vue';
import Login from '../components/UserLogin.vue';
import Chat from '../view/ChatPage.vue';
import TopicPage from '../view/TopicsPage.vue';
import TopicDetail from '../components/TopicDetail.vue';
import UserLogout from '../components/UserLogout.vue';

const routes = [
  { path: '/', name: 'HomePage', component: Home },
  { path: '/register', name: 'UserRegister', component: Register },
  { path: '/login', name: 'Login', component: Login },
  { path: '/topics',name: 'TopicPage', component: TopicPage, meta: { requiresAuth: true }},
  { path: '/chat', name: 'Chat', component: Chat, meta: { requiresAuth: true }},
  { path: '/topics/:id', name: 'TopicDetail', component: TopicDetail,  meta: { requiresAuth: true }},
  { path: '/logout', name: 'UserLogout', component: UserLogout }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
