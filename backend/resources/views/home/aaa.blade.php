@extends('layouts.app')

@section('title','Laravel + Vue 3 + TS')

@section('head')
<!--このページに関しては、このBladeファイルから直接CSSファイルを読み込む方が実用的かつ推奨だが、
今回は勉強のためentry.jsからの読み込みにする(詳しくはワードを確認 → まだワードに書いていない(スマホのブラウザに残っている))
vite.config.js内のinputの所に'resources/js/entry.js'を追記する-->
@vite(['resources/js/entry.js'])
@endsection

@section('content')

  <h1 class="title">ログイン後のページ</h1>
  <p>

    <!-- ③bladeのみで完結(vueをマウントしない):route()ヘルパーを使う　-->
    <form method="POST" action="{{ route('accounts.store') }}" id="registerForm" autocomplete="on">
      @csrf
      <label for="name">ユーザ名</label>
      <input type="text" name="name" autocomplete="name" placeholder="山田太郎" size="10" class="name" id="name" maxlength="255" pattern="^[ぁ-んァ-ヶー一-龠ｦ-ﾟａ-ｚＡ-Ｚ０-９a-zA-Z0-9（）\(\)ー－―‐ 　]+$" title="ユーザー名には日本語・英数字・記号（（）など）・全角スペースが使用できます" required>
      <label for="password">パスワード</label>
      <input type="password" name="password" autocomplete="new-password" placeholder="半角英大小数字を使っ10文字以上" class="password" id="password" minlength="10" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{10,}$" required>
      <label for="email">メールアドレス</label>
      <input type="email" name="email" autocomplete="email" placeholder="example@example.com" class="email" id="email" required>
      <!--<input type="password" name="password" placeholder="パスワードを入力" pattern="^[a-zA-Z0-9]{10,}" title="パスワードは半角英数字で入力してください。" required />-->
      <!--<input type="password" name="password" size="48" placeholder="半角英大文字、半角英小文字、半角数字を使って10文字以上" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" title="半角英大文字、半角英小文字、半角数字を使って10文字以上にしてください。">-->
      <div id="nameError" style="color:red;"></div>
      <div id="passwordError" style="color:red;"></div>
      <div id="emailError" style="color:red;"></div>
      <input type="submit" value="新規登録">

      @error('name')
        <div class="error">{{ $message }}</div>
      @enderror

      <!--@error('password')
        <div class="error">{{ $message }}</div>
      @enderror-->

      @foreach ($errors->get('password') as $message)
        <div class="error">{{ $message }}</div>
      @endforeach

      @error('email')
        <div class="error">{{ $message }}</div>
      @enderror
    </form>
  </p>

  <script>
    /**
     * ユーザー名バリデーションの深いネスト部分切り出し
     * @param {string} name ユーザーが入力したパスワードに空白を取り除いたもの
     * @returns {string[]} 空もしくはエラー文が代入された配列
     */
     function getNameFormatErrors(name) {
       const messages = [];

       if (typeof name !== 'string') {
         messages.push('ユーザー名は文字列で入力してください');
       }

       if (/^\d+$/.test(name)) {
         messages.push('ユーザー名に数字だけを使用することはできません');
       }

       const allowedRegex = /^[\p{L}\p{N}\p{Zs}ー－―‐（）()ａ-ｚＡ-Ｚ０-９ｦ-ﾟァ-ヶー一-龠ぁ-ん]+$/u;
       if (!allowedRegex.test(name)) {
         messages.push('ユーザー名の形式が正しくありません（日本語・英数字・記号のみ使用可能）');
       }

       return messages;
     }

    /**
     * パスワードバリデーションの深いネスト部分切り出し
     * @param {string} password ユーザーが入力したパスワードに空白を取り除いたもの
     * @returns {string[]} 空もしくはエラー文が代入された配列
     */
     function getPasswordFormatErrors(password) {
       const messages = [];

       if (!/[a-z]/.test(password)) {
         messages.push('パスワードには半角英小文字を含めてください');
       }

       if (!/[A-Z]/.test(password)) {
         messages.push('パスワードには半角英大文字を含めてください');
       }

       if (!/[0-9]/.test(password)) {
         messages.push('パスワードには半角数字を含めてください');
       }

       return messages;
     }

    /**
     * メールアドレスバリデーションの深いネスト部分切り出し
     * @param {string} email ユーザーが入力したメールアドレスに空白を取り除いたもの
     * @returns {string[]} 空もしくはエラー文が代入された配列
     */
     function getEmailFormatErrors(email) {
       const messages = [];

       const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

       if (!emailRegex.test(email)) {
         messages.push('メールアドレスの形式が正しくありません');
       }

       return messages;
     }

    /**
     * サーバーへ問い合わせてメールアドレスの重複をチェック
     * @param {string} email
     * @returns {Promise<boolean>} true = 登録済み, false = 未登録
     */
     async function isEmailAlreadyRegistered(email) {
       try {
         const res = await fetch('/api/check-email', {
           method: 'POST',
           headers: {
             'Content-Type': 'application/json'
             //'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
           },
           body: JSON.stringify({ email })
         });
         const data = await res.json();
         return data.exists === true;
       } catch (err) {
         console.error('通信エラー:', err);
         return null;
       }
     }

     document.getElementById('registerForm').addEventListener('submit', async function(e) {
       e.preventDefault();

       const nameInput = document.getElementById('name');
       const nameError = document.getElementById('nameError');
       const nameValue = nameInput.value.trim();
       nameError.textContent = '';

       const passwordInput = document.getElementById('password');
       const passwordError = document.getElementById('passwordError');
       const passwordValue = passwordInput.value.trim();
       passwordError.textContent = '';

       const emailInput = document.getElementById('email');
       const emailError = document.getElementById('emailError');
       const emailValue = emailInput.value.trim();
       emailError.textContent = '';

       let isValid = true;

       //ユーザー名
       let nameErrors = [];

       if (!nameValue) {
         nameError.textContent = 'ユーザー名を入力してください';
         isValid = false;
       } else if (nameValue.length > 255) {
            nameError.textContent = 'ユーザー名は255文字以下で入力してください';
            isValid = false;
          } else {
          nameErrors.push(...getNameFormatErrors(nameValue));
          }

       if (nameErrors.length > 0) {
         nameError.innerHTML = nameErrors.join('<br>');
         isValid = false;
       }

       //パスワード
       let passwordErrors = [];

       if (!passwordValue) {
         passwordError.textContent = 'パスワードを入力してください';
         isValid = false;
        } else if (passwordValue.length < 10) {
            passwordError.textContent = 'パスワードは10文字以上にしてください';
            isValid = false;
          } else {
          passwordErrors.push(...getPasswordFormatErrors(passwordValue));
          }

       if (passwordErrors.length > 0) {
          passwordError.innerHTML = passwordErrors.join('<br>');
          isValid = false;
        }

        //メールアドレス
        let emailErrors = [];

        if (!emailValue) {
          emailError.textContent = 'メールアドレスを入力してください';
          isValid = false;
        } else {
          emailErrors.push(...getEmailFormatErrors(emailValue));

          const exists = await isEmailAlreadyRegistered(emailValue);
          if (exists === true) {
            emailErrors.push('このメールアドレスはすでに登録されています');
          } else if (exists === null) {
            emailErrors.push('サーバーとの通信に失敗しました');
          }
        }

        if (emailErrors.length > 0) {
          emailError.innerHTML = emailErrors.join('<br>');
          isValid = false;
        }

        alert("isValid = " + isValid)

        if (isValid) {
          this.submit();
        }
      });

      document.getElementById('email').addEventListener('blur', async function () {
        const emailInput = this;
        const emailError = document.getElementById('emailError');
        const email = emailInput.value.trim();

        emailError.textContent = '';
        alert("blur発火")

        const exists = await isEmailAlreadyRegistered(email);
          if (exists === true) {
            emailError.innerHTML = 'このメールアドレスはすでに登録されています';
          } else if (exists === null) {
            emailError.innerHTML = 'サーバーとの通信に失敗しました';
          }
      });
  </script>

@endsection
