import { createApp } from 'vue'
import App from './App.vue'
import './tailwind.css'; // 引入 Tailwind CSS

import router from './router/index.js';
import axios from 'axios';

const app = createApp(App);
app.use(router);

//Check login session
router.beforeEach(async (to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      try {
        const response = await axios.get('http://localhost/backend/check_login.php');
        //console.log(response);
        if (response.data.loggedIn) {
            next();
        } else {
          next({ path: '/login', query: { redirect: to.fullPath } });
        }
      } catch (error) {
            console.error("There was an error checking login status:", error);
            next({ path: '/login', query: { redirect: to.fullPath } });
      }
    } else {
        console.log("No authentication required.");
        next();
    }
});

  app.mount('#app');