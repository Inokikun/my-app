import { createApp } from 'vue';
import LoginPage from './pages/LoginPage.vue';
import '../css/app.css';

//①vueをbladeへマウント:HTML属性で値を渡す
const el = document.getElementById('login-app')

if (el) {
  const csrfToken = el.dataset.csrfToken || ''
  const loginUrl = el.dataset.loginUrl || ''
  const errors = el.dataset.errors ? JSON.parse(el.dataset.errors) : {}
  const old = el.dataset.old ? JSON.parse(el.dataset.old) : {}
  const authError = el.dataset.authError || null

  createApp(LoginPage, { csrfToken, loginUrl, errors, old,authError }).mount(el)
}

//const app = createApp({});
//app.component('login-page', LoginPage);
//app.mount('#app');
