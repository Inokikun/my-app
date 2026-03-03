import { createApp } from 'vue';
import Home from './pages/Home.vue';
import '../css/app.css';

//①vueをbladeへマウント:HTML属性で値を渡す
const el = document.getElementById('app')
if (el) {
    const signupUrl = el.dataset.signupUrl || ''
    createApp(Home, { signupUrl }).mount(el)
}

//const app = createApp({});
//app.component('top-page', Home);
//app.mount('#app');
