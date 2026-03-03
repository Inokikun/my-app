@extends('layouts.app')

@section('title','Laravel + Vue 3 + TS')

@section('head')
<!--このページに関しては、このBladeファイルから直接CSSファイルを読み込む方が実用的かつ推奨だが、
今回は勉強のためentry.jsからの読み込みにする(詳しくはワードを確認 → まだワードに書いていない(スマホのブラウザに残っている))
vite.config.js内のinputの所に'resources/js/entry.js'を追記する-->
@vite(['resources/js/entry.js'])
@endsection

@section('content')

  <h1 class="title">アカウント作成</h1>
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
    // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/13.docx
    /**
     * ユーザー名バリデーションの深いネスト部分切り出し
     * @param {string} name ユーザーが入力したパスワードに空白を取り除いたもの
     * @returns {string[]} 空もしくはエラー文が代入された配列
     */

    /**
     * ユーザー名のフォーマットを検証し、違反していればエラーメッセージを返す関数。
     *
     * @param {string} name ユーザーが入力したユーザー名（空白を除去済み）
     * @returns {string[]} エラーメッセージの配列。問題がなければ空配列を返す。
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

    /**
     * パスワードの形式を検証し、条件を満たさない場合はエラーメッセージを返す関数。
     *
     * @param {string} password ユーザーが入力したパスワード（空白を除去済み）
     * @returns {string[]} エラーメッセージの配列。問題がなければ空配列を返す。
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

    /**
     * メールアドレスの形式を検証し、無効な場合はエラーメッセージを返す関数。
     *
     * @param {string} email ユーザーが入力したメールアドレス（空白を除去済み）
     * @returns {string[]} エラーメッセージの配列。問題がなければ空配列を返す。
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
     * サーバーへ問い合わせてユーザー名とメールアドレスの重複をチェック
     * @param {string} username, email
     * @returns {Promise<boolean>} true = 登録済み, false = 未登録
     */
     /*async function isEmailAlreadyRegistered(email) {
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
     }*/

    /**
     * サーバーへ問い合わせてユーザー名とメールアドレスの重複をチェックする
     *
     * @param {Object} params - チェック対象のパラメータ
     * @param {string} params.email - ユーザーが入力したメールアドレス
     * @param {string} params.name - ユーザーが入力したユーザー名
     * @returns {Promise<{ emailExists: boolean, usernameExists: boolean } | null>}
     * サーバー応答に基づく重複情報を含むオブジェクト（通信エラー時は null）
     *
     * 戻り値の例:
     * {
     *   emailExists: true,     // メールアドレスが登録済みなら true
     *   usernameExists: false  // ユーザー名が未登録なら false
     * }
     */
     async function checkDuplicate({ email, name }) {
       try {
         console.log('fetch直前')
         const res = await fetch('/api/check-duplicate', {
        //const res = await fetch('http://localhost:8000/api/check-duplicate', {
           method: 'POST',
           headers: {
             'Content-Type': 'application/json',
             // 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
             //'Accept': 'application/json',
           },
           body: JSON.stringify({ email, name }),
         });

         const data = await res.json();
         return {
           emailExists: data.emailExists === true,
           usernameExists: data.usernameExists === true
         };
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

        //メールアドレス
        let emailErrors = [];

        if (!emailValue) {
          emailError.textContent = 'メールアドレスを入力してください';
          isValid = false;
        } else {
          emailErrors.push(...getEmailFormatErrors(emailValue));
          }

        // 重複チェック（ユーザー名・メールの両方が入力されている場合のみ実行）
        if (nameValue && emailValue) {

          /*const exists = await isEmailAlreadyRegistered(emailValue);
          if (exists === true) {
            emailErrors.push('このメールアドレスはすでに登録されています');
          } else if (exists === null) {
            emailErrors.push('サーバーとの通信に失敗しました');
          }*/

          const duplicate = await checkDuplicate({ email: emailValue, name: nameValue });

          if (duplicate === null) {
            emailErrors.push('サーバーとの通信に失敗しました');
            isValid = false;
          } else {
            if (duplicate.emailExists) {
              emailErrors.push('このメールアドレスはすでに登録されています');
              isValid = false;
            }
            if (duplicate.usernameExists) {
              nameErrors.push('このユーザー名はすでに登録されています');
              isValid = false;
            }
          }
        }

        if (nameErrors.length > 0) {
          nameError.innerHTML = nameErrors.join('<br>');
          isValid = false;
        }

        if (passwordErrors.length > 0) {
          passwordError.innerHTML = passwordErrors.join('<br>');
          isValid = false;
         }

        if (emailErrors.length > 0) {
          emailError.innerHTML = emailErrors.join('<br>');
          isValid = false;
        }

        if (isValid) {
          alert("isValid = true\n入力情報をサーバーに送信します")
          this.submit();
        }
        else{
          alert("isValid = false\n入力情報にエラーがあるためサーバーへの送信は中止します")
        }
     });

     /*document.getElementById('email').addEventListener('blur', async function () {
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
     });*/

     /**
      * 共通のblurイベントハンドラ
      * @param {string} fieldId {string} errorId　'email'と'emailError'または'name'と'nameError'というただの文字列
      * @returns なし
      */

     /**
      * 共通の blur イベントハンドラ
      *
      * 指定された入力欄（ユーザー名またはメールアドレス）の値を取得し、
      * サーバーに重複チェックを行い、対応するエラーメッセージ要素に結果を表示する。
      *
      * @param {string} fieldId - 入力欄の要素ID（例: 'email' または 'name'）
      * @param {string} errorId - エラーメッセージを表示する要素のID（例: 'emailError' または 'nameError'）
      * @returns {Promise<void>} なし（非同期処理のため Promise を返す）
      */
      async function handleDuplicateCheckOnBlur(fieldId, errorId) {
        const input = document.getElementById(fieldId);
        const errorDiv = document.getElementById(errorId);
        const value = input.value.trim();

        // 空欄時はエラーを消してスキップ
        if (!value) {
          errorDiv.textContent = '';
          return;
        }

        // 両方の値を取得してAPIに渡す
        const nameValue = document.getElementById('name').value.trim();
        const emailValue = document.getElementById('email').value.trim();

        const result = await checkDuplicate({ email: emailValue, name: nameValue });

        errorDiv.textContent = ''; // エラー初期化

        if (result === null) {
          errorDiv.textContent = 'サーバーとの通信に失敗しましたうんこ';
          return;
        }

        // email入力欄のblurなら emailExists をチェック
        if (fieldId === 'email' && result.emailExists) {
          errorDiv.textContent = 'このメールアドレスはすでに登録されています';
        }

        // name入力欄のblurなら usernameExists をチェック
        if (fieldId === 'name' && result.usernameExists) {
          errorDiv.textContent = 'このユーザー名はすでに登録されています';
        }
      }

      // blurイベント登録(メールアドレス)
      document.getElementById('email').addEventListener('blur', () => {
        //ここでの引数はただの'文字列'である(HTMLのidでも、バニラjsの変数でもないので注意)
        //handleDuplicateCheckOnBlur関数内でgetElementByIdにてHTMLから要素を取得する
        handleDuplicateCheckOnBlur('email', 'emailError');
      });

      // blurイベント登録(ユーザー名)
      document.getElementById('name').addEventListener('blur', () => {
        //ここでの引数はただの'文字列'である(HTMLのidでも、バニラjsの変数でもないので注意)
        //handleDuplicateCheckOnBlur関数内でgetElementByIdにてHTMLから要素を取得する
        handleDuplicateCheckOnBlur('name', 'nameError');
      });
  </script>

@endsection
