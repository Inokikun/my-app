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
    <form method="POST" action="{{ route('logout.process') }}" id="registerForm" autocomplete="on">
      @csrf
      <button type="submit">ログアウト</button>
    </form>
  </p>

  <script>

  </script>

@endsection
