<template>
  <!-- // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/.docx -->

  <button @click="toggle_1" :class="{ active: isActive }">
    {{ isActive ? 'ON' : 'OFF' }}
  </button>

  <button @click="toggle_2">
    切り替え
  </button>

  <p v-if = "isVisible">
    表示されています!
  </p>

  <h1 class="main-ttl">vue3、typescript、Laravel、mySQLを使ったWebアプリケーション</h1>
    <nav class="nav">
      <div class="other-page-link">
        <ul>
          <li><a href='/login'>ログイン</a></li>

          <!-- ①vueをbladeへマウント:HTML属性で値を渡す　-->
          <li><a :href="signupUrl">HTML属性で値を渡すでの新規アカウント作成</a></li>

          <!-- ②vueをbladeへマウント:routeUrlsで値を渡す
          <li><a :href="routeUrls.signupUrl">routeUrlsで値を渡すでの新規アカウント作成</a></li>　-->
        </ul>
          <!-- <p>{{ error_message }}</p> -->
      </div>
    </nav>
</template>

<script lang="ts" setup>
  // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/.docx

  import { ref, Ref, onMounted } from 'vue'

  const aaa:string = "takano";
  const b: string = "1";
  let age: number = 100;
  alert("TypeScriptからアラート出力")
  console.log("TypeScriptからブラウザの開発者ツールのconsoleに出力");

  const isActive: Ref<boolean> = ref(false)
  function toggle_1(): void {
    isActive.value = !isActive.value
  }

  const isVisible: Ref<boolean> = ref(true)

  function toggle_2(): void {
    isVisible.value = !isVisible.value
  }

  onMounted(() => {
    alert("onMounted")
    })

  {{ /*  ①vueをbladeへマウント:HTML属性で値を渡す */ }}
  const props = defineProps<{signupUrl : string }>()
  alert(props.signupUrl)

  {{ /*  ②vueをbladeへマウント:routeUrlsで値を渡す
  const routeUrls = window.routeUrls; */ }}
</script>

<style scoped>
/* // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/.docx */

@charset "UTF-8";

* {
  box-sizing: border-box;
}

html {
  /*文字サイズを10pxに設定 */
  font-size: 62.5%;
}

body {
  /*フォントサイズを1.6em（16px）に設定 */
  font-size: 1.6em;
  text-align: center;
  width: 1920px;
  margin: 0 auto;
  max-width: 100%;
  font-family: "游ゴシック体", "YuGothic", "游ゴシック", "Yu Gothic", sans-serif;
  /*border: 0.5rem solid orange;*/
}

.main-ttl {
  width: 50%;
  margin: 0 auto;
  font-size: 5.0rem;
  font-weight: bold;
  line-height: 1.5;
  color: #2196F3;
  /*border: 0.5rem solid #ffd700;*/
  background-color: #ffd700
}

.nav {
  margin-top: calc(5.5rem - (((1.6rem * 1.75) - 1.6rem) / 2) - (((1.6rem * 1.75) - 1.6rem) / 2));
}

.other-page-link{
  /*border: 0.5rem solid red;*/
}

.other-page-link ul {
  list-style: none;
  /*text-align: left;*/
  /*border: 0.5rem solid orange;*/
  display: flex;
  align-items: center;
  justify-content: right;
}

.other-page-link ul li a{
  /*timeタグ、spanタグ、aタグはインライン要素なので
  すでに横並びだが、display:flexを付けて親要素の中に収める
  (そうしないとインライン要素は親要素をはみ出たままだし、
  ウィンドウ幅を狭めた際のテキストの2行目め行く位置がおかしいまま)*/
  display: flex;
  font-size: 2.0rem;
  text-decoration: none;
  /*line-height: 1.75;*/
  /*border: 0.5rem solid green;*/
  margin-left: 5.0rem;
  /*padding-left: 2.0rem;*/
}

button {
  padding: 0.5rem 1rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  cursor: pointer;
}

button.active {
  background-color: #4caf50;
  color: white;
}
</style>
