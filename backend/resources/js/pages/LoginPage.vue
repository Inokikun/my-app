<template>
  <button @click="toggle_1" :class="{ active: isActive }">
    {{ isActive ? 'ON' : 'OFF' }}
  </button>

  <button @click="toggle_2">
    切り替え
  </button>

  <p v-if = "isVisible">
    表示されています!
  </p>

  <!-- // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/9.docx -->
  <div v-if="authError" class="alert alert-danger">
      {{ authError }}
  </div>

  <h1 class="login-txt">ユーザー名とパスワードを入力してログインして下さい</h1>
    <form class="input-field" method="POST" :action="loginUrl">
      <input type="hidden" name="_token" :value="csrfToken" />
      <div class="name">
        <label for="name">ユーザ名</label>
        <input type="text" name="name" required placeholder="ユーザー名" :value="old.name ?? ''">
          <div v-if="errors.name">
            <p v-for="err in errors.name" :key="err" class="error">
              {{ err }}
            </p>
          </div>
      </div>
      <div class="password">
        <label for="password">パスワード</label>
        <input type="password" name="password" required placeholder="パスワード">
          <div v-if="errors.password">
            <p v-for="err in errors.password" :key="err" class="error">
              {{ err }}
            </p>
          </div>
      </div>
        <input type="submit" value="ログイン">
    </form>
</template>

<script lang="ts" setup>
  // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/.docx

  import { ref, Ref, onMounted } from 'vue'

  const aaa:string = "takano";
  const b: string = "1";
  let age: number = 100;
  alert("LoginPageアラート出力")

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

  {{ /*  ①vueをbladeへマウント:HTML属性で値を渡す */}}
  const props = defineProps<{
    csrfToken: string
    loginUrl: string
    errors: Record<string, string[]>
    old: Record<string, string>
    authError: string | null
  }>()
  alert(props.loginUrl)
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

.login-txt {
  margin: 0 auto;
  font-size: 1.0rem;
  font-weight: bold;
  line-height: 1.5;
  /*border: 0.5rem solid #ffd700;*/
}

.input-field {
  margin-top: calc(5.5rem - (((1.6rem * 1.75) - 1.6rem) / 2) - (((1.6rem * 1.75) - 1.6rem) / 2));
}

.input-field {
   margin: auto;
     font-size: 5.0rem;
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
